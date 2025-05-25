// Initialize dashboard
document.addEventListener('DOMContentLoaded', () => {
    const username = document.getElementById('username').textContent || 'User';
    document.getElementById('username').textContent = username;
    drawChart();
    const userLocation = document.getElementById('userLocation') ? document.getElementById('userLocation').value : 'Dhaka, Bangladesh';
    displayForecast(userLocation);
    document.addEventListener('click', closeDropdownOnOutsideClick);
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

function closeDropdownOnOutsideClick(event) {
    const dropdown = document.getElementById('userDropdown');
    const userProfile = document.querySelector('.user-profile');
    if (!userProfile.contains(event.target) && dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
    }
}

function logout() {
    localStorage.removeItem('username');
    window.location.href = 'index.php';
}

function getWeatherIcon(condition) {
    const iconMap = {
        'Sunny': '../assets/sunny.png',
        'Rainy': '../assets/rainy.png',
        'Cloudy': '../assets/cloudy.png',
        'Partly Cloudy': '../assets/cloudy.png',
        'Thunderstorm': '../assets/thunderstorm.png',
        'Storm': '../assets/storm.png'
    };
    for (const key in iconMap) {
        if (condition && condition.toLowerCase().includes(key.toLowerCase())) {
            return iconMap[key];
        }
    }
    return 'assets/cloudy.png';
}

function displayForecast(city) {
    $.ajax({
        url: 'get_forecast.php',
        type: 'POST',
        data: { city: city },
        dataType: 'json',
        success: function(response) {
            const forecastList = document.getElementById('forecastList');
            forecastList.innerHTML = '';
            if (response.success && response.data.length > 0) {
                response.data.forEach(day => {
                    const forecastItem = document.createElement('div');
                    forecastItem.classList.add('forecast-item');
                    const iconSrc = getWeatherIcon(day.condition);
                    forecastItem.innerHTML = `
                        <div class="weather-icon"><img src="${iconSrc}" alt="${day.condition}"></div>
                        <div class="forecast-details">
                            <p class="date">${day.date}</p>
                            <p>${day.condition}</p>
                        </div>
                        <div class="temperature">${day.temperature}</div>
                    `;
                    forecastList.appendChild(forecastItem);
                });
            } else {
                forecastList.innerHTML = '<div style="padding:10px;">No forecast data available.</div>';
            }
        },
        error: function() {
            document.getElementById('forecastList').innerHTML = '<div style="padding:10px;">Error loading forecast.</div>';
        }
    });
}

function showNextDay() {
    currentDayIndex = (currentDayIndex + 1) % forecastData.length;
    const day = forecastData[currentDayIndex];
    document.querySelector('.temperature').textContent = day.temperature;
    document.querySelector('.condition').textContent = day.condition;
    document.querySelector('.info-item:nth-child(1) .progress').style.width = `${parseInt(day.rainChance)}%`;
    document.querySelector('.location-time h3').textContent = `Forecast for ${day.date}`;
    document.querySelector('.location-time p span').textContent = '';
}

$(document).ready(function() {
    $('#searchBtn').click(function() {
        searchWeather();
        const city = $('#cityInput').val().trim() || $('#userLocation').val();
        if (city) displayForecast(city);
    });
});

function searchWeather() {
    const city = $('#cityInput').val().trim();
    const notification = $('#notification');

    if (city === '') {
        notification.text('Please enter a city name').show();
        return;
    }

    $.ajax({
        url: 'get_weather.php',
        type: 'POST',
        data: { city: city },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                updateWeatherUI(response.data);
                notification.text(`Weather updated for ${city}`).show();
            } else {
                notification.text(response.message || 'Failed to fetch weather data').show();
            }
        },
        error: function() {
            notification.text('Error fetching weather data').show();
        }
    });
}

function updateWeatherUI(data) {
    $('.location-time h3').text(data.city);
    $('.temperature').text(data.temperature + '°C');
    $('.condition').text(data.weather_condition);
    $('.overview-item:nth-child(1) span:last-child').text(data.wind_speed + ' km/h');
    $('.overview-item:nth-child(2) span:last-child').text(data.rain_chance + '%');
    $('.overview-item:nth-child(3) span:last-child').text(data.pressure + ' hPa');
    $('.overview-item:nth-child(4) span:last-child').text(data.uv_index);
    $('.info-item:nth-child(1) .progress').css('width', data.rain_chance + '%');
    $('.info-item:nth-child(2) div p:nth-child(1) span').text(formatTime(data.sunrise));
    $('.info-item:nth-child(2) div p:nth-child(2) span').text(formatTime(data.sunset));
}

function formatTime(timeString) {
    return new Date('2000/01/01 ' + timeString).toLocaleTimeString('en-US', {
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
    });
}

function drawChart() {
    const ctx = document.getElementById('temperatureChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Temperature (°C)',
                data: [18, 20, 23, 21],
                borderColor: '#3498db',
                backgroundColor: 'rgba(52, 152, 219, 0.2)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: false,
                    min: 15,
                    max: 25,
                    ticks: { color: '#666' }
                },
                x: { ticks: { color: '#666' } }
            }
        }
    });
}

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('collapsed');
}