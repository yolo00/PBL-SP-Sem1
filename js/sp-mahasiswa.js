//Michael Sando Turnip
const dataSurat = [ //template data sp
  {
    judul: "Plagiarisme tugas pada mata kuliah IF 102",
    tingkat: "SP I",
    tanggal: "19/10/2025",
    status: "Aktif",
    link: "surat1.html"
  },
  {
    judul: "Ketidakhadiran pada mata kuliah IF 105 tanpa laporan",
    tingkat: "SP I",
    tanggal: "12/08/2025",
    status: "Aktif",
    link: "surat2.html"
  },
//Tambahin sini kalau mau tambah
];

//Kalau data SP kosong 
document.addEventListener("DOMContentLoaded", tampilkanSuratKosong);

function tampilkanSuratKosong() {
  const tabelSP = document.getElementById("tabelSP");
  tabelSP.innerHTML = "";

  if (dataSurat.length === 0) {
    // Jika tidak ada data
    const tr = document.createElement("tr");
    const td = document.createElement("td");
    td.colSpan = 5;
    td.textContent = "Kamu belum menerima surat peringatan apapun";
    td.style.textAlign = "center";
    td.style.padding = "20px";
    td.style.fontWeight = "600";
    td.style.color = "#555";
    tr.appendChild(td);
    tabelSP.appendChild(tr);
    return;
  }
}

function tampilkanSurat() {
  const tabel = document.getElementById("tabelSP");

  // isi tabel dengan baris dari dataSurat
  dataSurat.forEach(surat => {
    const baris = document.createElement("tr");

    baris.innerHTML = `
      <td>${surat.judul}</td>
      <td>${surat.tingkat}</td>
      <td>${surat.tanggal}</td>
      <td><span class="status ${surat.status.toLowerCase()}">${surat.status}</span></td>
      <td><a href="${surat.link}" class="btn-lihat">Lihat</a></td>
    `;

    tabel.appendChild(baris);
  });
}

//Jalankan setelah halaman selesai dimuat
document.addEventListener("DOMContentLoaded", tampilkanSurat);


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


