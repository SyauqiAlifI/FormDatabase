<?php
  // Isi detail database
  $db_host = 'localhost';
  $db_user = 'root';
  $db_pass = '';
  $db_name = 'sekolah';

  // Check connection to the db
  $connect = new mysqli($db_host, $db_user, $db_pass, $db_name);
  if($connect->errno){
    echo $connect->error;
    exit;
  } else {
    $str = '
    <div id="status" class="p-3 bg-success rounded-2">
      <h4 class="text-white m-0">
        Connection Succeed
      </h4>
    </div>
    ';
    echo($str);
  };
?>