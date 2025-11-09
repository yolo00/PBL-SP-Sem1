document.addEventListener("DOMContentLoaded", function () {
  const STORAGE_KEY = "suratPeringatan";
  const DETAIL_KEY = "detailSurat";
  const form = document.getElementById("formPeringatan");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const fileInput = document.getElementById("fileSurat");
    const file = fileInput.files[0];

    const newData = {
      tingkat: document.getElementById("tingkatSelect").value,
      tanggal: document.getElementById("tanggalInput").value,
      nama: document.getElementById("namaInput").value,
      nim: document.getElementById("nimInput").value,
      prodi: document.getElementById("prodiInput").value,
      jurusan: document.getElementById("jurusanInput")?.value || "",
      kelas: document.getElementById("kelasInput")?.value || "",
      perihal: document.getElementById("perihalInput")?.value || "",
      deskripsi: document.getElementById("deskripsiInput")?.value || "",
      status: "Aktif",
      file: "",
      fileName: "",
      fileType: "",
    };

    // Baca file kalau ada
    if (file) {
      const reader = new FileReader();
      reader.onload = function (event) {
        newData.file = event.target.result;
        newData.fileName = file.name;
        newData.fileType = file.type;
        simpanData(newData);
      };
      reader.readAsDataURL(file);
    } else {
      simpanData(newData);
    }
  });

  function simpanData(data) {
    const allData = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
    allData.push(data);

    localStorage.setItem(STORAGE_KEY, JSON.stringify(allData));
    localStorage.setItem(DETAIL_KEY, JSON.stringify(data)); // ⬅ simpan data baru juga ke detail

    alert("✅ Surat peringatan baru berhasil ditambahkan!");
    window.location.href = "detail-surat.html"; // langsung ke detail agar langsung bisa dilihat
  }
});
