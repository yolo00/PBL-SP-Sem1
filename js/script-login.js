document.getElementById("loginBtn").addEventListener("click", function() {
  const role = document.getElementById("role").value;
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();

  if (!role || !username || !password) {
    alert("Harap isi semua data!");
    return;
  }

  // Redirect berdasarkan peran pengguna
  if (role === "staf") {
    window.location.href = "dashboard-staf.html";
  } else if (role === "mahasiswa") {
    window.location.href = "dashboard-mahasiswa.html";
  } else {
    alert("Silakan pilih jenis pengguna!");
  }
});
