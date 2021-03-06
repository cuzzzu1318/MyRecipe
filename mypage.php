<?php
  session_start();
  include('session_check.inc');

  $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
  function getTitle($title){
    if (mb_strlen($title, "UTF-8")>10) {
      return mb_substr($title,0, 10, "UTF-8")."...";
    }else{
      return $title;
    }
  }
  //회원정보 쿼리문
  $sql_userinfo = "SELECT userid, nickname FROM user WHERE userid = '{$_SESSION['userid']}';";
  $result_userinfo = mysqli_query($mysqli, $sql_userinfo);
  if ($result_userinfo->num_rows > 0) {
    $row_userinfo = $result_userinfo->fetch_array();
    $article_userinfo = array(
      'id' => htmlspecialchars($row_userinfo['userid']),
      'nickname' => htmlspecialchars($row_userinfo['nickname'])
    );
  }
  //내가쓴 글 쿼리문, 카테고리, 제목, 좋아요
  $sql_postinfo = "SELECT postID, category, recipeName, likes, nickname FROM recipe WHERE nickname = (SELECT nickname FROM user WHERE userid = '{$_SESSION['userid']}');";
  $result_postinfo = mysqli_query($mysqli, $sql_postinfo);
  $list='';
  while($row_postinfo = mysqli_fetch_array($result_postinfo)){
    $list = $list."<div class='myPost'onclick='location.href=\"post.php?postID=".$row_postinfo['postID']."\"'><li>카테고리: ".$row_postinfo['category']."</li>";
    $list = $list."<li>제목: ".$row_postinfo['recipeName']."</li>";
    $list = $list."<li>좋아요: ".$row_postinfo['likes']."</li></div>";
  }
 ?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8"  name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no,
maximum-scale=1.0, minimum-scale=1.0">
    <title>MyRecipe</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
    crossorigin="anonymous">
    <link rel="stylesheet" href="myRecipe.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="post.css">
    <link rel="stylesheet" href="mypage.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
  </head>
  <body>
    <header>
      <a href="/"><img class="logo" src="image/logo.png" alt="logo"></a>
          <h2>My Page</h2>
      <img class="icon" src="image/icon_user.svg" alt="user">
    </header>

    <script type="text/javascript">
     document.querySelector('#게시판').id='cur_menu';
    </script>

<!-- main description -->
    <main class="mypage">
      <form></form>
      <?php
      $sql = "
        SELECT * FROM notice ORDER BY noticeID DESC LIMIT 3 ;
      ";
      $result = $mysqli->query($sql);
      if ($result == false) {
      echo $mysqli->error;
      }else{
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_array()) {
            $article = array(
              'noticeID' => $row['noticeID'],
              'title' => htmlspecialchars($row['title']),
              'description' => htmlspecialchars($row['description']),
              'noticeDate' =>htmlspecialchars($row['noticeDate'])
            );
            ?>

            <?php
          }
        }
      }
      ?>
      <!--  <thead>
          <tr>
            <th scope="col">추천 수</th>
            <th scope="col">제목</th>
            <th scope="col">비용</th>
            <th scope="col">작성자</th>
          </tr>
        </thead>-->

        <div class="body fixed-width fixed-width sub none">
          <div class="content" id="conent">
            <section class="xm">
              <ul class="nav nav-tabs">
                  <h1>회원 정보</h1>
                  <div class="userInfo">
                    <?php
                      echo "<li>ID: ".$article_userinfo['id']."</li>";
                      echo "<li>닉네임: ".$article_userinfo['nickname']."</li>";
                     ?>
                  </div>
                  <h1>내가 쓴 글</h1>
                  <div class="Post">
                    <?php
                      echo $list;
                     ?>
                  </div>
              </ul>
              <div class="logout">
                <input type="button" name="logout" value="로그아웃" onclick="location.href='logout.php'">
                <input type="button" name="withdrawal" value="회원탈퇴" onclick="location.href='withdrawal.php'">
              </div>
            </section>
          </div>
        </div>
    </main>
  </body>
</html>
