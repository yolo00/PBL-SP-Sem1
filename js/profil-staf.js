document.addEventListener("DOMContentLoaded", () => {
  const editBtn = document.querySelector(".btn-edit");
  const logoutBtn = document.querySelector(".btn-logout");

  editBtn.addEventListener("click", () => {
    alert("Fitur Edit Profil akan segera tersedia!");
  });

  logoutBtn.addEventListener("click", () => {
    if (confirm("Yakin ingin keluar dari akun?")) {
      window.location.href = "login.html";
    }
  });
});
