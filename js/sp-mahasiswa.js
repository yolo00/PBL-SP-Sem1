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
    tanggal: "12/08/2024",
    status: "Kadaluarsa",
    link: "surat2.html"
  },
//Tambahin sini kalau mau tambah
];

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
      <td><a href="${surat.link}" class="btn">Lihat</a></td>
    `;

    tabel.appendChild(baris);
  });
}

//Jalankan setelah halaman selesai dimuat
document.addEventListener("DOMContentLoaded", tampilkanSurat);
