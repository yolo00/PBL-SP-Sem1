document.addEventListener('DOMContentLoaded', function() {
    // Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    
    // Get form elements
    const namaInput = document.getElementById('nama');
    const nimInput = document.getElementById('nim');
    const prodiSelect = document.getElementById('prodi');
    const tingkatSelect = document.getElementById('tingkat');
    const tanggalInput = document.getElementById('tanggal');
    const statusSelect = document.getElementById('status');
    const keteranganInput = document.getElementById('keterangan');
    const formEdit = document.querySelector('.form-edit');

    // Get data from localStorage
    const STORAGE_KEY = 'suratPeringatan';
    const DETAIL_KEY = 'detailSurat';
    let suratData = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
    
    // Coba ambil dari detailSurat dulu (dari kelola-staf.html), jika tidak ada, ambil dari array berdasarkan ID
    let currentSurat = JSON.parse(localStorage.getItem(DETAIL_KEY));
    if (!currentSurat && id !== null) {
      currentSurat = suratData[parseInt(id)];
    }

    // Populate form if we have data
    if (currentSurat) {
        namaInput.value = currentSurat.nama || '';
        nimInput.value = currentSurat.nim || '';
        prodiSelect.value = currentSurat.prodi || prodiSelect.options[0].value;
        if (tingkatSelect) tingkatSelect.value = currentSurat.tingkat || tingkatSelect.options[0].value;
        if (tanggalInput) tanggalInput.value = currentSurat.tanggal || '';
        if (statusSelect) statusSelect.value = currentSurat.status || 'Aktif';
        if (keteranganInput) keteranganInput.value = currentSurat.deskripsi || currentSurat.perihal || '';
    } else {
        // If no data in localStorage, try to get from URL params
        namaInput.value = urlParams.get('nama') || '';
        nimInput.value = urlParams.get('nim') || '';
        prodiSelect.value = urlParams.get('prodi') || prodiSelect.options[0].value;
        if (tingkatSelect) tingkatSelect.value = urlParams.get('tingkat') || tingkatSelect.options[0].value;
        if (tanggalInput) tanggalInput.value = urlParams.get('tanggal') || '';
    }

    // Update preview area (if present)
    function updatePreview() {
        const detTingkat = document.getElementById('detailTingkat');
        const detTanggal = document.getElementById('detailTanggal');
        const detNama = document.getElementById('detailNamaSurat');
        const detNim = document.getElementById('detailNimSurat');
        const detProdi = document.getElementById('detailProdiSurat');
        const detJurusan = document.getElementById('detailJurusanSurat');
        const detKelas = document.getElementById('detailKelasSurat');
        const detPerihal = document.getElementById('detailPerihalSurat');
        const detDeskripsi = document.getElementById('detailDeskripsiSurat');

        if (detTingkat) detTingkat.textContent = (tingkatSelect ? tingkatSelect.value : '-') || '-';
        if (detTanggal) detTanggal.textContent = (tanggalInput ? tanggalInput.value : '-') || '-';
        if (detNama) detNama.textContent = namaInput.value || '-';
        if (detNim) detNim.textContent = nimInput.value || '-';
        if (detProdi) detProdi.textContent = prodiSelect.value || '-';
        if (detJurusan) detJurusan.textContent = currentSurat?.jurusan || '-';
        if (detKelas) detKelas.textContent = currentSurat?.kelas || '-';
        if (detPerihal) detPerihal.textContent = currentSurat?.perihal || keteranganInput.value || '-';
        if (detDeskripsi) detDeskripsi.textContent = keteranganInput.value || currentSurat?.deskripsi || '-';
    }

    // Call once to populate preview after filling form
    updatePreview();

    // Listen to input changes to update preview live
    [namaInput, nimInput, prodiSelect, tingkatSelect, tanggalInput, statusSelect, keteranganInput].forEach(el => {
        if (!el) return;
        el.addEventListener('input', updatePreview);
        el.addEventListener('change', updatePreview);
    });

    // Handle form submission
    formEdit.addEventListener('submit', function(e) {
        e.preventDefault();

        const updatedSurat = {
            nama: namaInput.value,
            nim: nimInput.value,
            prodi: prodiSelect.value,
            tingkat: tingkatSelect ? tingkatSelect.value : currentSurat?.tingkat,
            tanggal: tanggalInput ? tanggalInput.value : currentSurat?.tanggal,
            deskripsi: keteranganInput ? keteranganInput.value : currentSurat?.deskripsi,
            perihal: currentSurat?.perihal || '',
            jurusan: currentSurat?.jurusan || '',
            kelas: currentSurat?.kelas || '',
            status: statusSelect ? statusSelect.value : currentSurat?.status || 'Aktif',
            file: currentSurat?.file || null,
            fileName: currentSurat?.fileName || null,
            fileType: currentSurat?.fileType || null,
        };

        if (id !== null) {
            // Update existing surat
            suratData[parseInt(id)] = updatedSurat;
        } else {
            // Add new surat
            suratData.push(updatedSurat);
        }

        // Save to localStorage
        localStorage.setItem(STORAGE_KEY, JSON.stringify(suratData));
        localStorage.setItem(DETAIL_KEY, JSON.stringify(updatedSurat));

        // Show success message
        alert('✅ Surat Peringatan berhasil diperbarui!');

        // Redirect back to kelola page
        window.location.href = 'kelola-staf.html';
    });

    // Handle cancel/back button
    const btnKembali = document.querySelector('.btn-kembali');
    if (btnKembali) {
        btnKembali.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'kelola-staf.html';
        });
    }

    // Handle cancel button in form
    const btnBatalLink = document.querySelector('.btn-batal');
    if (btnBatalLink) {
        btnBatalLink.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'kelola-staf.html';
        });
    }
});
