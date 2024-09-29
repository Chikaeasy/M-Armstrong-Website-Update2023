document.querySelectorAll('audio').forEach(audio => {
  const container = audio.parentNode;
  const playButton = document.createElement('button');
  playButton.innerHTML = 'Play';
  playButton.className = 'btn btn-primary';
  playButton.addEventListener('click', () => {
      if (audio.paused) {
          audio.play();
          playButton.innerHTML = 'Pause';
      } else {
          audio.pause();
          playButton.innerHTML = 'Play';
      }
  });
  container.appendChild(playButton);
  audio.style.display = 'none';
});