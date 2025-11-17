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

  // Jika tidak ada data, balik ke dashboard
  if (!selected) {
    alert("Data surat tidak ditemukan.");
    window.location.href = "dashboard-staf.html";
    return;
  }


  // === POPULATE PREVIEW FROM SELECTED DATA ===
  // Update header
  if (namaMahasiswaHeader) namaMahasiswaHeader.textContent = selected.nama || "Nama Mahasiswa";

  // Fill preview spans safely (only if present in DOM)
  const setText = (id, value) => {
    const el = document.getElementById(id);
    if (el) el.textContent = value || "-";
  };

  setText('previewNama', selected.nama);
  setText('previewNim', selected.nim);
  setText('previewProdi', selected.prodi);
  setText('previewJurusan', selected.jurusan);
  setText('previewKelas', selected.kelas);
  setText('previewStatus', selected.status);
  setText('previewTingkat', selected.tingkat);
  setText('previewTanggal', selected.tanggal);
  setText('previewPerihal', selected.perihal);
  setText('previewDeskripsi', selected.deskripsi);
  setText('previewFile', selected.fileName);

  // Show file link area if applicable
  if (fileContainer) {
    if (selected.file && selected.fileName) {
      fileContainer.innerHTML = '';
      const link = document.createElement('a');
      link.href = selected.file;
      link.download = selected.fileName;
      link.textContent = `📎 Unduh ${selected.fileName}`;
      link.classList.add('download-link');
      fileContainer.appendChild(link);
      if (fileLabel) fileLabel.textContent = `File: ${selected.fileName}`;
    } else if (fileContainer) {
      fileContainer.innerHTML = "<p style='color:#666;'>Belum ada file surat diunggah.</p>";
    }
  }

  // === SAAT FORM DISUBMIT (EDIT) ===
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const updated = {
      tingkat: document.getElementById("tingkatSelect").value,
      tanggal: document.getElementById("tanggalInput").value,
      status: document.getElementById("statusSelect").value,
      nama: document.getElementById("namaInput").value,
      nim: document.getElementById("nimInput").value,
      prodi: document.getElementById("prodiInput").value,
      jurusan: document.getElementById("jurusanInput").value,
      kelas: document.getElementById("kelasInput").value,
      perihal: document.getElementById("perihalInput").value,
      deskripsi: document.getElementById("deskripsiInput").value,
      file: selected.file || null,
      fileName: selected.fileName || null,
      fileType: selected.fileType || null,
    };

    // Kalau staf upload file baru di sini (opsional)
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
    const index = allData.findIndex((d) => d.nim === selected.nim);
    if (index !== -1) {
      allData[index] = updated;
      localStorage.setItem(STORAGE_KEY, JSON.stringify(allData));
      localStorage.setItem(DETAIL_KEY, JSON.stringify(updated));
      alert("✅ Surat Peringatan berhasil diperbarui!");
      window.location.href = "dashboard-staf.html";
    } else {
      alert("❌ Gagal memperbarui data.");
    }
  }

  // === FUNGSI TAMPILKAN FILE ===
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

  // === FUNGSI UPDATE HEADER NAMA ===
  function updateHeaderName() {
    const nama = namaInput.value || "Nama Mahasiswa";
    namaMahasiswaHeader.textContent = nama;
  }

  // === UPDATE PREVIEW ===
  function updatePreview() {
    document.getElementById("previewNama").textContent = document.getElementById("namaInput").value || "-";
    document.getElementById("previewNim").textContent = document.getElementById("nimInput").value || "-";
    document.getElementById("previewProdi").textContent = document.getElementById("prodiInput").value || "-";
    document.getElementById("previewJurusan").textContent = document.getElementById("jurusanInput").value || "-";
    document.getElementById("previewKelas").textContent = document.getElementById("kelasInput").value || "-";
    document.getElementById("previewStatus").textContent = document.getElementById("statusSelect").value || "-";
    document.getElementById("previewTingkat").textContent = document.getElementById("tingkatSelect").value || "-";
    document.getElementById("previewTanggal").textContent = document.getElementById("tanggalInput").value || "-";
    document.getElementById("previewPerihal").textContent = document.getElementById("perihalInput").value || "-";
    document.getElementById("previewDeskripsi").textContent = document.getElementById("deskripsiInput").value || "-";
    
    const fileName = fileInput?.files?.[0]?.name || (selected.fileName || "-");
    document.getElementById("previewFile").textContent = fileName;

    // Update detail surat preview
    updateDetailSurat();
  }

  // === UPDATE DETAIL SURAT ===
  function updateDetailSurat() {
    document.getElementById("detailTingkat").textContent = document.getElementById("tingkatSelect").value || "-";
    document.getElementById("detailTanggal").textContent = document.getElementById("tanggalInput").value || "-";
    document.getElementById("detailNamaSurat").textContent = document.getElementById("namaInput").value || "-";
    document.getElementById("detailNimSurat").textContent = document.getElementById("nimInput").value || "-";
    document.getElementById("detailProdiSurat").textContent = document.getElementById("prodiInput").value || "-";
    document.getElementById("detailJurusanSurat").textContent = document.getElementById("jurusanInput").value || "-";
    document.getElementById("detailKelasSurat").textContent = document.getElementById("kelasInput").value || "-";
    document.getElementById("detailPerihalSurat").textContent = document.getElementById("perihalInput").value || "-";
    document.getElementById("detailDeskripsiSurat").textContent = document.getElementById("deskripsiInput").value || "-";
  }

  // === TOMBOL EDIT SURAT ===
  const btnEditSurat = document.getElementById("btnEditSurat");
  if (btnEditSurat) {
    btnEditSurat.addEventListener("click", function(e) {
      e.preventDefault();
      // Simpan selected data kembali ke DETAIL_KEY (ensures edit page will load it)
      localStorage.setItem(DETAIL_KEY, JSON.stringify(selected));
      window.location.href = "edit_surat.html";
    });
  }
});