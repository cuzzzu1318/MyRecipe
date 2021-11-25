<?php
  $mysqli = new mysqli("localhost", "myRecipe", "1O1o5u", "myRecipe");
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
    <title>MyRecipe</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
    crossorigin="anonymous">
    <link rel="stylesheet" href="myRecipe.css">
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
    <header>
      <a href="main.php"><img class="logo" src="image/logo.png" alt="logo"></a>
          <input type="text" id="input_search" placeholder="레시피, 재료, 작성자">
      <img class="icon" src="image/icon_user.svg" alt="user">
    </header>

    <div class="menu_bar">
      <input type="button" class="btn" name="공지" value="메인"onclick="location.href='main.php'"  >
      <input type="button" class="btn" name="게시판 보기" value="게시판 보기" style="border-bottom: 5px solid black;"onclick="location.href='category.php'" >
    </div>
    <table>
      <thead>
        <tr>
          <th scope="col">번호</th>
          <th scope="col">제목</th>
          <th scope="col">비용</th>
          <th scope="col">추천</th>
          <th scope="col">닉네임</th>
        </tr>
      </thead>
      <?php
      $sql = "
        SELECT * FROM recipe ORDER BY postID DESC LIMIT $start, $show ;
      ";
      $result = $mysqli->query($sql);
      if ($result == false) {
      echo $mysqli->error;
      }else{
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_array()) {
            $article = array(
              'category' => $row['category'],
              'postID' => htmlspecialchars($row['postID']),
              'recipeName' => htmlspecialchars($row['recipeName']),
              'cost' =>number_format(htmlspecialchars($row['cost'])),
              'like' => htmlspecialchars($row['like']),
              'nickname' => htmlspecialchars($row['nickname']),
              'uploadDate' => htmlspecialchars($row['uploadDate'])
            );

          ?>

          <tbody>
           <tr style="height: 50px; cursor: pointer;" onclick="location.replace('post.php?postID=<?=$row['postID']?>');">
             <td style="text-align: center; width: 40px; padding: 0;"><?=$article['postID']?></td>
             <td style="width: 100px;"><?=getTitle($article['recipeName'])?></td>
             <td>\<?=$article['cost']?></td>
             <td style="width: 40px;"><?=$article['like']?></td>
             <td><?=$article['nickname']?></td>
           </tr>
          </tbody>
          <?php
        }
        }
      }
       ?>
  </table>

  </body>
</html>