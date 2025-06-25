// Planting and harvesting dates
const plantingDate = new Date('<?php echo $planting_dt; ?>');
const harvestingDate = new Date('<?php echo $harvest_dt; ?>');
const currentDate = new Date(); // Current date

// Get the progress bar element
const progressBar = document.getElementById('progress-bar');

// Function to calculate the percentage of time passed
function calculateProgress(plantingDate, harvestingDate, currentDate) {
    const totalTime = harvestingDate - plantingDate; // Total time between planting and harvesting
    const timePassed = currentDate - plantingDate; // Time passed since planting
    const progress = (timePassed / totalTime) * 100; // Calculate percentage
    return Math.min(Math.max(progress, 0), 100); // Ensure it stays between 0% and 100%
}

// Update the progress bar width based on the calculated percentage
const progressPercentage = calculateProgress(plantingDate, harvestingDate, currentDate);
progressBar.style.width = progressPercentage + '%';
	