<?php
require 'koneksi.php';

$antrian = $_POST["antrian"];
$query = "DELETE FROM tb_pelanggan WHERE antrian = '$antrian'";

if (mysqli_query($conn,$query)){
    header("location:inputan.php");
}else{
    echo "Pendaftaran gagal : ".mysqli_error($conn);
}