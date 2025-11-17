document.addEventListener("DOMContentLoaded", function () {
  const STORAGE_KEY = "suratPeringatan";
  const DETAIL_KEY = "detailSurat";

  const form = document.getElementById("formEditSurat");
  const fileInput = document.getElementById("fileSurat");
  const fileContainer = document.getElementById("fileContainer");
  const fileLabel = document.getElementById("fileLabel");
  const namaInput = document.getElementById("namaInput");
  const namaMahasiswaHeader = document.getElementById("namaMahasiswaHeader");

  // 🔹 Ambil data dari localStorage
  const selected = JSON.parse(localStorage.getItem(DETAIL_KEY));
  const allData = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

  // Jika tidak ada data, balik ke Kelola
  if (!selected) {
    alert("Data surat tidak ditemukan. Silakan pilih surat dari halaman Kelola atau Tambah surat baru.");
    window.location.href = "kelola-staf.html";
    return;
  }

  // === ISI FORM DENGAN DATA DARI LOCALSTORAGE ===
  function isiFormDariData() {
    document.getElementById("tingkatSelect").value = selected.tingkat || "";
    document.getElementById("tanggalInput").value = selected.tanggal || "";
    document.getElementById("namaInput").value = selected.nama || "";
    document.getElementById("nimInput").value = selected.nim || "";
    document.getElementById("prodiInput").value = selected.prodi || "";
    document.getElementById("jurusanInput").value = selected.jurusan || "";
    document.getElementById("kelasInput").value = selected.kelas || "";
    document.getElementById("perihalInput").value = selected.perihal || "";
    document.getElementById("deskripsiInput").value = selected.deskripsi || "";
    
    // Update header dengan nama mahasiswa
    updateHeaderName();
    
    // Tampilkan file jika ada
    tampilkanFile(selected);
  }

  // Panggil fungsi pengisian form
  isiFormDariData();

  // === UPDATE HEADER NAMA SAAT INPUT BERUBAH ===
  function updateHeaderName() {
    const nama = namaInput.value || "Nama Mahasiswa";
    namaMahasiswaHeader.textContent = nama;
  }

  namaInput.addEventListener("input", updateHeaderName);

  // === TAMPILKAN FILE DARI DATA SEBELUMNYA ===
  function tampilkanFile(data) {
    if (data.file && data.fileName) {
      fileContainer.innerHTML = "";
      const link = document.createElement("a");
      link.href = data.file;
      link.download = data.fileName;
      link.textContent = `📎 Unduh ${data.fileName}`;
      link.classList.add("download-link");
      fileContainer.appendChild(link);
      fileLabel.textContent = `File: ${data.fileName}`;
    } else {
      fileContainer.innerHTML = "<p style='color:#666;'>Belum ada file surat diunggah.</p>";
    }
  }

  // === SAAT FILE BARU DIPILIH ===
  fileInput.addEventListener("change", function() {
    const fileName = fileInput.files[0]?.name || "-";
    fileLabel.textContent = `File dipilih: ${fileName}`;
  });

  // === SAAT FORM DISUBMIT (UPDATE) ===
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const updated = {
      tingkat: document.getElementById("tingkatSelect").value,
      tanggal: document.getElementById("tanggalInput").value,
      nama: document.getElementById("namaInput").value,
      nim: document.getElementById("nimInput").value,
      prodi: document.getElementById("prodiInput").value,
      jurusan: document.getElementById("jurusanInput").value,
      kelas: document.getElementById("kelasInput").value,
      perihal: document.getElementById("perihalInput").value,
      deskripsi: document.getElementById("deskripsiInput").value,
      status: selected.status || "Aktif",
      file: selected.file || null,
      fileName: selected.fileName || null,
      fileType: selected.fileType || null,
    };

    // Jika staf upload file baru di sini (opsional)
    const file = fileInput?.files?.[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (event) {
        updated.file = event.target.result;
        updated.fileName = file.name;
        updated.fileType = file.type;
        simpanPerubahan(updated);
      };
      reader.readAsDataURL(file);
    } else {
      simpanPerubahan(updated);
    }
  });

  // === FUNGSI SIMPAN PERUBAHAN ===
  function simpanPerubahan(updated) {
    // Cari index berdasarkan NIM
    const index = allData.findIndex((d) => d.nim === selected.nim);
    
    if (index !== -1) {
      // Update data yang sudah ada
      allData[index] = updated;
      localStorage.setItem(STORAGE_KEY, JSON.stringify(allData));
      localStorage.setItem(DETAIL_KEY, JSON.stringify(updated));
      alert("✅ Surat Peringatan berhasil diperbarui!");
      window.location.href = "kelola-staf.html";
    } else {
      // Jika tidak ditemukan di array, tambahkan sebagai data baru
      allData.push(updated);
      localStorage.setItem(STORAGE_KEY, JSON.stringify(allData));
      localStorage.setItem(DETAIL_KEY, JSON.stringify(updated));
      alert("✅ Surat Peringatan berhasil disimpan!");
      window.location.href = "kelola-staf.html";
    }
  }

  // === TOMBOL BATAL ===
  const btnBatal = document.querySelector(".btn-batal");
  if (btnBatal) {
    btnBatal.addEventListener("click", function (e) {
      e.preventDefault();
      window.location.href = "kelola-staf.html";
    });
  }
});
