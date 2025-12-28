document.addEventListener("DOMContentLoaded", function () {

  const searchInput = document.getElementById("filterSearch");
  const filterTingkat = document.getElementById("filterTingkat");
  const filterProdi = document.getElementById("filterProdi");
  const rows = document.querySelectorAll("table tbody tr");

  function applyFilter() {
    const cariVal = searchInput.value.toLowerCase();
    const tingkatVal = filterTingkat.value.toLowerCase();
    const prodiVal = filterProdi.value.toLowerCase();

    rows.forEach(row => {
      const nama = row.dataset.nama || '';
      const nim = row.dataset.nim || '';
      const prodi = row.dataset.prodi || '';
      const tingkat = row.dataset.tingkat || '';

      const cocokSearch = nama.includes(cariVal) || nim.includes(cariVal) || prodi.includes(cariVal);
      const cocokTingkat = !tingkatVal || tingkat === tingkatVal;
      const cocokProdi = !prodiVal || prodi === prodiVal;

      if (cocokSearch && cocokTingkat && cocokProdi) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  }

  searchInput.addEventListener("input", applyFilter);
  filterTingkat.addEventListener("change", applyFilter);
  filterProdi.addEventListener("change", applyFilter);

});
