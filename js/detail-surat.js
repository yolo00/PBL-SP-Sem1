// Nur Iliyanie
document.addEventListener("DOMContentLoaded", function () {
  const STORAGE_KEY = "suratPeringatan";
  const DETAIL_KEY = "detailSurat";

  const form = document.getElementById("formEditSurat");
  const fileInput = document.getElementById("fileSurat");
  const fileContainer = document.getElementById("fileContainer");
  const fileLabel = document.getElementById("fileLabel");

  // 🔹 Ambil data dari localStorage
  const selected = JSON.parse(localStorage.getItem(DETAIL_KEY));
  const allData = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

  // Jika tidak ada data, balik ke dashboard
  if (!selected) {
    alert("Data surat tidak ditemukan.");
    window.location.href = "dashboard-staf.html";
    return;
  }

  // === ISI FORM ===
  document.getElementById("tingkatSelect").value = selected.tingkat || "";
  document.getElementById("tanggalInput").value = selected.tanggal || "";
  document.getElementById("statusSelect").value = selected.status || "Aktif";
  document.getElementById("namaInput").value = selected.nama || "";
  document.getElementById("nimInput").value = selected.nim || "";
  document.getElementById("prodiInput").value = selected.prodi || "";
  document.getElementById("jurusanInput").value = selected.jurusan || "";
  document.getElementById("kelasInput").value = selected.kelas || "";
  document.getElementById("perihalInput").value = selected.perihal || "";
  document.getElementById("deskripsiInput").value = selected.deskripsi || "";

  // === TAMPILKAN FILE DARI DATA SEBELUMNYA ===
  tampilkanFile(selected);

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
      alert("✅ Perubahan berhasil disimpan!");
    } else {
      alert("❌ Gagal memperbarui data.");
    }

    window.location.href = "dashboard-staf.html";
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
});
