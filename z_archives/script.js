document.addEventListener('DOMContentLoaded', function() {
    // Set the teal color dynamically based on the current date
    const currentDate = new Date();
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth(); // 0 for Jan, 11 for Dec
    
    document.querySelectorAll('.timeline-bar').forEach(bar => {
        const start = new Date(bar.getAttribute('data-start'));
        const end = new Date(bar.getAttribute('data-end'));
        
        // If the current date is within the start and end range, add the 'current' class
        if (currentDate >= start && currentDate <= end) {
            bar.classList.add('current');
        }
    });

    // Year dropdown functionality (if you have a dropdown for year selection)
    const yearDropdown = document.getElementById('yearDropdown');
    if (yearDropdown) {
        yearDropdown.addEventListener('change', function() {
            const selectedYear = yearDropdown.value;
            
            // Make an AJAX call or fetch request here to load data for the selected year
            // Alternatively, if all data is already on the page, filter based on year
            
            // Example code for filtering by year:
            document.querySelectorAll('.timeline-row').forEach(row => {
                row.style.display = 'none';
                const year = row.getAttribute('data-year');
                if (year === selectedYear) {
                    row.style.display = 'grid';
                }
            });
        });
    }
});
