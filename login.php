<?php

@include 'koneksi.php';

session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Layanan Laundry</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
  <link rel="icon" href="gambar/logo1.png" type="image">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <div class="container">
    <h2>L for Laundry</h2>
    <form method="POST">
    <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>
      <label for="email">Email:</label>
      <input type="text" id="email" name="email" placeholder="enter your email">

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="enter your password">

      <button type="submit"><a href="home.php">Login Now</a></button>
      <p> don't have an account? <a href="sign_up.php">Register Now!</a></p>
    </form>
  </div>
  <?php
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Ambil nilai dari form login
      $email = $_POST['email'];
      $password = $_POST['password'];

      // Cek email dan password di database
      $query = "SELECT * FROM user_form WHERE email = '$email' AND password = '$password'";
      $result = $conn->query($query);
      if ($result->num_rows > 0) {
      // Login berhasil, redirect ke halaman home.php
      $_SESSION['email'] = $email; // Set session email
      header("Location: home.php");
      exit();
      } else {
      // email atau password salah, tampilkan notifikasi
      $errorMessage = "email atau password salah!";
   }
 }
  ?>
</body>
</html>
