document.addEventListener('DOMContentLoaded', () => {
    // Load top bar
    fetch('topbar.html')
        .then(response => response.text())
        .then(data => {
            document.getElementById('topbar').innerHTML = data;
            // Set page-specific title
            const pageTitle = document.getElementById('pageTitle');
            const page = window.location.pathname.split('/').pop();
            if (page === 'dashboard.php') pageTitle.textContent = 'Weather Dashboard';
            else if (page === 'calendar.php') pageTitle.textContent = 'Weather Calendar';
            else if (page === 'map.php') pageTitle.textContent = 'Weather Map';
            else if (page === 'saved-locations.php') pageTitle.textContent = 'Saved Locations';
            // Update username
            const username = localStorage.getItem('username') || 'User';
            document.getElementById('username').textContent = username;
        });
      
    // Load sidebar
    document.addEventListener('DOMContentLoaded', () => {
        // Load top bar
        fetch('topbar.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('topbar').innerHTML = data;
                // Set page-specific title
                const pageTitle = document.getElementById('pageTitle');
                const page = window.location.pathname.split('/').pop();
                if (page === 'dashboard.php') pageTitle.textContent = 'Weather Dashboard';
                else if (page === 'calendar.php') pageTitle.textContent = 'Weather Calendar';
                else if (page === 'map.php') pageTitle.textContent = 'Weather Map';
                else if (page === 'saved-locations.php') pageTitle.textContent = 'Saved Locations';
                // Update username
                const username = localStorage.getItem('username') || 'User';
                document.getElementById('username').textContent = username;
            });
    
        // Load sidebar
        fetch('sidebar.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('sidebar').innerHTML = data;
            });
    });
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('collapsed');
    }
});