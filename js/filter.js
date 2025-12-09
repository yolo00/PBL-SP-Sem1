document.addEventListener("DOMContentLoaded", function () {

  const searchInput = document.getElementById("filterSearch");
  const filterTingkat = document.getElementById("filterTingkat");
  const rows = document.querySelectorAll("table tbody tr");

  function applyFilter() {
    const cariVal = searchInput.value.toLowerCase();
    const tingkatVal = filterTingkat.value.toLowerCase();

    rows.forEach(row => {
      const nama = row.dataset.nama;
      const nim = row.dataset.nim;
      const prodi = row.dataset.prodi;
      const tingkat = row.dataset.tingkat;

      const cocokSearch = nama.includes(cariVal) || nim.includes(cariVal) || prodi.includes(cariVal);
      const cocokTingkat = !tingkatVal || tingkat === tingkatVal;

      if (cocokSearch && cocokTingkat) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  }

  searchInput.addEventListener("input", applyFilter);
  filterTingkat.addEventListener("change", applyFilter);

});
