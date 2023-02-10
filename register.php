<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register form</title>
</head>
<body>
  <?php
  require_once 'connect.php';
  // Send data to table
    if(isset($_POST['submit'])){
      $name = strip_tags($_POST['name']);
      $username = strip_tags($_POST['username']);
      $email = strip_tags($_POST['email']);
      $password = strip_tags($_POST['password']);

      // Create a validation
      if(empty($name) || empty($username) || empty($email) || empty($password)){
        echo 'Input required fields!';
        // Jikalau data yang di input lebih dari 1 atau ada persamaan data di table database
      } else if(count((array) $connect->query("SELECT username FROM users WHERE username = '$username'")->fetch_array()) > 1) {
        echo 'Data already exists!';
        // Input data berhasil
      } else {
        $hashed_pass = password_hash($password, PASSWORD_BCRYPT);
        $input = $connect->query("INSERT INTO users(nama, username, email, password) VALUES ('$name', '$username', '$email', '$hashed_pass')");
        if($input){
          echo 'Success';
        } else {
          echo 'Failed';
        }
      }
    }
  ?>
  <form method="post">
    <input type="text" name="name" autocomplete="off" placeholder="Input your complete name...">
    <br>
    <input type="text" name="username" autocomplete="off" placeholder="Input username...">
    <br>
    <input type="email" name="email" autocomplete="off" placeholder="Input email...">
    <br>
    <input type="password" name="password" autocomplete="off" placeholder="Input password...">
    <br>
    <button type="submit" name="submit">Register</button>
  </form>
</body>
</html>