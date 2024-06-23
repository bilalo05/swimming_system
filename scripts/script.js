// scripts.js
document.addEventListener('DOMContentLoaded', function() {
    // Initially set the body to 'loading' state
    document.body.classList.add('loading');

    // When the page is fully loaded
    window.addEventListener('load', function() {
        // Set a minimum loading time of 3 seconds
        const minLoadingTime = 2000; // 3000 milliseconds = 3 seconds
        const loadEndTime = new Date().getTime();

        // Calculate how much time has passed since the page started loading
        const timeSincePageLoad = loadEndTime - performance.timing.navigationStart;

        // Calculate the remaining time to reach the minimum loading time
        const remainingTime = minLoadingTime - timeSincePageLoad;

        // Ensure the remaining time is not negative
        const delayTime = Math.max(0, remainingTime);

        // Delay hiding the loading animation
        setTimeout(function() {
            document.body.classList.remove('loading');
            document.body.classList.add('loaded');
        }, delayTime);
    });
});
