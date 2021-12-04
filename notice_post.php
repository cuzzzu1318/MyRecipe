<?php
  $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
  if (isset($_GET['noticeID'])) {
    $noticeID = $_GET['noticeID'];
  }else{
    echo '<script>alert("잘못된 접근입니다!");</script>';
    echo("<script>location.replace('index.php');</script>");
  }
  $sql = "
    SELECT * FROM notice WHERE noticeID = '{$noticeID}';
  ";
  $result = $mysqli->query($sql);
  if ($result == false) {
  echo $mysqli->error;
  }else{
    if ($result->num_rows > 0) {
      $row = $result->fetch_array(MYSQLI_BOTH);
      $article = array(
        'noticeID' => htmlspecialchars($row['noticeID']),
        'title' => htmlspecialchars($row['title']),
        'description' => htmlspecialchars($row['description']),
        'noticeDate' => substr(htmlspecialchars($row['noticeDate']), 0, 16)
      );
    }else{
      echo '<script>alert("잘못된 접근입니다!");</script>';
      echo("<script>location.replace('index.php');</script>");
    }
  }


?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8"  name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no,
maximum-scale=1.0, minimum-scale=1.0">
    <title>공지사항</title>
    <link rel="stylesheet" href="myRecipe.css">
    <link rel="stylesheet" href="notice_post.css">
    <script src="https://kit.fontawesome.com/bdb80102e7.js" crossorigin="anonymous"></script>
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
  </head>
  <body>
    <?php include('header.inc'); ?>
    <?php include('nav.inc'); ?>
    <script type="text/javascript">
     document.querySelector('#공지').id='cur_menu';
    </script>
    <main class="noticeMain">
      <div class="noticeHeader">
         <div class="title"><?=$article['title']?></div>
         <div class="noticeDate"><?=$article['noticeDate']?></div>
       </div>
       <div class="notice">
        <div class="noticeText"><?=$article['description']?></div>
       </div>
    </main>
  </body>
</html>
