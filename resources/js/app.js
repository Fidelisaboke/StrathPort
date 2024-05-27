import './bootstrap';

// Locks the screen until the page is loaded
document.addEventListener('DOMContentLoaded', function () {
    // Check for inactivity - no mouse movement, keyboard input, touch input, page reload
    let inactivityTime = function () {
        let time;
        window.onload = resetTimer;
        window.onmousemove = resetTimer;
        window.onmousedown = resetTimer;  // catches touchscreen presses
        window.ontouchstart = resetTimer; // catches touchscreen swipes
        window.ontouchmove = resetTimer;  // required by some devices
        window.onclick = resetTimer;      // catches touchpad clicks
        window.onkeydown = resetTimer;    // catches keyboard presses

        // Redirect to the lock screen
        function lockScreen() {
            window.location.href = '/lock';
        }

        // Reset the lockScreen timeout
        function resetTimer() {
            clearTimeout(time);
            time = setTimeout(lockScreen, 300000);
        }
    };

    // Monitor inactivity
    inactivityTime();

    // Lock screen button
    document.getElementById('lock-screen-button').addEventListener('click', function () {
        window.location.href = '/lock';
    });
});

