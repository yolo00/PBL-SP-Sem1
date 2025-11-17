document.addEventListener("DOMContentLoaded", function () {
  const STORAGE_KEY = "suratPeringatan";
  const ARSIP_KEY = "arsipSurat";

  const tableBody = document.querySelector("#peringatanTable tbody");
  const searchInput = document.querySelector(".search-input");
  const tingkatFilter = document.querySelectorAll("select")[0];
  const statusFilter = document.querySelectorAll("select")[1];

  let data = JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];

  // Render tabel
  function renderTable(filterData) {
    tableBody.innerHTML = "";

    if (filterData.length === 0) {
      tableBody.innerHTML = `<tr><td colspan="7" style="text-align:center;color:gray;">Tidak ada data ditemukan</td></tr>`;
      return;
    }

    filterData.forEach((item, index) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td class="editable" data-index="${index}">${item.nama}</td>
        <td class="editable" data-index="${index}">${item.nim}</td>
        <td class="editable" data-index="${index}">${item.prodi}</td>
        <td class="editable" data-index="${index}">${item.tingkat}</td>
        <td class="editable" data-index="${index}">${item.tanggal}</td>
        <td class="status ${item.status.toLowerCase()}">${item.status}</td>
        <td class="action-buttons">
          <button class="btn-edit" title="Edit" data-index="${index}">✏️</button>
          <button class="btn-arsip" title="Arsipkan" data-index="${index}">📁</button>
          <button class="btn-hapus" title="Hapus" data-index="${index}">🗑️</button>
        </td>
      `;
      tableBody.appendChild(row);
    });
  }

  // Handle edit click
  tableBody.addEventListener('click', function(e) {
    const target = e.target;
    
    // If clicked on edit button or editable cell
    if (target.classList.contains('btn-edit') || target.classList.contains('editable')) {
      const index = target.dataset.index;
      const item = data[index];
      
      // Simpan data lengkap ke localStorage
      localStorage.setItem('detailSurat', JSON.stringify(item));
      
      // Redirect ke edit page
      window.location.href = `edit_surat.html?id=${index}`;
    }
  });

  // Fungsi filter
  function applyFilter() {
    let keyword = searchInput.value.toLowerCase();
    let tingkat = tingkatFilter.value;
    let status = statusFilter.value;

    const filtered = data.filter(item => {
      const cocokCari =
        item.nama.toLowerCase().includes(keyword) ||
        item.nim.toLowerCase().includes(keyword);
      const cocokTingkat =
        tingkat === "Semua tingkat peringatan" || item.tingkat === tingkat;
      const cocokStatus = status === "Status" || item.status === status;
      return cocokCari && cocokTingkat && cocokStatus;
    });

    renderTable(filtered);
  }

  // Event filter
  searchInput.addEventListener("input", applyFilter);
  tingkatFilter.addEventListener("change", applyFilter);
  statusFilter.addEventListener("change", applyFilter);

  // Aksi hapus & arsip
  tableBody.addEventListener("click", function (e) {
    const index = e.target.dataset.index;

    if (e.target.classList.contains("btn-hapus")) {
      if (confirm("Yakin ingin menghapus surat ini?")) {
        data.splice(index, 1);
        localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
        applyFilter();
      }
    }

    if (e.target.classList.contains("btn-arsip")) {
      const surat = data[index];
      let arsip = JSON.parse(localStorage.getItem(ARSIP_KEY)) || [];
      arsip.push(surat);
      localStorage.setItem(ARSIP_KEY, JSON.stringify(arsip));

      data.splice(index, 1);
      localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
      alert(`Surat ${surat.nama} telah diarsipkan.`);
      window.location.href = "arsip-staf.html";
    }
  });

  renderTable(data);
});
