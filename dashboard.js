// Initialize dashboard
document.addEventListener('DOMContentLoaded', () => {
    const username = localStorage.getItem('username') || 'User';
    document.getElementById('username').textContent = username;
    drawChart();
    displayForecast();
    document.addEventListener('click', closeDropdownOnOutsideClick);
});

function toggleDropdown(event) {
    const dropdown = document.getElementById('userDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    event.stopPropagation();
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
    window.location.href = 'index.html';
}

const forecastData = [
    { date: 'May 06, 2025', temperature: '22°C', condition: 'Sunny', rainChance: '10%' },
    { date: 'May 07, 2025', temperature: '23°C', condition: 'Partly Cloudy', rainChance: '15%' },
    { date: 'May 08, 2025', temperature: '21°C', condition: 'Rainy', rainChance: '60%' },
    { date: 'May 09, 2025', temperature: '19°C', condition: 'Cloudy', rainChance: '30%' },
    { date: 'May 10, 2025', temperature: '24°C', condition: 'Sunny', rainChance: '5%' },
    { date: 'May 11, 2025', temperature: '20°C', condition: 'Thunderstorm', rainChance: '70%' },
    { date: 'May 12, 2025', temperature: '22°C', condition: 'Partly Cloudy', rainChance: '20%' }
];

let currentDayIndex = 0;

function getWeatherIcon(condition) {
    const iconMap = {
        'Sunny': 'assets/sunny.png',
        'Rainy': 'assets/rainy.png',
        'Cloudy': 'assets/cloudy.png',
        'Partly Cloudy': 'assets/cloudy.png',
        'Thunderstorm': 'assets/rainy.png',
        'Dramatic Cloudy': 'assets/cloudy.png'
    };
    return iconMap[condition] || 'assets/cloudy.png';
}

function displayForecast() {
    const forecastList = document.getElementById('forecastList');
    forecastList.innerHTML = '';
    forecastData.forEach(day => {
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

function searchWeather() {
    const cityInput = document.getElementById('cityInput').value.trim();
    const notification = document.getElementById('notification');
    const savedLocation = JSON.parse(localStorage.getItem('selectedLocation')) || { name: 'Tripura, India', lat: 23.64, lon: 91.34 };

    notification.style.display = 'none';
    notification.textContent = '';

    let city = cityInput || savedLocation.name;

    if (city === '') {
        notification.textContent = 'Please enter a city name';
        notification.style.display = 'block';
        return;
    }

    // Placeholder weather data (replace with API call)
    const weatherData = {
        city: city,
        temperature: '20°C',
        condition: 'Dramatic Cloudy',
        humidity: '65%',
        wind: '12 km/h',
        rainChance: '24%',
        pressure: '720 hPa',
        uvIndex: '2.3',
        time: '08:54 AM',
        sunrise: '4:20 AM',
        sunset: '5:50 PM'
    };

    document.querySelector('.location-time h3').textContent = weatherData.city;
    document.querySelector('.location-time p span').textContent = weatherData.time;
    document.querySelector('.temperature').textContent = weatherData.temperature;
    document.querySelector('.condition').textContent = weatherData.condition;
    document.querySelector('.overview-item:nth-child(1) span:last-child').textContent = weatherData.wind;
    document.querySelector('.overview-item:nth-child(2) span:last-child').textContent = weatherData.rainChance;
    document.querySelector('.overview-item:nth-child(3) span:last-child').textContent = weatherData.pressure;
    document.querySelector('.overview-item:nth-child(4) span:last-child').textContent = weatherData.uvIndex;
    document.querySelector('.info-item:nth-child(1) .progress').style.width = `${parseInt(weatherData.rainChance)}%`;
    document.querySelector('.info-item:nth-child(2) div p:nth-child(1) span').textContent = weatherData.sunrise;
    document.querySelector('.info-item:nth-child(2) div p:nth-child(2) span').textContent = weatherData.sunset;

    notification.textContent = `Weather updated for ${city}`;
    notification.style.display = 'block';
    drawChart();
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