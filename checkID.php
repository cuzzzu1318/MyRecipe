<?php
  $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
  $userid = $_GET['userid'];

  if(!$userid){
      echo "
      <p>아이디를 입력해주세요.</p>
      <center><input type=button value=창닫기 onclick='self.close()'></center>
      ";
  } else{
      $sql = "
      SELECT * FROM user WHERE userid='$userid'";
      $result = $mysqli->query($sql);
      if ($result == false) {
        echo "$mysqli->error";
      }else{
        if ($result->num_rows > 0) {
          echo "
          <p>이미 존재하는 아이디입니다.</p>
          <center><input type=button value=창닫기 onclick='self.close()'></center>
          ";
        }else{
          echo "
          <p>사용 가능한 아이디입니다.</p>
          <center><input type=button value=창닫기 onclick='self.close()'></center>
          ";
          }

        }
    }
?>
<!DOCTYPE html>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>중복확인</title>
</head>
</html>

<!DOCTYPE html>
<html lang="kor">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>중복확인</title>
</head>
</html>
