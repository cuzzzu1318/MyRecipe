<?php
  $mysqli = new mysqli("localhost", "myRecipe", "pa22w0rd!", "myRecipe");
 ?>
 <!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8"  name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no,
maximum-scale=1.0, minimum-scale=1.0">
    <title>카테고리 선택</title>
    <link rel="stylesheet" href="myRecipe.css">
    <link rel="stylesheet" href="category.css">
  </head>
  <body>
    <header>
      <a href="main.php"><img class="logo" src="image/logo.png" alt="logo"></a>
          <input type="text" id="input_search" placeholder="레시피, 재료, 작성자">
      <img class="icon" src="image/icon_user.svg" alt="user">
    </header>

    <div class="menu_bar">
      <input type="button" class="btn" name="공지" value="메인" >
      <input type="button" class="btn" name="게시판 보기" value="게시판 보기" onclick="location.href='category.php'" style="border-bottom: 5px solid black;">
    </div>
    <div class="div_button_category">
      <button type="button" class="button_category" value="전체">전체</button>
    <?php
      $sql = "
          SELECT DISTINCT category FROM recipe;
      ";
      $result = $mysqli->query($sql);
      if($result == false){
        echo $mysqli->error;
      }else{
        if($result->num_rows > 0){
          while($row = $result->fetch_array()){
            $category = $row['category'];
            ?>
              <button type="button" class="button_category" value="<?=$category?>"><?=$category?></button>
            <?php
          }
        }
      }
    ?>
  </div>

  </body>
</html>
