document.addEventListener("DOMContentLoaded", function () {
  const filterToggleBtn = document.getElementById("filterToggleBtn");
  const filterOptions = document.getElementById("filterOptions");
  const cards = document.querySelectorAll(".card");
  
  // Ambil input filter
  const keywordInput = document.querySelector('input[name="keyword"]');
  const tingkatSelect = document.querySelector('select[name="tingkat"]');
  const prodiSelect = document.querySelector('select[name="prodi"]');
  const semesterSelect = document.querySelector('select[name="semester"]');
  const sesiSelect = document.querySelector('select[name="sesi_kelas"]');

  function applyFilter() {
    const keyword = keywordInput ? keywordInput.value.toLowerCase() : '';
    const tingkat = tingkatSelect ? tingkatSelect.value.toLowerCase() : '';
    const prodi = prodiSelect ? prodiSelect.value.toLowerCase() : '';
    const semester = semesterSelect ? semesterSelect.value.toLowerCase() : '';
    const sesi = sesiSelect ? sesiSelect.value.toLowerCase() : '';

    let visibleCount = 0;

    cards.forEach(card => {
      // Ambil data dari atribut data
      const nama = card.dataset.nama || '';
      const nim = card.dataset.nim || '';
      const prodiData = card.dataset.prodi || '';
      const tingkatData = card.dataset.tingkat || '';

      // Cek apakah cocok dengan filter
      const cocokKeyword = nama.includes(keyword) || nim.includes(keyword);
      const cocokTingkat = !tingkat || tingkatData === tingkat;
      const cocokProdi = !prodi || prodiData === prodi;

      if (cocokKeyword && cocokTingkat && cocokProdi) {
        card.style.display = '';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    // Tampilkan pesan jika tidak ada hasil
    const noDataMsg = document.querySelector('.no-data-msg');
    if (visibleCount === 0 && cards.length > 0) {
      if (!noDataMsg) {
        const cardContainer = document.querySelector('.card-container');
        const msg = document.createElement('div');
        msg.className = 'no-data-msg';
        msg.style.cssText = 'text-align:center; padding: 40px; color: #666; width: 100%; grid-column: 1 / -1;';
        msg.innerHTML = `
          <i class="fas fa-search" style="font-size: 40px; color: #ddd; margin-bottom: 15px;"></i>
          <p style="font-size: 1.1rem; font-weight: 500;">Data tidak ditemukan</p>
          <p style="font-size: 0.9rem; color: #888;">Coba ubah kata kunci atau reset filter pencarian Anda.</p>
        `;
        cardContainer.appendChild(msg);
      }
    } else {
      const noDataMsg = document.querySelector('.no-data-msg');
      if (noDataMsg) {
        noDataMsg.remove();
      }
    }
  }

  // Event listener untuk perubahan filter
  if (keywordInput) keywordInput.addEventListener('input', applyFilter);
  if (tingkatSelect) tingkatSelect.addEventListener('change', applyFilter);
  if (prodiSelect) prodiSelect.addEventListener('change', applyFilter);
  if (semesterSelect) semesterSelect.addEventListener('change', applyFilter);
  if (sesiSelect) sesiSelect.addEventListener('change', applyFilter);

  // Toggle filter options
  if (filterToggleBtn && filterOptions) {
    filterToggleBtn.addEventListener("click", () => {
      if (filterOptions.style.display === "none") {
        filterOptions.style.display = "flex";
        filterOptions.style.flexWrap = "wrap";
        filterOptions.style.gap = "10px";
        filterOptions.style.marginTop = "15px";
        filterOptions.style.width = "100%";
        filterOptions.style.justifyContent = "center";
        filterOptions.style.animation = "fadeIn 0.3s ease";
      } else {
        filterOptions.style.display = "none";
      }
    });
  }
});
