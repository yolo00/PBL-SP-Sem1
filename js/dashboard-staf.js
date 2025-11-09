document.addEventListener("DOMContentLoaded", function () {
  const STORAGE_KEY = "suratPeringatan";
  const cardContainer = document.querySelector(".card-container");

  function getData() {
    if (localStorage.getItem(STORAGE_KEY)) {
      document.querySelectorAll(".card").forEach(c => c.remove());
    }
    return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
  }

  function buatCard(data) {
    const div = document.createElement("div");
    div.classList.add("card");
    div.setAttribute("data-aos", "fade-up");

    let spClass = "";
    if (data.tingkat === "SP I") spClass = "sp1";
    else if (data.tingkat === "SP II") spClass = "sp2";
    else if (data.tingkat === "SP III") spClass = "sp3";

    div.innerHTML = `
      <div class="sp-label ${spClass}">${data.tingkat}</div>
      <div class="photo"></div>
      <p>
        <strong>${data.nama}</strong><br>
        ${data.nim}<br>
        ${data.prodi}<br>
        ${data.tanggal}<br>
        <span class="status ${data.status.toLowerCase()}">${data.status}</span>
      </p>
      <a href="#" class="detail" data-nim="${data.nim}">Lebih detail ></a>
    `;
    return div;
  }

  const allData = getData();
  allData.forEach(item => {
    const card = buatCard(item);
    cardContainer.appendChild(card);
  });

  // ⚡ Tambahkan event listener menggunakan event delegation
  cardContainer.addEventListener("click", function (e) {
    if (e.target.classList.contains("detail")) {
      e.preventDefault();
      const nim = e.target.dataset.nim;

      // Simpan NIM sementara ke localStorage agar bisa diambil di detail-surat.html
      localStorage.setItem("selectedNIM", nim);

      // Pindah ke halaman detail
      window.location.href = "detail-surat.html";
    }
  });

  // 🩶 Tambahkan teks jika tidak ada surat
if (allData.length === 0) {
  const msg = document.createElement("p");
  msg.classList.add("no-surat-msg");
  msg.textContent = "Tidak ada surat peringatan terbaru";
  // ⬇️ Tambahkan ke DALAM cardContainer, bukan sebelum atau sesudahnya
  cardContainer.appendChild(msg);
}})
