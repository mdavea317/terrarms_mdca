function openCamera(buttonId) {
    const imageBox = document.getElementById(buttonId + '-image-box');
    const previewContainer = imageBox.querySelector('.preview-container');

    // Remove any existing video elements to avoid duplication
    let existingVideo = previewContainer.querySelector('video');
    if (existingVideo) {
        existingVideo.remove();
    }

    // Create and configure the video element
    const video = document.createElement('video');
    video.setAttribute('playsinline', ''); // For iOS support
    video.style.width = '100%';
    video.style.height = '100%';
    video.style.objectFit = 'cover';
    video.style.display = 'block'; // Make the video visible
    previewContainer.appendChild(video);

    navigator.mediaDevices.getUserMedia({ video: true })
        .then((stream) => {
            // Set the video stream
            video.srcObject = stream;
            video.play();

            // Capture the image after a delay (e.g., 2 seconds)
            setTimeout(() => {
                const capturedImage = captureImage(video);

                // Stop the video stream and remove the video element
                stream.getTracks().forEach(track => track.stop());
                video.srcObject = null; // Clear the video source
                video.remove(); // Remove the video element

                // Set the captured image to the img element
                const imgElement = document.getElementById(buttonId + '-captured-image');
                imgElement.src = capturedImage;

                // Update the hidden input field with the Base64 image data
                const hiddenInput = document.getElementById(buttonId + '-captured-image-input');
                hiddenInput.value = capturedImage;

            }, 2000);
        })
        .catch((error) => {
            console.error('Error accessing webcam:', error);
        });
}

function captureImage(video) {
    // Create a canvas element to draw the current video frame onto it
    const canvas = document.createElement('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    const context = canvas.getContext('2d');

    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Return the Base64 encoded image data
    return canvas.toDataURL('image/png');
}
