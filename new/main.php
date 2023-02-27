<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Font awesome cdn -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <!-- Poppins Font Family -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- animate.css -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <title>Home - admin</title>
</head>
<body>
  <style>
    body {
      background-image: url("./bg-main.jpg");
      background-repeat: repeat-x;
      background-attachment: fixed;
      background-size: contain;
      background-position: center;
    }
    #png {
      backdrop-filter: blur(10px);
    }
    #tb-crud {
      color: white;
      border-color: white;
    }
    tbody, tr, td, th {
      text-align: center;
      border-width: 1px;
    }
    td {
      padding: .2em .3em;
    }
  </style>
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <!-- Success card -->
  <div class="position-absolute top-50 start-50 translate-middle w-50">
    <div class="row">
      <div class="col-md-12">
        <div class="card bg-transparent" id="png">
          <div style="display: none;"><?php include 'connect.php';?></div>
          <?php
            // to run our session
            session_start();
            if(!$_SESSION['name']) {
              header('location: login.php');
            } else if($_SESSION['logged_in'] != 'active') {
              header('location: login.php');
            }
          ?>
          <div class="card-body">
            <h1 class="text-center text-light">Welcome <?php echo $_SESSION['name']; ?>!</h1>
            <h4 class="text-center text-light fw-normal">Your email : <span class="fw-bold text-decoration-underline"><?php echo $_SESSION['email']; ?></span></h4>
            <hr>
            <div class="d-grid gap-2 w-50 mx-auto">
              <a href="/BackEndStudy/new/guru_add.php" class="btn btn-primary">Add Data</a>
              <a href="/BackEndStudy/new/logout.php" class="btn btn-danger">Logout</a>
            </div>
            <br>
            <!-- Search function -->
            <form method="get" class="input-group">
              <!-- Input form -->
              <input type="text" name="search" placeholder="Search..." value="<?php if(isset($_GET['search'])) { echo $_GET['search']; } ?>" class="form-control">
              <button type="submit" class="btn btn-dark">Search</button>
            </form>
            <br>
            <table id="tb-crud" width="100%">
              <tr>
                <th>Nik</th>
                <th>Nama</th>
                <th>Photo</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Opsi</th>
              </tr>
              <?php
                // When clicking the search button
                if(isset($_GET['search'])) {
                  $word = $_GET['search'];
                  $query = "SELECT * FROM student WHERE nik LIKE '%$word%' OR jurusan LIKE '%$word%' OR nama LIKE '%$word%' ORDER BY id DESC";
                } else {
                  $query =  "SELECT * FROM student ORDER BY id DESC";
                }
                $result = mysqli_query($connect, $query);
                // Looping query result from $result
                if($result->num_rows > 0) {
                  foreach($result as $hasil) {
                    if($hasil['photo'] == null) {
                      echo '
                      <tr>
                        <td>'.$hasil['nik'].'</td>
                        <td>'.$hasil['nama'].'</td>
                        <td>No photo found</td>
                        <td>'.$hasil['kelas'].'</td>
                        <td>'.$hasil['jurusan'].'</td>
                        <td>
                          <a class="btn btn-success" href="guru_edit.php?id='.$hasil['id'].'">edit</a> <a class="btn btn-danger" href="guru_delete.php?id='.$hasil['id'].'&&photo='.$hasil['photo'].'">delete</a>
                        </td>
                      </tr>
                      ';
                    } else {
                      echo '
                      <tr>
                        <td>'.$hasil['nik'].'</td>
                        <td>'.$hasil['nama'].'</td>
                        <td><img src="post_images/'.$hasil['photo'].'"height="35"></td>
                        <td>'.$hasil['kelas'].'</td>
                        <td>'.$hasil['jurusan'].'</td>
                        <td>
                          <a class="btn btn-success" href="guru_edit.php?id='.$hasil['id'].'">edit</a> <a class="btn btn-danger" href="guru_delete.php?id='.$hasil['id'].'&&photo='.$hasil['photo'].'">delete</a>
                        </td>
                      </tr>
                      ';
                    }
                  }
                } else {
                  echo '
                  <tr>
                    <td colspan="6">There\'s no data!</td>
                  </tr>
                  ';
                }
              ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>