/**
 * Simple Video Play - Just makes video play
 */

(function() {
    'use strict';

    function playVideo() {
        const video = document.querySelector('.hero-bg-video');
        
        if (!video) {
            return;
        }

        video.play().catch(error => {
            console.log('Video play failed');
        });
    }

    // Run when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', playVideo);
    } else {
        playVideo();
    }
    
})();
