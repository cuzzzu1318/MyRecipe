<?php
  session_start();
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
    $pw = $_POST['pw'];
    $id = $_POST['id'];
    $sql = "SELECT * FROM user WHERE userid = '$id';";//쿼리문 작성
    $result = mysqli_query($conn, $sql);//결과 저장
    if ($result->num_rows > 0) {
      $row = $result->fetch_array();
      $article = array(
        'id' => htmlspecialchars($row['userid']),
        'pw' => htmlspecialchars($row['password']),
        'nickname' => htmlspecialchars($row['nickname'])
      );
    }
    if($pw == $article['pw']){
      $_SESSION['userid']=$article['id'];
      $_SESSION['nickname']=$article['nickname'];
      $_SESSION['signin_time'] = time();
      ?>
      <script>
        alert('로그인 성공');
        location.href = "index.php";
      </script>
      <?php
    }
    else{
      ?>
      <script>
        alert('로그인 실패');
        location.href = "signin.php";
      </script>
      <?php
    }
    ?>
    <?php
// 재환부분(login)
    break;
  }
?>
