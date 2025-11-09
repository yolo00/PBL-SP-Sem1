document.addEventListener("DOMContentLoaded", function () {
  const ARSIP_KEY = "arsipSurat";
  const tableBody = document.querySelector("#arsipTable tbody");
  const arsipData = JSON.parse(localStorage.getItem(ARSIP_KEY)) || [];

  if (arsipData.length === 0) {
    tableBody.innerHTML = `<tr><td colspan="6" style="text-align:center;color:gray;">Belum ada surat diarsipkan</td></tr>`;
    return;
  }

  arsipData.forEach(item => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${item.nama}</td>
      <td>${item.nim}</td>
      <td>${item.prodi}</td>
      <td>${item.tingkat}</td>
      <td>${item.tanggal}</td>
      <td class="status ${item.status.toLowerCase()}">${item.status}</td>
    `;
    tableBody.appendChild(row);
  });
});
