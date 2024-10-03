document.addEventListener('DOMContentLoaded', function() {
  var carousel = new bootstrap.Carousel(document.getElementById('radioHostingCarousel'), {
      interval: false,
      wrap: true
  });

  document.getElementById('radioHostingCarousel').addEventListener('slide.bs.carousel', function () {
      document.querySelectorAll('audio').forEach(function(audio) {
          audio.pause();
      });
  });
});