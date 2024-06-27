/*
 * Lock screen functionality for lock.blade.php
 */
document.addEventListener("DOMContentLoaded", function () {
    // Check for inactivity - no mouse movement, keyboard input, touch input, page reload
    let inactivityTime = function () {
        let time;
        window.onload = resetTimer;
        window.onmousemove = resetTimer;
        window.onmousedown = resetTimer;
        window.ontouchstart = resetTimer;
        window.ontouchmove = resetTimer;
        window.onclick = resetTimer;
        window.onkeydown = resetTimer;

        function lockScreen() {
            window.location.href = "/lock";
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
    document
        .getElementById("lock-screen-button")
        .addEventListener("click", function () {
            window.location.href = "/lock";
        });
});
