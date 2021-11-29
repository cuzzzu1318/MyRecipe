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
    $conn = mysqli_connect("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
    $id = $_POST['id'];
    $password = $_POST['password'];

    $sql = "SELECT userid, password FROM user WHERE userid = '{$id}';";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);
    $hashedPassword = $row['password'];
    $row ['id'];

    foreach($row as $key => $r){

    }
    $passwordResult = password_verify($password, $hashedPassword);
    if($passwordResult === true){
      ?>
      <script>
        alert("로그인 성공");
        location.href = "index.php";
      </script>
      <?php
    }
    else{
      ?>
      <script>
        alert("로그인 실패");
        location.href = "login.php";
      </script>
      <?php
    }
// 재환부분(login)
    break;
  }
?>
