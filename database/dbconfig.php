<?php

$server = "localhost"; // atau 127.0.0.1
$username = "root"; // username MySQL kamu, default biasanya 'root'
$password = ""; // password MySQL kamu, biasanya kosong di XAMPP
$database = "panel_pdam"; // nama database yang kamu gunakan

// Buat koneksi
$connection = mysqli_connect($server, $username, $password, $database);

// Cek koneksi
if (!$connection) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
