function validateLocationForm() {
    const cityInput = document.getElementById('city');
    const city = cityInput.value.trim();
    
    if (city.length < 2) {
        showNotification('Please enter a valid city name', 'error');
        return false;
    }

    // Append ", Bangladesh" if not present
    if (!city.toLowerCase().includes('bangladesh')) {
        cityInput.value = `${city}, Bangladesh`;
    }

    return true;
}

function viewWeather(city) {
    window.location.href = `dashboard.view.php?city=${encodeURIComponent(city)}`;
}

// City name autocomplete
$(document).ready(function() {
    const bangladeshCities = [
        'Dhaka, Bangladesh',
        'Chittagong, Bangladesh',
        'Sylhet, Bangladesh',
        'Rajshahi, Bangladesh',
        'Khulna, Bangladesh',
        'Barisal, Bangladesh',
        'Rangpur, Bangladesh',
        'Mymensingh, Bangladesh',
        "Cox's Bazar, Bangladesh",
        'Comilla, Bangladesh'
    ];

    $('#city').autocomplete({
        source: bangladeshCities,
        minLength: 1
    });
});

// Auto-hide messages
document.addEventListener('DOMContentLoaded', () => {
    const messages = document.querySelectorAll('.success-message, .error-message');
    messages.forEach(message => {
        setTimeout(() => {
            message.style.opacity = '0';
            setTimeout(() => message.remove(), 300);
        }, 3000);
    });
});

// Handle dropdown menu
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('userDropdown');
        const userProfile = document.querySelector('.user-profile');
        if (!userProfile.contains(e.target) && dropdown.style.display === 'block') {
            dropdown.style.display = 'none';
        }
    });
});

function toggleDropdown(event) {
    const dropdown = document.getElementById('userDropdown');
    const isVisible = dropdown.style.display === 'block';
    
    // Close any open dropdowns first
    const dropdowns = document.getElementsByClassName('dropdown');
    for (let d of dropdowns) {
        d.style.display = 'none';
    }
    
    if (!isVisible) {
        dropdown.style.display = 'block';
        event.stopPropagation();
    }
}
