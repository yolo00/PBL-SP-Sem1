// Daftar Prodi berdasarkan Jurusan
const daftarProdi = {
  mb: [
    "D3 Akuntansi",
    "Sarjana Terapan Akuntansi Manajerial",
    "Sarjana Terapan Administrasi Bisnis Terapan",
    "Sarjana Terapan Logistik Perdagangan Internasional",
    "D2 Distribusi Barang"
  ],
  te: [
    "D3 Teknik Elektronika Manufaktur",
    "Sarjana Terapan Teknologi Rekayasa Elektronika",
    "D3 Teknik Instrumentasi",
    "Sarjana Terapan Teknik Mekatronika",
    "Sarjana Terapan Teknologi Rekayasa Pembangkit Energi",
    "Sarjana Terapan Teknologi Rekayasa Robotika"
  ],
  ti: [
    "D3 Teknik Informatika",
    "D3 Teknologi Geomatika",
    "Sarjana Terapan Animasi",
    "Sarjana Terapan Teknologi Rekayasa Multimedia",
    "Sarjana Terapan Rekayasa Keamanan Siber",
    "Sarjana Terapan Rekayasa Perangkat Lunak",
    "Magister Terapan (S2) Teknik Komputer",
    "Sarjana Terapan Teknologi Permainan"
  ],
  tm: [
    "D3 Teknik Mesin",
    "D3 Teknik Perawatan Pesawat Udara",
    "Sarjana Terapan Teknologi Rekayasa Konstruksi Perkapalan",
    "Sarjana Terapan Teknologi Rekayasa Pengelasan dan Fabrikasi",
    "Sarjana Terapan Teknologi Rekayasa Metalurgi"
  ]
};

// Elemen HTML
const jurusanSelect = document.getElementById("jurusanInput");
const prodiSelect = document.getElementById("prodiInput");

// Event ketika jurusan berubah
jurusanSelect.addEventListener("change", () => {
  const jurusanDipilih = jurusanSelect.value;

  // Kosongkan isi prodi dahulu
  prodiSelect.innerHTML = "";

  if (!jurusanDipilih) {
    prodiSelect.innerHTML = `<option value="">-- Pilih Jurusan Terlebih Dahulu --</option>`;
    return;
  }

  // Ambil daftar prodi berdasarkan jurusan
  const prodiList = daftarProdi[jurusanDipilih];

  // Masukkan opsi prodi ke dropdown
  prodiList.forEach(prodi => {
    const option = document.createElement("option");
    option.value = prodi;
    option.textContent = prodi;
    prodiSelect.appendChild(option);
  });
});


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
