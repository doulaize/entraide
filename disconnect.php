<?
session_start();
//mysql_close($_SESSION['link']);
session_destroy();
header("Location: ./index.php?error=4");
?>