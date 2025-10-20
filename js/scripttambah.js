// script3.js - untuk tambah-surat.html
document.addEventListener("DOMContentLoaded", function () {
  const STORAGE_KEY = "suratPeringatan";
  const form = document.getElementById("formPeringatan");
  const namaEl = document.getElementById("namaInput");
  const nimEl = document.getElementById("nimInput");
  const prodiEl = document.getElementById("prodiInput");
  const tingkatEl = document.getElementById("tingkatSelect");
  const tanggalEl = document.getElementById("tanggalInput");

  function getData() {
    return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
  }
  function saveData(arr) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(arr));
  }

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const nama = namaEl.value.trim();
    const nim = nimEl.value.trim();
    const prodi = prodiEl.value.trim();
    const tingkat = tingkatEl.value;
    const tanggal = tanggalEl.value;

    if (!nama || !nim || !prodi || !tingkat || !tanggal) {
      alert("Harap isi semua field yang wajib sebelum mengirim.");
      return;
    }

    // Buat objek data baru, status otomatis "Aktif"
    const newItem = {
      id: Date.now(), // id unik
      nama: nama,
      nim: nim,
      prodi: prodi,
      tingkat: tingkat,
      tanggal: tanggal,
      status: "Aktif"
    };

    const data = getData();
    data.push(newItem);
    saveData(data);

    // Beri notifikasi lalu kembali ke halaman kelola
    alert("Surat peringatan berhasil ditambahkan.");
    // arahkan kembali ke halaman kelola (sesuaikan URL bila perlu)
    window.location.href = "kelola-staf.html";
  });
});
