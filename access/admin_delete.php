<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete data</title>
</head>
<body>
  <div style="display: none;"><?php include 'connect.php';?></div>
  <?php
    // call id parameter
    $id = $_GET['id'];
    // Create a query to delete data based on id
    $result = mysqli_query($connect, "DELETE FROM siswa WHERE id = '$id'");

    // Assign the query result as an array
    $del_photo = mysqli_fetch_array($result);

    // if there's a photo then delete it from the folder
    if(is_file("post_images/".$del_photo['photo'])) {
      // Delete the file
      unlink("post_images/".$del_photo['photo']);
      // Delete the data
      mysqli_query($connect, "DELETE FROM siswa WHERE id = '$id'");
      echo '<script>
        alert("Data deleted successfully");
        window.location = "/BackEndStudy/access/admin_page.php";
      </script>';
      // if the photo does not exist
    } else {
      $del_nonphoto = mysqli_query($connect, "DELETE FROM siswa WHERE id = '$id'");
      if($del_nonphoto) {
        echo '<script>
          alert("Data deleted successfully");
          window.location = "/BackEndStudy/access/admin_page.php";
        </script>';
      } else {
        echo '<script>
          alert("Failed");
        </script>';
      }
    }
  ?>
</body>
</html>