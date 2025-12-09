// Mobile Navigation
const btnNav = document.querySelector('.btn-mobile-nav'); // nút bật/tắt điều hướng di động
const header = document.querySelector('header'); // phần đầu trang header

btnNav.addEventListener('click', function() { // Khi nhấn nút điều hướng di động
  header.classList.toggle('nav-open');
});

// Sticky Navigation thanh điều hướng 
const sectionHero = document.querySelector('.section-hero');
const obs = new IntersectionObserver(  // theo dõi vị trí của phần đầu trang sectionHero
  function(entries) {
    const ent = entries[0];
    if (!ent.isIntersecting) {
      document.body.classList.add('sticky');
    } else {
      document.body.classList.remove('sticky');
    }
  },
  {
    // In the viewport
    root: null,
    threshold: 0,
    rootMargin: '-80px' // Height of the sticky header
  }
);
obs.observe(sectionHero);

