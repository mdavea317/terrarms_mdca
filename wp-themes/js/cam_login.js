let videoStream = null;
let webcamStarted = false;
let employeeNames = [];  // This will hold the employee names from the database
let employeeMapping = {};  // This will map employee names to their respective IDs
let faceTimes = {};  // This will store the time each employee's face was first detected
let isClockOutMode = false;  // Flag to check if we are in clock-out mode
let warningShown = false;  // Flag to track if warning was already displayed


// Start webcam when the button is clicked
document.getElementById("startAttendance").addEventListener("click", function() {
    const videoContainer = document.querySelector(".video-container");
    videoContainer.style.display = "flex";

    if (!webcamStarted) {
        startWebcam();
        webcamStarted = true;
    }
});


// Start webcam for clock-out, but only execute clock-out after face detection
document.getElementById("endAttendance").addEventListener("click", function() {
    const videoContainer = document.querySelector(".video-container");
    videoContainer.style.display = "flex";

    // Ensure the webcam starts if it's not already started
    if (!webcamStarted) {
        startWebcam();
        webcamStarted = true;
    }

    // Switch to clock-out mode
    isClockOutMode = true;
    console.log("Clock-out mode activated.");
});


// Close button event to stop webcam
document.getElementById("closeButton").addEventListener("click", function() {
    stopWebcam();
    document.querySelector(".video-container").style.display = "none";
	
    // Wait for 1 second before refreshing the page
    setTimeout(function() {
        location.reload();  // This will reload the page
    }, 250);  // 1000 milliseconds = 1 second
});

function startWebcam() {
    const video = document.getElementById("video");

    // Start the webcam
    navigator.mediaDevices
        .getUserMedia({
            video: true,  // Only video stream
            audio: false, // No audio
        })
        .then((stream) => {
            video.srcObject = stream;
            videoStream = stream;

            // Wait for the video to be ready before starting face detection
            video.addEventListener("canplay", () => {
                startFaceDetection();  // Start face detection when video is ready
            });
        })
        .catch((error) => {
            console.error("Error accessing the webcam: ", error);
        });
}

// Stop webcam stream when close button is clicked
function stopWebcam() {
    if (videoStream) {
        videoStream.getTracks().forEach((track) => track.stop());
        videoStream = null;
        webcamStarted = false;
        console.log("Webcam stopped.");
		warningShown = false;  // Reset the warning flag
    }
}


// Load face-api.js models
async function loadModels() {
    await Promise.all([
        faceapi.nets.ssdMobilenetv1.loadFromUri("/models"),
        faceapi.nets.faceRecognitionNet.loadFromUri("/models"),
        faceapi.nets.faceLandmark68Net.loadFromUri("/models"),
    ]);
    console.log("Face-api models loaded");
}

// Fetch employee names from the database
fetch('includes/fetch_emp_att.php')
    .then(response => response.json())
    .then(data => {
        employeeNames = data.names;  // Assuming data.names holds employee names
        startFaceDetection();  // Start face detection once names are loaded
    })
    .catch(error => console.error('Error fetching employee names:', error));

// Get labeled face descriptors for each employee
async function getLabeledFaceDescriptors() {
    const labeledDescriptors = [];

    // Process each employee's images
    for (const employeeName of employeeNames) {
        const descriptions = [];

        // Process 2 images per employee (1.png, 2.png, etc.)
        for (let i = 1; i <= 2; i++) {
            try {
                const img = await faceapi.fetchImage(`./wp-uploads/employees/${employeeName}/${i}.png`);

                // Detect the face and extract the descriptor
                const detections = await faceapi
                    .detectSingleFace(img)
                    .withFaceLandmarks()
                    .withFaceDescriptor();

                if (detections) {
                    descriptions.push(detections.descriptor);
                } else {
                    console.log(`No face detected in ${employeeName}/${i}.png`);
                }
            } catch (error) {
                console.error(`Error processing ${employeeName}/${i}.png:`, error);
            }
        }

        // If descriptors were found for this employee, add to labeledDescriptors
        if (descriptions.length > 0) {
            labeledDescriptors.push(new faceapi.LabeledFaceDescriptors(employeeName, descriptions));
        }
    }

    return labeledDescriptors;
}

async function startFaceDetection() {
    await loadModels();

    const video = document.getElementById("video");
    const canvas = faceapi.createCanvasFromMedia(video);
    document.querySelector(".video-container").appendChild(canvas);

    const displaySize = { width: video.width, height: video.height };
    faceapi.matchDimensions(canvas, displaySize);

    const labeledDescriptors = await getLabeledFaceDescriptors();
    const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.55); //, 0.6

    setInterval(async () => {
        const detections = await faceapi
            .detectAllFaces(video)
            .withFaceLandmarks()
            .withFaceDescriptors();

        const resizedDetections = faceapi.resizeResults(detections, displaySize);

        canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);

        const results = resizedDetections.map((d) => {
            return faceMatcher.findBestMatch(d.descriptor);
        });

        resizedDetections.forEach((detection, i) => {
            const box = detection.detection.box;
            const label = results[i] ? results[i].label : "Unknown";
            const drawBox = new faceapi.draw.DrawBox(box, { label });
            drawBox.draw(canvas);

			//console.log("Logged-in user ID:", currentUserName);
			//console.log("Detected face label:", label);
			
			// Check if the detected person matches the logged-in user
			if (label !== "Unknown") {
				if (label !== currentUserName && !warningShown) {
					// Show the warning message only once
					/*const messageElement = document.getElementById("message");
					messageElement.innerText = "Wrong person detected!";
					messageElement.classList.add("error");  // Add error class*/

					// Log details for debugging
					console.warn(`Warning: Wrong person detected`);
					console.warn("Logged-in user ID:", currentUserName);
					console.warn("Detected face label:", label);

					// Set the flag to avoid showing the warning repeatedly
					warningShown = true;

					// Clear the warning after 3 seconds
					setTimeout(() => {
						messageElement.innerText = "";  // Clear the message
						messageElement.classList.remove("error");  // Remove the error class
						warningShown = false;  // Reset the flag after hiding the message
					}, 3000);  // 3000 ms = 3 seconds
				} else if (label === currentUserName) {
					// If the person matches the logged-in user, reset the warning and proceed with clock-in/clock-out
					warningShown = false;  // Reset the warning flag
					document.getElementById("message").innerText = "";  // Clear the message

					// Handle clock-in/clock-out
					if (!faceTimes[label]) {
						if (isClockOutMode) {
							markClockOut(label);
						} else {
							markAttendance(label);
						}
					}
				}
			}

        });
    }, 50);
}


// Function to mark attendance
function markAttendance(employeeName) {
    const currentTime = new Date().toLocaleTimeString('en-US', {
        hour: 'numeric',
        minute: '2-digit',
		second: '2-digit',
        hour12: false
    });
    faceTimes[employeeName] = currentTime;
    document.getElementById("clock_in").innerText = `${currentTime}`;
    sendTimeToServer(employeeName, currentTime, 'clock_in');
}

// Function to mark clock-out
function markClockOut(employeeName) {
    const currentTime = new Date().toLocaleTimeString('en-US', {
        hour: 'numeric',
        minute: '2-digit',
		second: '2-digit',
        hour12: false
    });
    faceTimes[employeeName] = currentTime;
    document.getElementById("clock_out").innerText = `${currentTime}`;
    sendTimeToServer(employeeName, currentTime, 'clock_out');
    isClockOutMode = false;  // Reset clock-out mode after clock-out
}

// Function to send clock-in/clock-out data to the server
function sendTimeToServer(employeeName, time, action) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/log_time.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(`${action} time logged successfully:`, xhr.responseText);
        }
    };

    const data = JSON.stringify({
        employeeName: employeeName,
        time: time,
        action: action
    });

    xhr.send(data);
}