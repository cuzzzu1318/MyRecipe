<?php
  $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
  $type = $_POST['type'];
  $checkValue = $_POST['checkValue'];
  $check_ID = 0;
  switch ($type) {
    case 'id':
    if ($checkValue!=NULL) {
      $sql = "
      SELECT * FROM user WHERE userid='$checkValue'";
      $result = $mysqli->query($sql);
      $count = $result->fetch_array();
      if ($count==0) {
        echo '{"result":"1"}';
      }else{
        echo '{"result":"0"}';
      }
    }
      break;
    case 'nickname':
    if ($checkValue!=NULL) {
      $sql = "
      SELECT * FROM user WHERE nickname='$checkValue'";
      $result = $mysqli->query($sql);
      $count = $result->fetch_array();
      if ($count==0) {
        echo '{"result":"1"}';
      }else{
        echo '{"result":"0"}';
      }
    }
      break;
    default:
      // code...
      break;
  }


?>
