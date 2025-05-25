// Initialize calendar
document.addEventListener('DOMContentLoaded', () => {
    const username = localStorage.getItem('username') || 'User';
    document.getElementById('username').textContent = username;

    // Populate location dropdown
    populateLocationDropdown();

    // Render initial calendar
    renderCalendar(new Date());
});

const bangladeshLocations = [
    'Dhaka', 'Chittagong', 'Sylhet', 'Rajshahi', 
    'Khulna', 'Barisal', 'Rangpur', 'Mymensingh',
    "Cox's Bazar", 'Comilla', 'Narayanganj', 
    'Gazipur', 'Bogra', 'Kushtia', 'Jessore', 
    'Dinajpur', 'Tangail', 'Faridpur', 'Pabna', 'Nawabganj'
];

// Populate location dropdown from localStorage (users or selectedLocation)
function populateLocationDropdown() {
    const locationSelect = document.getElementById('locationSelect');
    locationSelect.innerHTML = ''; // Clear existing options

    bangladeshLocations.forEach(location => {
        const option = document.createElement('option');
        option.value = location;
        option.textContent = location;
        locationSelect.appendChild(option);
    });

    // Set default to Dhaka
    locationSelect.value = 'Dhaka';
}

function updateLocation() {
    const locationSelect = document.getElementById('locationSelect');
    const selectedLocation = locationSelect.value;
    fetchWeatherData(selectedLocation, currentDate);
}

function formatDate(date) {
    return date.toISOString().split('T')[0];
}

function fetchWeatherData(city, date) {
    const month = date.getMonth() + 1;
    const year = date.getFullYear();

    $.ajax({
        url: 'get_monthly_weather.php',
        type: 'POST',
        data: { 
            city: city,
            month: month,
            year: year
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                renderCalendarWithWeather(currentDate, response.data);
                showNotification(`Weather data loaded for ${city}`);
            } else {
                showNotification('No weather data available for this location and month');
            }
        },
        error: function() {
            showNotification('Error fetching weather data');
        }
    });
}

let currentDate = new Date();

function renderCalendar(date) {
    currentDate = new Date(date);
    const monthYear = document.getElementById('monthYear');
    const calendar = document.getElementById('calendar');
    const selectedDateSpan = document.getElementById('selectedDate');

    monthYear.textContent = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });

    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const today = new Date();

    let tableHTML = '<tr>';
    const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    days.forEach(day => {
        tableHTML += `<th>${day}</th>`;
    });
    tableHTML += '</tr><tr>';

    let dateIndex = 1 - firstDay.getDay();
    while (dateIndex <= lastDay.getDate()) {
        for (let i = 0; i < 7 && dateIndex <= lastDay.getDate(); i++) {
            const currentDateObj = new Date(year, month, dateIndex);
            const isToday = currentDateObj.toDateString() === today.toDateString();
            const isSelected = selectedDate && currentDateObj.toDateString() === selectedDate.toDateString();
            const isDisabled = currentDateObj.getMonth() !== month;

            tableHTML += `<td class="${isToday ? 'today' : ''} ${isSelected ? 'selected' : ''} ${isDisabled ? 'disabled' : ''}" onclick="selectDate('${currentDateObj.toDateString()}')">${isDisabled ? '' : dateIndex}</td>`;
            dateIndex++;
        }
        tableHTML += '</tr><tr>';
    }
    tableHTML = tableHTML.replace(/<tr><\/tr>$/, '</tr>');
    calendar.innerHTML = tableHTML;

    // Display selected date if any
    selectedDateSpan.textContent = selectedDate ? selectedDate : 'None';
}

function getWeatherIcon(condition) {
    const iconMap = {
        'Sunny': 'sunny.png',
        'Clear': 'sunny.png',
        'Rainy': 'rainy.png',
        'Rain': 'rainy.png',
        'Cloudy': 'cloudy.png',
        'Partly Cloudy': 'cloudy.png',
        'Thunderstorm': 'storm.png',
        'Storm': 'storm.png',
        'Snow': 'snow.png',
        'Mist': 'mist.png',
        'Haze': 'mist.png'
    };

    if (!condition) return 'default.png';
    
    const conditionLower = condition.toLowerCase();
    for (const [key, value] of Object.entries(iconMap)) {
        if (conditionLower.includes(key.toLowerCase())) {
            return value;
        }
    }
    return 'default.png';
}

function renderCalendarWithWeather(date, weatherData) {
    currentDate = new Date(date);
    const monthYear = document.getElementById('monthYear');
    const calendar = document.getElementById('calendar');
    
    monthYear.textContent = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });

    let tableHTML = '<tr>';
    const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    days.forEach(day => {
        tableHTML += `<th>${day}</th>`;
    });
    tableHTML += '</tr><tr>';

    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);
    const today = new Date();

    let dateIndex = 1 - firstDay.getDay();
    
    // Get BASE_URL from a global variable or set it here if not available
    const BASE_URL = window.BASE_URL || '/Web_tec_project_weather_app_mid';

    while (dateIndex <= lastDay.getDate()) {
        for (let i = 0; i < 7 && dateIndex <= lastDay.getDate(); i++) {
            const currentDateObj = new Date(year, month, dateIndex);
            const isToday = currentDateObj.toDateString() === today.toDateString();
            const isSelected = selectedDate && currentDateObj.toDateString() === selectedDate.toDateString();
            const isDisabled = currentDateObj.getMonth() !== month;
            
            const dateStr = currentDateObj.toISOString().split('T')[0];
            const weatherInfo = weatherData[dateStr] || null;

            let cellContent = isDisabled ? '' : dateIndex;
            if (!isDisabled) {
                const currentDateStr = formatDate(currentDateObj);
                const weatherInfo = weatherData[currentDateStr];
                
                cellContent = `
                    <div class="date-cell">
                        <span class="date-number">${dateIndex}</span>
                        ${weatherInfo ? `
                            <div class="weather-info">
                                <img src="${BASE_URL}/assets/${getWeatherIcon(weatherInfo.condition)}" 
                                     alt="${weatherInfo.condition}" 
                                     class="weather-icon-small"/>
                                <span class="temperature">${weatherInfo.temperature}°C</span>
                            </div>
                        ` : '<span class="no-data">-</span>'}
                    </div>
                `;
            }

            tableHTML += `
                <td class="${isToday ? 'today' : ''} ${isSelected ? 'selected' : ''} ${isDisabled ? 'disabled' : ''}"
                    onclick="selectDate('${currentDateObj.toDateString()}')">
                    ${cellContent}
                </td>`;
            dateIndex++;
        }
        tableHTML += '</tr><tr>';
    }
    
    tableHTML = tableHTML.replace(/<tr><\/tr>$/, '');
    calendar.innerHTML = tableHTML;
}

let selectedDate = null;

function selectDate(dateString) {
    if (!document.querySelector(`#calendar td.disabled`)) {
        selectedDate = new Date(dateString);
        renderCalendar(currentDate); // Re-render to highlight selected date
        showNotification(`Selected date: ${selectedDate.toLocaleDateString()}`);
    }
}

function previousMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
}

// Notification functions (reused from dashboard.js)
function showNotification(message) {
    const notification = document.getElementById('notification');
    const notificationText = document.getElementById('notificationText');
    notificationText.textContent = message;
    notification.classList.add('show');

    if (notificationTimeout) {
        clearTimeout(notificationTimeout);
    }

    notificationTimeout = setTimeout(() => {
        notification.classList.remove('show');
    }, 5000);
}

function dismissNotification() {
    const notification = document.getElementById('notification');
    notification.classList.remove('show');
    if (notificationTimeout) {
        clearTimeout(notificationTimeout);
    }
}

let notificationTimeout;

// Ensure sidebar toggle and other dashboard features are included
// Assuming include.js handles sidebar and dashboard.js handles toggleDropdown, logout, etc.