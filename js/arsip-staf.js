const searchInput = document.getElementById("filterSearch");
const tingkatSelect = document.getElementById("filterTingkat");
const tableRows = document.querySelectorAll("#arsipTable tbody tr");

function filterData() {
  const search = searchInput.value.toLowerCase();
  const tingkat = tingkatSelect.value.toLowerCase();

  tableRows.forEach(row => {
    const nama = row.children[0].innerText.toLowerCase();
    const nim = row.children[1].innerText.toLowerCase();
    const prodi = row.children[2].innerText.toLowerCase();
    const ting = row.children[3].innerText.toLowerCase();

    const matchSearch =
      nama.includes(search) ||
      nim.includes(search) ||
      prodi.includes(search);

    const matchTingkat = tingkat === "" || ting === tingkat;

    row.style.display = (matchSearch && matchTingkat) ? "" : "none";
  });
}

searchInput.addEventListener("keyup", filterData);
tingkatSelect.addEventListener("change", filterData);
