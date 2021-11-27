<?php
  $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
  </head>
  <body>
    <?php include('header.inc'); ?>
    <nav class="menu_bar">
      <input type="button" class="btn" id="cur_menu" name="공지" value="메인">
      <input type="button" class="btn" name="게시판 보기" value="게시판 보기" onclick="location.href='category.php'">
    </nav>
    <div class="notice">
      <i class="fas fa-clipboard-list"></i>
      <ul class="rolling">
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
              <li class="item">
                <span class="noticeText"><?=getTitle($article['description'])?></span>
                <span class="noticeDate"><?=substr($article['noticeDate'],0, 10)?></span>
              </li>
              <?php
            }
          }
        }
        ?>
      </ul>
      <buttton id="moreNotice" onclick="location.href='notice.php'">더보기+</buttton>
    </div>
  <script>
      $(document).ready(function(){
      	var height =  $(".notice").height();
      	var num = $(".rolling .item").length;
      	var max = height * num;
      	var move = 0;
      	function noticeRolling(){
      		move += height;
      		$(".rolling").animate({"top":-move},600,function(){
      			if( move >= max ){
      				$(this).css("top",0);
      				move = 0;
      			};
      		});
      	};
      	noticeRollingOff = setInterval(noticeRolling,1000);
      	$(".rolling").append($(".rolling .item").first().clone());
      });
    </script>
<!-- main description -->
    <main class="description">
      <div class="recent">
        <span class="recentPost">최근 게시물</span>
        <button class="morePost" onclick="location.href='list.php'">더보기+</button>
      </div>
      <table>
        <thead>
          <tr>
            <th scope="col">추천 수</th>
            <th scope="col">제목</th>
            <th scope="col">비용</th>
            <th scope="col">작성자</th>
          </tr>
        </thead>
        <?php
        $sql = "
          SELECT * FROM recipe ORDER BY postID DESC LIMIT 5 ;
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
             <tr style="height: 50px; cursor: pointer;" onclick="location.href='post.php?postID=<?=$row['postID']?>';">
               <td style="width: 50px;"><?=$article['like']?></td>
               <td style="width: 170px;"><?=getTitle($article['recipeName'])?></td>
               <td>\<?=$article['cost']?></td>
               <td><?=$article['nickname']?></td>
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
