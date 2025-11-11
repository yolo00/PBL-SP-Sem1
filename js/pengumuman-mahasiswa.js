// pengumuman-mahasiswa.js (versi fixed)

document.addEventListener('DOMContentLoaded', () => {
  // --- sidebar toggle & control ---
  const sidebar = document.getElementById('sidebar');
  const toggle = document.getElementById('sidebarToggle');
  const closeBtn = document.getElementById('sidebarClose'); // mungkin null jika tidak ada

  function openSidebar() {
    if (!sidebar) return;
    sidebar.classList.add('open');
    if (toggle) toggle.classList.add('shift');
    if (toggle) toggle.setAttribute('aria-expanded', 'true');
    sidebar.setAttribute('aria-hidden', 'false');
  }
  function closeSidebar() {
    if (!sidebar) return;
    sidebar.classList.remove('open');
    if (toggle) toggle.classList.remove('shift');
    if (toggle) toggle.setAttribute('aria-expanded', 'false');
    sidebar.setAttribute('aria-hidden', 'true');
  }

  if (toggle) {
    toggle.addEventListener('click', (e) => {
      e.stopPropagation();
      if (sidebar && sidebar.classList.contains('open')) closeSidebar();
      else openSidebar();
    });
  }

  if (closeBtn) {
    closeBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      closeSidebar();
    });
  }

  // Klik di luar sidebar menutupnya
  document.addEventListener('click', (e) => {
    if (!sidebar || !sidebar.classList.contains('open')) return;
    const isClickInside = sidebar.contains(e.target) || (toggle && toggle.contains(e.target));
    if (!isClickInside) closeSidebar();
  });

  // Esc tutup
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && sidebar && sidebar.classList.contains('open')) {
      closeSidebar();
    }
  });

  // --- data pengumuman & rendering ---
  const pengumumanData = [
    {
      judul: "Peluncuran SP Terhadap Absensi Pada Kuartal 3",
      subjudul: "Bentuk penanganan mahasiswa absesni bermasalah selama periode setengah semester saat ini.",
      tanggal: "2025-11-02",
      link: "#"
    }
  ];

  function formatTanggal(isoDateStr) {
    try {
      const d = new Date(isoDateStr);
      const opsi = { day: 'numeric', month: 'long', year: 'numeric' };
      return d.toLocaleDateString('id-ID', opsi);
    } catch (e) {
      return isoDateStr;
    }
  }

  const grid = document.getElementById('announcementsGrid');
  if (!grid) return; // safety

  grid.innerHTML = '';

  if (!Array.isArray(pengumumanData) || pengumumanData.length === 0) {
    const empty = document.createElement('div');
    empty.className = 'announcement-empty';
    empty.textContent = 'Belum ada pengumuman saat ini.';
    grid.appendChild(empty);
  } else {
    pengumumanData.forEach(item => {
      const card = document.createElement('article');
      card.className = 'announcement-card';
      card.setAttribute('role', 'article');
      card.setAttribute('aria-label', item.judul || 'Pengumuman');

      card.innerHTML = `
        <div>
          <h3 class="title">${item.judul}</h3>
        <hr class="pemisah">
          <p class="subtitle">${item.subjudul}</p>
        </div>
        <div class="meta">
          <div></div>
          <div class="date">${formatTanggal(item.tanggal)}</div>
        </div>
      `;

      if (item.link && item.link !== '#') {
        card.style.cursor = 'pointer';
        card.addEventListener('click', () => window.location.href = item.link);
      }

      grid.appendChild(card);
    });
  }

});
