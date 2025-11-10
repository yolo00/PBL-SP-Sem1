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
    const deskripsiInput = document.getElementById('deskripsi');
    const formEdit = document.querySelector('.form-edit');

    // Get data from localStorage
    const STORAGE_KEY = 'suratPeringatan';
    let suratData = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
    const currentSurat = id ? suratData[parseInt(id)] : null;

    // Populate form if we have data
    if (currentSurat) {
        namaInput.value = currentSurat.nama;
        nimInput.value = currentSurat.nim;
        prodiSelect.value = currentSurat.prodi;
        if (tingkatSelect) tingkatSelect.value = currentSurat.tingkat;
        if (tanggalInput) tanggalInput.value = currentSurat.tanggal;
        if (deskripsiInput) deskripsiInput.value = currentSurat.deskripsi;
    } else {
        // If no data in localStorage, try to get from URL params
        namaInput.value = urlParams.get('nama') || '';
        nimInput.value = urlParams.get('nim') || '';
        prodiSelect.value = urlParams.get('prodi') || prodiSelect.options[0].value;
        if (tingkatSelect) tingkatSelect.value = urlParams.get('tingkat') || tingkatSelect.options[0].value;
        if (tanggalInput) tanggalInput.value = urlParams.get('tanggal') || '';
    }

    // Handle form submission
    formEdit.addEventListener('submit', function(e) {
        e.preventDefault();

        const updatedSurat = {
            nama: namaInput.value,
            nim: nimInput.value,
            prodi: prodiSelect.value,
            tingkat: tingkatSelect ? tingkatSelect.value : currentSurat?.tingkat,
            tanggal: tanggalInput ? tanggalInput.value : currentSurat?.tanggal,
            deskripsi: deskripsiInput ? deskripsiInput.value : currentSurat?.deskripsi,
            status: currentSurat?.status || 'Aktif'
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

        // Show success message
        alert('Surat Peringatan berhasil diperbarui!');

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
});
