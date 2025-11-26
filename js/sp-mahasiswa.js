// sp-mahasiswa.js (diperbaiki)
// Michael Sando Turnip

// Template versi sebelumnya.
const localFallbackData = [
  {
    perihal: "Plagiarisme tugas pada mata kuliah IF 102",
    tingkat: "SP I",
    tanggal: "19/10/2025",
    status: "Aktif",
    file: "surat1.html"
  },
  {
    perihal: "Ketidakhadiran pada mata kuliah IF 105 tanpa laporan",
    tingkat: "SP I",
    tanggal: "12/08/2025",
    status: "Aktif",
    file: "surat2.html"
  }
];

async function tampilkanSurat() {
  const tabel = document.getElementById("tabelSP");
  if (!tabel) return;

  // Clear table
  tabel.innerHTML = '';

  try {
    const resp = await fetch('./backend/get-sp.php', {
      method: 'GET',
      credentials: 'same-origin'
    });

    if (!Array.isArray(dataSurat) || dataSurat.length === 0) {
      const row = document.createElement('tr');
      row.innerHTML = `<td colspan="5">Belum ada surat untukmu.</td>`;
      tabel.appendChild(row);
      return;
    }

    dataSurat.forEach(surat => {
      const perihal = surat.perihal || '';
      const tingkat = surat.tingkat || '';
      const tanggal = surat.tanggal || '';
      const status  = surat.status || '';
      const fileUrl = surat.file || '#';

      const baris = document.createElement("tr");
      baris.innerHTML = `
        <td>${escapeHtml(perihal)}</td>
        <td>${escapeHtml(tingkat)}</td>
        <td>${escapeHtml(tanggal)}</td>
        <td><span class="status ${escapeClass(status)}">${escapeHtml(status)}</span></td>
        <td><a href="${encodeURI(fileUrl)}" class="btn-lihat" target="_blank" rel="noopener">Lihat</a></td>
      `;
      tabel.appendChild(baris);
    });

  } catch (err) {
    console.error('Error fetch:', err);
    const row = document.createElement('tr');
    row.innerHTML = `<td colspan="5">Terjadi kesalahan saat memuat data.</td>`;
    tabel.appendChild(row);
  }
}

// fungsi kecil untuk mencegah XSS
function escapeHtml(str) {
  if (typeof str !== 'string') return '';
  return str
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}

// untuk kelas CSS status aman
function escapeClass(str) {
  if (typeof str !== 'string') return '';
  return str.toLowerCase().replace(/[^a-z0-9\-_]/g, '-');
}

// Jalankan setelah halaman selesai dimuat
document.addEventListener('DOMContentLoaded', tampilkanSurat);

//Sidebar
const sidebar = document.getElementById('sidebar');
const toggle = document.getElementById('sidebarToggle');
const closeBtn = document.getElementById('sidebarClose');

if (toggle) {
  toggle.addEventListener('click', () => {
    if (!sidebar) return;
    const open = sidebar.classList.toggle('open');
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
  });
}

if (closeBtn) {
  closeBtn.addEventListener('click', () => {
    if (!sidebar) return;
    sidebar.classList.remove('open');
    if (toggle) toggle.setAttribute('aria-expanded', 'false');
  });
}

// Klik di luar sidebar menutup (guard)
document.addEventListener('click', (e) => {
  if (!sidebar || !sidebar.classList.contains('open')) return;
  if (!sidebar.contains(e.target) && (!(toggle && toggle.contains(e.target)))) {
    sidebar.classList.remove('open');
    if (toggle) toggle.setAttribute('aria-expanded', 'false');
  }
});
