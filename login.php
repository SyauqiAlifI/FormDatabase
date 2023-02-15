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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <title>Login</title>
</head>

<body>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
      color: black;
    }

    body {
      height: 100vh;
    }

    #status {
      display: block;
      position: absolute;
      /* Make it center */
      left: 50%;
      top: 20%;
      transform: translate(-50%, -50%);
    }

    #status-fail {
      display: block;
      position: absolute;
      /* Make it center */
      left: 50%;
      top: 20%;
      transform: translate(-50%, -50%);
    }

    #login-btn {
      transition: all 0.3s;
    }

    #login-btn:hover {
      background-color: #2c3e50;
      color: white;
    }
  </style>
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <img src="./bgLogin.jpg" class="img-fluid position-absolute top-50 start-50 translate-middle w-100 h-100"
    alt="Harusnya background cok">
  <?php 
  // Call the config tools
  require_once 'connect.php'; ?>
  <div class="position-absolute top-50 start-50 translate-middle container">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title text-center">Login</h1>
        <?php
          // Adding error list
          error_reporting(0);
          // Create a session
          session_start();
          // Create a validation login, if the 'nama' session exists then continue
          if(isset($_SESSION['nama'])) {
            echo '
              <p style="display: none;">success</p>
              <script>
                Swal.fire({
                  icon: \'success\',
                  title: \'Success!\',
                  text: \'Login success!\',
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
                    window.location = "/BackEndStudy/main.php";
                  }
                });
              </script>
            ';
          }

          // Create a validation that verify email and pass
          if(isset($_POST['submit'])) {
            $email = $_POST['email'];
            $pass = md5($_POST['password']);

            $query = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
            $result = mysqli_query($connect, $query);
            // if the data is exists/success
            if($result->num_rows>0) {
              $baris = mysqli_fetch_assoc($result);
              // Create sessions
              $_SESSION['nama'] = $baris['nama'];
              $_SESSION['email'] = $baris['email'];
              $_SESSION['user'] = $baris['username'];
              echo '
                <p style="display: none;">success</p>
                <script>
                  Swal.fire({
                    icon: \'success\',
                    title: \'Success!\',
                    text: \'Login success!\',
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
                      window.location = "/BackEndStudy/main.php";
                    }
                  });
                </script>
              ';
              // if the data is failed
            } else {
              // echo '<script>alert("Email or Password is wrong")</script>';
              echo '
                <p style="display: none;">failed</p>
                <div class="bg-danger rounded-2 my-3 pt-2 pb-2">
                  <p class="p text-center my-auto">
                    <b class="text-light">Wrong password!</b>
                  </p>
                </div>
              ';
            }
          }
        ?>
        <form method="post">
          <input class="form-control" type="email" name="email" placeholder="Input email...">
          <br>
          <input class="form-control" type="password" name="password" placeholder="Password..." id="input-pass">
          <div class="form-check my-2">
            <input class="form-check-input" type="checkbox" id="show-pass" onclick="showPass();">
            <label class="form-check-label" for="show-pass">
              Show password
            </label>
          </div>
          <button id="login-btn" class="form-control" type="submit" name="submit">Login</button>
          <div class="text-center mt-2">
            <a href="/BackEndStudy/register.php" class="text-secondary text-center">Create an account?</a>
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