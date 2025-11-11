const sidebar = document.getElementById('sidebar');
const toggle = document.getElementById('sidebarToggle');
const closeBtn = document.getElementById('sidebarClose');

// buka/tutup sidebar
toggle.addEventListener('click', () => {
  const open = sidebar.classList.toggle('open');
  toggle.setAttribute('aria-expanded', open);
});

closeBtn.addEventListener('click', () => {
  sidebar.classList.remove('open');
  toggle.setAttribute('aria-expanded', 'false');
});

// Klik di luar sidebar menutup
document.addEventListener('click', (e) => {
  if (!sidebar.classList.contains('open')) return;
  if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
    sidebar.classList.remove('open');
    toggle.setAttribute('aria-expanded', 'false');
  }
});
