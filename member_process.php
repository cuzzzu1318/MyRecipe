<?php
  $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
  switch($_GET['mode']){
    case 'register':
      $id = $_POST['myRecipe_id'];
      $pw = $_POST['myRecipe_re-pw'];
      $nickname = $_POST['myRecipe_nickname'];
      $sql = "
      INSERT INTO user
        (userid, password, nickname)
        VALUES(
          '{$id}',
          '{$pw}',
          '{$nickname}'
        )
      ";
      $result = $mysqli->query($sql);
      if ($result == false) {
        echo $mysqli->error;
      }else{
          header('Location: signin.php');
        }
    break;
    case 'signin':

// 재환부분(login)
    break;
  }
?>
