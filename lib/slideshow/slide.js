document.addEventListener('DOMContentLoaded', function() {
  function initSlideshow(slideshowId) {
      var slideshowContainer = document.getElementById(slideshowId);
      var slides = slideshowContainer.getElementsByClassName('slideshow-image');
      var currentIndex = 0;

      function showNextSlide() {
          slides[currentIndex].style.display = 'none';
          currentIndex = (currentIndex + 1) % slides.length;
          slides[currentIndex].style.display = 'block';
      }

      // Initially show the first slide
      slides[currentIndex].style.display = 'block';

      // Set the interval for changing images
      setInterval(showNextSlide, 3000); // Change image every 3 seconds
  }

  // Initialize slideshow for each card
  initSlideshow('community-o');
  initSlideshow('community-w');
  initSlideshow('youth-m');
  initSlideshow('share-v');
  initSlideshow('ml-action');
});