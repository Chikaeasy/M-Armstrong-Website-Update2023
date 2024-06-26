document.addEventListener('DOMContentLoaded', function() {
  const banner = document.querySelector('.moving-banner');
  banner.style.animation = 'none';
  banner.offsetHeight; // Trigger reflow
  banner.style.animation = null;
});
