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
  <title>Register</title>
</head>
<body>
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- BG Image -->
  <img src="bg-reg.jpg" class="img-fluid position-absolute top-50 start-50 translate-middle w-100 h-100"
    alt="Harusnya background cok">
  <div class="position-absolute top-50 start-50 translate-middle container">
    <div class="card">
      <div class="card-body">
        <!-- Connect to database -->
        <div class="container-fluid bg-success p-2 text-center text-light fw-bold rounded-2"><?php include "connect.php" ?></div>
        <h1 class="card-title text-center my-3">Register</h1>
        <form method="post">
        <?php
          // Send data to table
            if(isset($_POST['submit'])){
              $name = strip_tags($_POST['name']);
              $email = strip_tags($_POST['email']);
              $password = strip_tags($_POST['password']);

              // Create a validation
              if(empty($name) || empty($email) || empty($password)){
                echo '
                  <div class="bg-warning rounded-2 my-3 pt-2 pb-2">
                    <p class="p text-center my-auto">
                      <b class="text-light">Input required fields!</b>
                    </p>
                  </div>
                ';
                // Jikalau data yang di input lebih dari 1 atau ada persamaan data di table database
              } else if(count((array) $connect->query("SELECT email FROM guru WHERE email = '$email'")->fetch_array()) > 1) {
                echo '
                  <div class="bg-warning rounded-2 my-3 pt-2 pb-2">
                    <p class="p text-center my-auto">
                      <b class="text-light">Data Already Exists!</b>
                    </p>
                  </div>
                ';
                // Input data berhasil
              } else {
                $hashed_pass = md5($password);
                $input = $connect->query("INSERT INTO guru(nama, email, password) VALUES ('$name', '$email', '$hashed_pass')");
                if($input){
                  echo '
                    <script>
                      Swal.fire({
                        icon: \'success\',
                        title: \'Success!\',
                        text: \'Your data has been saved!\',
                        showClass: {
                          popup: \'animate__animated animate__fadeInDown\'
                        },
                        hideClass: {
                          popup: \'animate__animated animate__fadeOutDown\'
                        },
                        confirmButtonColor: \'#3085d6\',
                        confirmButtonText: \'Okay!\'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location = "/BackEndStudy/new/login.php";
                        }
                      });
                    </script>
                  ';
                } else {
                  echo 'Failed';
                }
              }
            }
          ?>
          <input class="form-control" type="text" name="name" placeholder="Input name...">
          <br>
          <input class="form-control" type="email" name="email" placeholder="Input email...">
          <br>
          <input class="form-control" type="password" name="password" placeholder="Input password..." id="input-pass">
          <div class="form-check my-2">
            <input class="form-check-input" type="checkbox" id="show-pass" onclick="showPass();">
            <label class="form-check-label" for="show-pass">
              Show password
            </label>
          </div>
          <br>
          <button id="submit-btn" class="form-control" type="submit" name="submit">Register</button>
          <div class="text-center mt-2">
            <a href="/BackEndStudy/new/login.php" class="text-secondary text-center">Already have an account?</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    function showPass() {
      var pass = document.getElementById('input-pass');
      if (pass.type === 'password') {
        pass.type = 'text';
      } else {
        pass.type = 'password';
      }
    }
  </script>
</body>
</html>