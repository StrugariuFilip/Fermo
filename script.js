 document.addEventListener('DOMContentLoaded', function() {
  const hamburgerMenu = document.querySelector('.hamburger-menu');
  const dropdownMenu = document.querySelector('.dropdown-menu');

  hamburgerMenu.addEventListener('click', function() {
    dropdownMenu.classList.toggle('active');
  });

  window.addEventListener('resize', function() {
    if (window.innerWidth > 1200) {
      dropdownMenu.classList.remove('active');
    }
  });
});