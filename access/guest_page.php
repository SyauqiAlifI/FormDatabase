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
  <title>Home - Guest</title>
</head>
<body>
  <style>
    body {
      background-image: url("https://cdn.idntimes.com/content-images/duniaku/post/20230206/fofljuhaiaej8og-3443dfe0ae07680306b3b8ba8582d2db.jpg");
      background-repeat: repeat-x;
      background-attachment: fixed;
      background-size: contain;
      background-position: center;
    }
    #png {
      backdrop-filter: blur(10px);
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
          <?php
            // to run our session
            session_start();
            if(!$_SESSION['name']) {
              header('location: login_role.php');
            } else if($_SESSION['role'] == 'admin') {
              header('location: admin_page.php');
            } else if($_SESSION['logged_in'] != 'active') {
              header('location: login_role.php');
            }
          ?>
          <div class="card-body">
            <h1 class="text-center text-light">Hello Guest!</h1>
            <h4 class="text-center text-light fw-normal">Hey <span class="fw-bold">@<?php echo $_SESSION['name']; ?></span></h4>
            <h4 class="text-center text-light fw-normal">Role : <span class="fw-bold"><?php echo $_SESSION['role']; ?>!</span></h4>
            <h4 class="text-center text-light fw-normal">Your email : <span class="fw-bold text-decoration-underline"><?php echo $_SESSION['email']; ?></span></h4>
            <hr>
            <div class="d-grid gap-2 w-50 mx-auto">
              <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-dark">Masbro!</a>
              <a href="/BackEndStudy/access/logout.php" class="btn btn-danger">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>