// Ambil semua tombol hapus
const tombolHapus = document.querySelectorAll(".btn-hapus");

tombolHapus.forEach((btn) => {
  btn.addEventListener("click", function () {
    const konfirmasi = confirm("Apakah Anda yakin ingin menghapus data ini?");
    if (konfirmasi) {
      const baris = this.closest("tr");
      baris.remove();
    }
  });
});
document.addEventListener("DOMContentLoaded", function () {
  const STORAGE_KEY = "suratPeringatan";
  const tbody = document.querySelector("#peringatanTable tbody");

  function getData() {
    return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
  }

  function saveData(arr) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(arr));
  }

  function renderTable() {
    const data = getData();
    tbody.innerHTML = "";

    if (data.length === 0) {
      tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:18px;">Belum ada data surat peringatan</td></tr>`;
      return;
    }

    data.forEach(item => {
      const tr = document.createElement("tr");
      tr.dataset.id = item.id; // unik id pada row
      tr.innerHTML = `
        <td>${escapeHtml(item.nama)}</td>
        <td>${escapeHtml(item.nim)}</td>
        <td>${escapeHtml(item.prodi)}</td>
        <td>${escapeHtml(item.tingkat)}</td>
        <td>${escapeHtml(item.tanggal)}</td>
        <td class="status aktif">Aktif</td>
        <td class="delete-cell"><button class="btn-hapus" data-id="${item.id}">🗑️</button></td>
      `;
      tbody.appendChild(tr);
    });
  }

  // Hapus item berdasarkan id
  tbody.addEventListener("click", function (e) {
    if (e.target.classList.contains("btn-hapus")) {
      const id = e.target.dataset.id;
      if (!id) return;
      if (!confirm("Hapus surat peringatan ini?")) return;

      let data = getData();
      data = data.filter(d => String(d.id) !== String(id));
      saveData(data);
      renderTable();
    }
  });

  // utility: escape HTML untuk keamanan sederhana
  function escapeHtml(text) {
    if (typeof text !== "string") return text;
    return text
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  // render awal
  renderTable();
});