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
  <title>Edit and Update data</title>
</head>
<body>
  <style></style>
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <form method="post" enctype="multipart/form-data">
    <div style="display: none;"><?php include 'connect.php';?></div>
    <?php

      // Edit function
      $id = $_GET['id'];

      // query
      $result = mysqli_query($connect, "SELECT * FROM siswa WHERE id = '$id'");

      // looping based on id parameter
      while($edit = mysqli_fetch_array($result)) {
        $nik = $edit['nik'];
        $nama = $edit['nama'];
        $photo = $edit['photo'];
        $kelas = $edit['kelas'];
        $jurusan = $edit['jurusan'];
        $alamat = $edit['alamat'];
      }
      
      // Update function
      if(isset($_POST['submit'])) {
        $_id = $_POST['id'];
        $_nik = $_POST['nik'];
        $_nama = $_POST['nama'];
        $_kelas = $_POST['kelas'];
        $_jurusan = $_POST['jurusan'];
        $_alamat = $_POST['alamat'];

        // Contains format that is allowed to be uploaded
        $format = ['png', 'jpg', 'jpeg', 'svg'];
        // File request container
        $filename = $_FILES['foto']['name'];
        // File size request container
        $filesize = $_FILES['foto']['size'];
        // Only take the file format info
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if(empty($nik) || empty($name) || empty($kelas) || empty($jurusan) || empty($address)){
          echo '
            <div class="bg-warning rounded-2 my-3 pt-2 pb-2">
              <p class="p text-center my-auto">
                <b class="text-light">Input required fields!</b>
              </p>
            </div>
          ';
          // Jikalau data yang di input lebih dari 1 atau ada persamaan data di table database
        } else {
          // if the file format is not meet with the requirements from $format
          if($filesize < 10044070) {
            $_photo = $nik.'_'.$filename;

            // save the updated photo file in this folder
            move_uploaded_file($_FILES['foto']['tmp_name'], './post_images/'.$nik.'_'.$filename);
            // save the updated photo FILENAME to the databse
            $connect->query("UPDATE siswa SET nik = '$_nik', nama = '$_nama', photo = '$_photo', kelas = '$_kelas', jurusan = '$_jurusan', alamat = '$_alamat' WHERE id = '$_id'");

            echo '
              <script>
                Swal.fire({
                  icon: \'success\',
                  title: \'Success!\',
                  text: \'Data has been saved!\',
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
                    window.location = "/BackEndStudy/access/admin_page.php";
                  }
                });
              </script>
              <!-- <script>alert("fiuh")</script> -->
            ';
          } else {
            echo 'Failed';
          }
        }
      }

    ?>
    <table width="25%">
      <tr>
        <td>Nik</td>
        <td><input type="text" name="nik" id="i-nik" value="<?php echo $nik; ?>"></td>
      </tr>
      <tr>
        <td>Nama</td>
        <td><input type="text" name="nama" id="i-nama" value="<?php echo $nama; ?>"></td>
      </tr>
      <tr>
        <td>Foto</td>
        <td>
          <img src="./post_images/<?php echo $photo; ?>" style="width: 128px; margin-bottom: 5px;">
          <input type="file" name="foto" id="i-foto">
          <p style="margin: 5px 0; color: red;">Leave it if u don't want to change it</p>
        </td>
      </tr>
      <tr>
        <td>Kelas</td>
        <td><input type="text" name="kelas" id="i-kelas" value="<?php echo $kelas; ?>"></td>
      </tr>
      <tr>
        <td>Jurusan</td>
        <td>
          <select name="jurusan" id="i-jurusan">
            <option disabled>Pilih jurusan</option>
            <option <?php if($jurusan == 'RPL') { echo 'selected'; } ?> value="RPL">RPL</option>
            <option <?php if($jurusan == 'TKJ') { echo 'selected'; } ?> value="TKJ">TKJ</option>
            <option <?php if($jurusan == 'DMM') { echo 'selected'; } ?> value="DMM">DMM</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Alamat</td>
        <td>
          <textarea name="alamat" id="i-alamat" cols="23" rows="5"><?php echo $alamat; ?></textarea>
        </td>
      </tr>
      <tr>
        <td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
        <td><button type="submit" name="submit">Update</button></td>
      </tr>
    </table>
  </form>
</body>
</html>