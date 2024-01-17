function validateTimeRange() {
    var timeDesc = document.getElementById('time-desc').value;
    var errorElement = document.querySelector('.time-desc-err');

    // Define a regex pattern for the time range format
    var pattern = /^\d{2}\.\d{2} [APMapm]{2}-\d{2}\.\d{2} [APMapm]{2}$/;

    // Check if the input matches the pattern
    if (pattern.test(timeDesc)) {
        errorElement.innerHTML = '';
        return true; // Allow form submission
    } else {
        errorElement.innerHTML = 'Invalid time range format. Please use the format HH.MM AM/PM-HH.MM AM/PM';
        return false; // Prevent form submission
    }
}