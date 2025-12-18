<?php
session_start();
session_unset();
session_destroy();
setcookie('id', '', time() - 3600, "/");
setcookie('key', '', time() - 3600, "/");
setcookie('jenis_kelamin', '', time() - 3600, "/");
setcookie('gender_mhs', '', time() - 3600, "/");
setcookie('gender_staf', '', time() - 3600, "/");


header("Location: ../landing-page.php");
exit;
?>
