<?php

@include 'koneksi.php';

session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sign Up L for Laundry</title>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
  <link rel="icon" href="gambar/logo1.png" type="image">
  <link rel="stylesheet" href="css/sign_up.css">

</head>
<body>
  <div class="container">
    <h2>Register Now</h2>
    <form method="POST">
    <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>
      <label for="username">Email:</label>
      <input type="text" id="email" name="email" placeholder="enter your email">

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="enter your password">

      <label for="confirm password">Re-Enter Password:</label>
      <input type="password" id="password" name="cppassword" placeholder="re-enter your password">

      <button type="submit"><a href="login.php">Sign Up</a></button><br>

    </form>
  </div>
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Ambil nilai dari form login
   $email = $_POST['email'];
   $password = $_POST['password'];

   // Cek email dan password di database
   $query = "SELECT * FROM user WHERE email = '$email' AND pass = '$password'";
   $result = $conn->query($query);
  if ($result->num_rows > 0) {
			$errors[] = "email telah digunakan!";
		}

		if (empty($errors)) {

			// Simpan email dan password ke dalam database
			$stmt = $conn->prepare("INSERT INTO user_form (email, password) VALUES (?, ?)");
			$stmt->bind_param("ss", $email, $password);

			// Eksekusi pernyataan yang telah dipersiapkan
			$stmt->execute();

			// Redirect ke halaman login.php
			header("Location: login.php");
			exit();
		}
   }
  ?>
</body>
</html>
