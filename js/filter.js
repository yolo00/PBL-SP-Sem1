document.addEventListener("DOMContentLoaded", function () {

  const searchInput   = document.getElementById("filterSearch");
  const filterTingkat = document.getElementById("filterTingkat");
  const filterStatus  = document.getElementById("filterStatus");
  const rows          = document.querySelectorAll("table tbody tr");

  function applyFilter() {
    const cariVal      = searchInput.value.toLowerCase();
    const tingkatVal   = filterTingkat.value.toLowerCase();
    const statusVal    = filterStatus.value.toLowerCase();

    rows.forEach(row => {
      const nama    = row.dataset.nama;
      const nim     = row.dataset.nim;
      const prodi   = row.dataset.prodi;
      const tingkat = row.dataset.tingkat;
      const status  = row.dataset.status;

      const cocokSearch   = nama.includes(cariVal) || nim.includes(cariVal) || prodi.includes(cariVal);
      const cocokTingkat  = !tingkatVal || tingkat === tingkatVal;
      const cocokStatus   = !statusVal || status === statusVal;

      if (cocokSearch && cocokTingkat && cocokStatus) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  }

  searchInput.addEventListener("input", applyFilter);
  filterTingkat.addEventListener("change", applyFilter);
  filterStatus.addEventListener("change", applyFilter);

});
