<?php

session_start();
session_destroy();

header("Location: login.php"); // Arahkan pengguna ke halaman login setelah logout
exit();
?>
