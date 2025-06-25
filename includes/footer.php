<footer>
    
</footer>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.querySelector('#sidebarToggle');
    const sidebar = document.querySelector('.sidenav');
    const overlay = document.querySelector('.overlay');

    // Function to open the sidebar and show the overlay
    const openSidebar = () => {
        sidebar.classList.add('active');
        overlay.classList.add('active');
        toggleButton.innerHTML = '✖ Close'; // Change to "X"
    };

    // Function to close the sidebar and hide the overlay
    const closeSidebar = () => {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        toggleButton.innerHTML = '☰ Menu'; // Change back to hamburger
    };

    // Toggle sidebar on button click
    toggleButton.addEventListener('click', () => {
        if (sidebar.classList.contains('active')) {
            closeSidebar();
        } else {
            openSidebar();
        }
    });

    // Close sidebar when clicking on the overlay
    overlay.addEventListener('click', closeSidebar);
});
</script>




</body>
</html>
