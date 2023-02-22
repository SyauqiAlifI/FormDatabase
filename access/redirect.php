<!DOCTYPE html>
<html lang="en">
<head>
  <?php
    session_start();
  ?>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
    if($_SESSION['logged_in'] == 'active') {
      if($_SESSION['role'] == 'admin') {
        echo '<meta http-equiv="Refresh" content="1; url=\'admin_page.php\'" />';
      } else if($_SESSION['role'] == 'guest') {
        echo '<meta http-equiv="Refresh" content="1; url=\'guest_page.php\'" />';
      }
    } else {
      header('location: login_role.php');
    }
  ?>
  <title>Redirecting...</title>
</head>
<body>
  <h1>Redirecting...</h1>
</body>
</html>