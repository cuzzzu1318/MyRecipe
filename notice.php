<?php
  $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
  if (isset($_GET['cur_page'])) {
      $cur_page = $_GET['cur_page'];
    }else {
      $cur_page = 1;
    }
    $show = 10;
    $start = (($cur_page-1)*$show);

    function getTitle($title){
      if (mb_strlen($title, "UTF-8")>10) {
        return mb_substr($title,0, 10, "UTF-8")."...";
      }else{
        return $title;
      }
    }
 ?>
 <!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8"  name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no,
maximum-scale=1.0, minimum-scale=1.0">
    <title>MyRecipe-공지</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
    crossorigin="anonymous">
    <link rel="stylesheet" href="myRecipe.css">
    <link rel="stylesheet" href="notice.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
  </head>
<body>
  <?php include('header.inc'); ?>
  <?php include('nav.inc'); ?>
  <script type="text/javascript">
   document.querySelector('#공지').id='cur_menu';
  </script>

  <!-- Description -->
  <main class="notice">
    <table>
      <thead>
        <tr>
          <th scope="col" class="noticeID">번호</th>
          <th scope="col" class="noticeTitle">제목</th>
          <th scope="col" class="noticeDate">날짜</th>
        </tr>
      </thead>
      <?php
      $sql = "
        SELECT * FROM notice ORDER BY noticeID DESC LIMIT $start, $show ;
      ";
      $result = $mysqli->query($sql);
      if ($result == false) {
      echo $mysqli->error;
      }else{
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_array()) {
            $article = array(
              'noticeID' => htmlspecialchars($row['noticeID']),
              'title' => htmlspecialchars($row['title']),
              'noticeDate' => htmlspecialchars($row['noticeDate'])
            );

          ?>

          <tbody>
           <tr style="cursor: pointer;" onclick="location.href='notice_post.php?noticeID=<?=$row['noticeID']?>';">
             <td class="noticeID"><?=$article['noticeID']?></td>
             <td class="noticeTitle"><?=getTitle($article['title'])?></td>
             <td class="noticeDate"><?=substr($article['noticeDate'],0, 10)?></td>
           </tr>
          </tbody>
          <?php
        }
        }
      }
       ?>
  </table>
  </main>

</body>
</html>
