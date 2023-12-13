// Function to toggle the theme and update local storage
function toggleTheme() {
    var themeLink = document.getElementById('theme-link');
    var logos = document.querySelectorAll('.bundesliga-logo');

    if (themeLink.getAttribute('href') == 'style.css') {
        themeLink.setAttribute('href', 'darkstyle.css');
        logos.forEach(function(logo) {
            logo.setAttribute('src', 'darklogo.png'); // Set to dark mode logo
        });
        localStorage.setItem('theme', 'dark');
    } else {
        themeLink.setAttribute('href', 'style.css');
        logos.forEach(function(logo) {
            logo.setAttribute('src', 'logo.png'); // Set back to light mode logo
        });
        localStorage.setItem('theme', 'light');
    }
}

// Event listener for the theme toggle button
document.getElementById('theme-toggle').addEventListener('click', toggleTheme);

// Apply the saved theme when the page loads
document.addEventListener('DOMContentLoaded', function() {
    var currentTheme = localStorage.getItem('theme');
    var logos = document.querySelectorAll('.bundesliga-logo');

    if (currentTheme === 'dark') {
        document.getElementById('theme-link').setAttribute('href', 'darkstyle.css');
        logos.forEach(function(logo) {
            logo.setAttribute('src', 'darklogo.png');
        });
    }
});
