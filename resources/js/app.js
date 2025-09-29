import './bootstrap';
import './bootstrap';
document.addEventListener('DOMContentLoaded', () => {
  const root = document.getElementById('hero-carousel');
  if (!root) return;

  const track = root.querySelector('.carousel-track');
  const slides = Array.from(root.querySelectorAll('.carousel-slide'));
  const prevBtn = root.querySelector('.prev');
  const nextBtn = root.querySelector('.next');
  const dotsWrap = root.querySelector('.carousel-dots');

  let index = 0;
  let timer = null;
  const intervalMs = 5000;

  // crear dots
  slides.forEach((_, i) => {
    const b = document.createElement('button');
    b.setAttribute('aria-label', `Ir al slide ${i + 1}`);
    b.addEventListener('click', () => goTo(i, true));
    dotsWrap.appendChild(b);
  });

  function updateUI() {
    track.style.transform = `translateX(-${index * 100}%)`;
    dotsWrap.querySelectorAll('button').forEach((b, i) =>
      b.classList.toggle('is-active', i === index)
    );
  }

  function goTo(i, pause = false) {
    index = (i + slides.length) % slides.length;
    updateUI();
    if (pause) restart();
  }

  function next() { goTo(index + 1, true); }
  function prev() { goTo(index - 1, true); }

  function start() {
    timer = setInterval(() => goTo(index + 1), intervalMs);
  }
  function stop() { clearInterval(timer); }
  function restart() { stop(); start(); }

  nextBtn.addEventListener('click', next);
  prevBtn.addEventListener('click', prev);

  // pausa al pasar mouse
  root.addEventListener('mouseenter', stop);
  root.addEventListener('mouseleave', start);

  updateUI();
  start();
});
