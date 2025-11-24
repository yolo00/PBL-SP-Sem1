document.addEventListener("DOMContentLoaded", function () {
  // Ambil elemen tombol berdasarkan class
  const detailBtn = document.querySelector(".btn-detail");
  const editBtn = document.querySelector(".btn-edit");
  const logoutBtn = document.querySelector(".btn-logout");

  // Cek dulu apakah tombol-tombol ini ada di halaman
  if (detailBtn) {
    detailBtn.addEventListener("click", function (e) {
      e.preventDefault();
      console.log("Klik tombol Detail SP");
      window.location.href = "detail-surat.html";
    });
  }

  if (editBtn) {
    editBtn.addEventListener("click", function (e) {
      e.preventDefault();
      alert("Fitur edit profil mahasiswa akan segera tersedia!");
    });
  }

  if (logoutBtn) {
    logoutBtn.addEventListener("click", function (e) {
      e.preventDefault();
      const konfirmasi = confirm("Yakin ingin keluar dari akun ini?");
      if (konfirmasi) {
        window.location.href = "backend/logout.php";
      }
    });
  }

  console.log("✅ profil-mahasiswa.js berhasil dimuat!");
});

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

