<?php
$host = "sql106.infinityfree.com";
$user = "if0_34387687";
$passwd = "mzjPjFzOdv4u";
$name = "if0_34387687_ara";

$conn = mysqli_connect($host, $user, $passwd, $name);

if (!$conn) {
    die("koneksi gagal terhubung : " . mysqli_connect_errno() . "-" . mysqli_connect_error());
}