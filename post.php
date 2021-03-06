<?php
$data = array(
  array(),
  array()
);
  $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
  if (isset($_GET['postID'])) {
    $postID = $_GET['postID'];
  }else{
    echo '<script>alert("잘못된 접근입니다!");</script>';
    echo("<script>location.replace('list.php');</script>");
  }
  $sql = "
    SELECT * FROM recipe WHERE postID = '{$postID}';
  ";
  $result = $mysqli->query($sql);
  if ($result == false) {
  echo $mysqli->error;
  }else{
    if ($result->num_rows > 0) {
      $row = $result->fetch_array(MYSQLI_BOTH);
      $article = array(
        'category' => $row['category'],
        'postID' => htmlspecialchars($row['postID']),
        'recipeName' => htmlspecialchars($row['recipeName']),
        'ingrediants' => htmlspecialchars($row['ingrediants']),
        'recipe' => htmlspecialchars($row['recipe']),
        'cost' => htmlspecialchars($row['cost']),
        'like' => htmlspecialchars($row['likes']),
        'nickname' => htmlspecialchars($row['nickname']),
        'img_name' => htmlspecialchars($row['img_name']),
        'uploadDate' => substr(htmlspecialchars($row['uploadDate']), 2, 14)
      );
    }else{
      echo '<script>alert("잘못된 접근입니다!");</script>';
      echo("<script>location.replace('list.php');</script>");
    }
    $data[0] = explode('MRCUT', $article['recipe']);
    $data[1] = explode(',', $article['img_name']);
    $cnt = count($data[0]);
  }


?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8"  name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no,
maximum-scale=1.0, minimum-scale=1.0">
    <title>MyRecipe</title>
    <link rel="stylesheet" href="myRecipe.css">
    <link rel="stylesheet" href="post.css">
    <script src="https://kit.fontawesome.com/bdb80102e7.js" crossorigin="anonymous"></script>
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
  </head>
  <body>
    <?php include('header.inc'); ?>
    <?php include('nav.inc'); ?>
    <script type="text/javascript">
     document.querySelector('#게시판').id='cur_menu';
     $(document).ready(function(e) {
     	$(".like").on("click", function(){
     		var self = $(this);
       		$.post(
         		"checkLike.php",
             { mode : "like",
               postID : self.find(".hiddenID").attr('id')},
       			function(data){
       				if(data.result==1){ //만약 data값이 전송되면
       					$("i#empty").attr('class','fas fa-heart');
                var cntv = $("div#cnt").text();
                cntv*=1;
                $("div#cnt").html(cntv+1);
       					$("i#empty").css("color", "red");
       				}else{
                $("i#empty").attr('class','far fa-heart');
                var cntv = $("div#cnt").text();
                cntv*=1;
                $("div#cnt").html(cntv-1);
       					$("i#empty").css("color", "black");
              }
       			},
             'json'
           );

     	});
      $.post(
        "checkLike.php",
         {  mode : "check",
           postID : $('div.hiddenID').attr('id')},
        function(data){
          if(data.result==1){ //만약 data값이 전송되면
            $('i#empty').attr('class','fas fa-heart');
            $('i#empty').css("color", "red");
          }
        },
         'json'
       );
     });
    </script>
    <main class="description">
      <?php
        if($_SESSION['nickname']==$article['nickname']){
          echo <<<mode
          <div class="modAndDel">
            <a href="modify.php?postID=$postID">수정</a>
            <a href="delete.php?postID=$postID">삭제</a>
          </div>
          mode;
        }
       ?>

      <div class="postHead">
        <div class="title"><?=$article['recipeName']?></div>
        <div class="categoryAndWT">
          <div class="category"><?=$article['category']?></div>
          <div class="writeAndTime">
            <div class="writer"><?=$article['nickname']?></div>
            <div class="writer"><?=$article['uploadDate']?></div>
          </div>
        </div>
      </div>
      <div class="post">
        <div class="ingrediants">
          <div class="ing_title">
            재료
          </div>
          <div class="ingre"><?php
          $ingre = explode('MRCUT', $article['ingrediants']);
            foreach ($ingre as $value) {
              echo "<div class='ing'>".$value."</div>";
           }
           ?></div>

        </div>
        <div class="recipeBox">
          <div class="recipe_title">
            조리법
          </div>
          <div class="recipes">
            <?php
            $i = 0;
            while($i<$cnt){
              $num = $i+1;
              echo "<div class='cook'><div class='recipe'><h2>".$num."</h2>";
              if($data[0][$i]!=""){
                echo $data[0][$i]."</div>";
              }else{
                echo "</div>";
              }
              if($data[1][$i]!=""){
                echo "<img src='upload/".$data[1][$i]."' id='pic'></div>";
              }else{
                echo "</div>";
              }
              $i++;
            }
           ?>
          </div>
        </div>

        </div>
      </div>
    </main>
    <div class="foot">
      <div class="timebox">
        <span>타이머</span>
        <input type="text" id="min" value=""><span>분</span>
        <input type="text" id="sec" value=""><span>초</span>
        <button type="button" id="set" name="button">실행</button>
        <button type="button" id="stop" name="button">일시정지</button>
        <button type="button" id="reset" name="button">리셋</button>
      </div>
      <div class="foot_wrap">
        <div <?php if(empty($_SESSION["userid"])){
          echo 'style="display: none;"';
        } ?> class="like" id="likes">
          <div class="hiddenID" style="display: none;" <?php echo "id='".$article['postID']."'"; ?>></div>
          <i class="far fa-heart" id="empty"></i>
          <div id="cnt"><?=$article['like']?></div>
        </div>
        <div id="comment" onclick="location.href='comments.php?postID=<?=$article['postID']?>'">
          <?php
            $sql_comment = "select COUNT(*) FROM comments WHERE postID = '{$article['postID']}'";
            $result = $mysqli->query($sql_comment);
            $row = $result->fetch_array(MYSQLI_BOTH);
            echo "댓글 ".$row['COUNT(*)'];
           ?>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      var m = document.getElementById("min");
      var s = document.getElementById("sec");
      var set = document.getElementById("set");
      var stop = document.getElementById("stop");
      var reset = document.getElementById("reset");
      var time;
      var x;

      set.addEventListener("click",function(){
        time = parseInt(m.value) * 60 + parseInt(s.value) -1;
        var min;
        var sec;
        x = setInterval(function(){

          min = parseInt(time / 60);
          sec = time % 60;

          if(sec < 10){
            m.value = min;
            s.value = "0" + sec;
          }
          else{
            m.value = min;
            s.value = sec;
          }

          time--;

          if(time < -1){
            clearInterval(x);
            alert("타이머가 종료되었습니다.");
            m.value = null;
            s.value = null;
          }
        }, 1000);
      });

      stop.addEventListener("click",function(){
        clearInterval(x);
      });

      reset.addEventListener("click",function(){
        clearInterval(x);
        m.value = null;
        s.value = null;
      });
    </script>
  </body>
</html>
