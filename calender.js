// Initialize calendar
document.addEventListener('DOMContentLoaded', () => {
    const username = localStorage.getItem('username') || 'User';
    document.getElementById('username').textContent = username;

    // Populate location dropdown
    populateLocationDropdown();

    // Render initial calendar
    renderCalendar(new Date());
});

// Populate location dropdown from localStorage (users or selectedLocation)
function populateLocationDropdown() {
    const locationSelect = document.getElementById('locationSelect');
    const users = JSON.parse(localStorage.getItem('users')) || [];
    const savedLocation = JSON.parse(localStorage.getItem('selectedLocation')) || { name: 'Tripura, India' };
    const locations = [savedLocation.name, ...users.map(user => user.location)].filter((loc, index, self) => self.indexOf(loc) === index); // Unique locations

    locations.forEach(location => {
        const option = document.createElement('option');
        option.value = location;
        option.textContent = location;
        locationSelect.appendChild(option);
    });

    // Set default to saved location or first user location
    locationSelect.value = savedLocation.name || (users.length > 0 ? users[0].location : 'Tripura, India');
}

function updateLocation() {
    const locationSelect = document.getElementById('locationSelect');
    const selectedLocation = locationSelect.value;
    localStorage.setItem('selectedLocation', JSON.stringify({ name: selectedLocation }));
    renderCalendar(currentDate); // Re-render calendar with updated location (placeholder for weather integration)
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