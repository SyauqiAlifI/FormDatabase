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
  <title>Register form</title>
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
      top: 10%;
      transform: translate(-50%, -50%);
    }
    #status-fail {
      display: block;
      position: absolute;
      /* Make it center */
      left: 50%;
      top: 10%;
      transform: translate(-50%, -50%);
    }
    #submit-btn {
      transition: all 0.3s;
    }
    #submit-btn:hover {
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
  <img src="http://192.168.100.1/images/idn-boarding-school.jpg" class="img-fluid position-absolute top-50 start-50 translate-middle w-100 h-100" alt="ini harusnya backround cok">
  <?php require '../connect.php';?>
  <div class="position-absolute top-50 start-50 translate-middle container">
    <div class="card">
      <div class="card-body">
        <h1 class="card-title text-center my-3">Register</h1>
          <?php
          // Send data to table
            if(isset($_POST['submit'])){
              $name = strip_tags($_POST['name']);
              $role = strip_tags($_POST['roles']);
              $email = strip_tags($_POST['email']);
              $password = strip_tags($_POST['password']);
              $address = strip_tags($_POST['address']);

              // Create a validation
              if(empty($name) || empty($email) || empty($password) || empty($address)){
                echo '
                  <div class="bg-warning rounded-2 my-3 pt-2 pb-2">
                    <p class="p text-center my-auto">
                      <b class="text-light">Input required fields!</b>
                    </p>
                  </div>
                ';
                // Jikalau data yang di input lebih dari 1 atau ada persamaan data di table database
              } else if(count((array) $connect->query("SELECT email FROM access WHERE email = '$email'")->fetch_array()) > 1) {
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
                $input = $connect->query("INSERT INTO access(name, role, email, password, address) VALUES ('$name', '$role', '$email', '$hashed_pass', '$address')");
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
                          window.location = "/BackEndStudy/access/login_role.php";
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
        <form method="post">
          <input class="form-control" type="text" name="name" placeholder="Input name...">
          <br>
          <select class="form-select" name="roles" id="select-roles">
            <option selected disabled>Choose your role</option>
            <option value="admin">Admin</option>
            <option value="guest">Guest</option>
          </select>
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
          <textarea style="resize: none;" class="form-control" id="textarea-address" name="address" rows="5" placeholder="Input your address..."></textarea>
          <br>
          <button id="submit-btn" class="form-control" type="submit" name="submit">Register</button>
          <div class="text-center mt-2">
            <a href="/BackEndStudy/access/login_role.php" class="text-secondary text-center">Already have an account?</a>
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
