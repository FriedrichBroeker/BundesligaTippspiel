document.getElementById('theme-toggle').addEventListener('click', function() {
    var themeLink = document.getElementById('theme-link');
    var logoImg = document.getElementById('logo-img');

    if (themeLink.getAttribute('href') == 'style.css') {
        themeLink.setAttribute('href', 'darkstyle.css');
        logoImg.setAttribute('src', 'darklogo.png'); // Set to dark mode logo
    } else {
        themeLink.setAttribute('href', 'style.css');
        logoImg.setAttribute('src', 'logo.png'); // Set back to light mode logo
    }
});
