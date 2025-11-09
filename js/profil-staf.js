document.addEventListener("DOMContentLoaded", () => {
  const logoutBtn = document.querySelector(".btn-logout");

  if (logoutBtn) {
    logoutBtn.addEventListener("click", () => {
      if (confirm("Yakin ingin keluar dari akun?")) {
        window.location.href = "login.html";
      }
    });
  }
});
