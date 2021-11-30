<?php
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
        'like' => htmlspecialchars($row['like']),
        'nickname' => htmlspecialchars($row['nickname']),
        'uploadDate' => substr(htmlspecialchars($row['uploadDate']), 2, 14)
      );
    }else{
      echo '<script>alert("잘못된 접근입니다!");</script>';
      echo("<script>location.replace('list.php');</script>");
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
    <link rel="stylesheet" href="post.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
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
             {  postID : self.find(".hiddenID").attr('id')},
       			function(data){
       				if(data.result==1){ //만약 data값이 전송되면
       					self.child().find(".far fa-heart").class('fas fa-heart');
       					self.parent().parent().find("p#checkID").css("color", "blue");
       				}else{
                 self.parent().parent().find("p#checkID").html('중복된 아이디입니다.');
       					self.parent().parent().find("p#checkID").css("color", "red");
               }
       			},
             'json'
           );

     	});
     });
    </script>
    <main class="description">
    <div class="modAndDel">
      <a href="">수정</a>
      <a href="">삭제</a>
    </div>
      <div class="postHead">
        <div class="title"><?=$article['recipeName']?></div>
        <div class="writeAndTime">
          <div class="writer"><?=$article['nickname']?></div>
          <div class="writer"><?=$article['uploadDate']?></div>
        </div>
      </div>
      <div class="post">
        <div class="ingrediants">
          <div class="ing_title">
            재료
          </div>
          <div class="ingre"><?php
            $ing = explode('MRCUT', $article['ingrediants']);
            foreach ($ing as $value) {
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
              $recipe = explode('MRCUT', $article['recipe']);
              foreach ($recipe as $value) {
                echo "<div class='recipe'>".$value."</div>";
               }
           ?>
          </div>
        </div>
        <div class="like" id="likes">
          <div class="hiddenID" style="display: none;" <?php echo "id='".$article['postID']."'"; ?>></div>
          <i class="far fa-heart"></i>
          <span>좋아요</span>
        </div>
      </div>
    </main>
  </body>
</html>
