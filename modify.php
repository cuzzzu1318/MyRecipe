<?php
  session_start();
  include('session_check.inc');
  $data = array(
    array(),
    array()
  );
  $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
  $postID = $_GET['postID'];
  $userID = $_SESSION['userid'];
  //게시글 작성자인지 확인
  $sql = "SELECT * FROM recipe WHERE postid='{$postID}' AND nickname=(SELECT nickname FROM user WHERE userid='{$userID}')";
  $result = $mysqli->query($sql);
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
    <link rel="stylesheet" href="write.css">
    <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
  </head>
  <body>
    <header>
      <img class="icon" src="image/icon_back.svg" alt="back" onclick="history.back()">
      <img class="logo_btn" src="image/logo.png" alt="main-logo" onclick="location.href='index.php'">
    </header>

    <main class="content">
      <form action="modify_process.php" method="post" enctype="multipart/form-data">
        <div class="field_top" name="name">
          <input type="text" class="top_name" value="레시피 등록">
        </div>
        <div class="field" name="title">
          <input type="text" class="textbox" id="recipe_title" value="레시피 제목">
          <input type="text" class="inputbox" id="input_title" value="<?=$article['recipeName']?>" name="recipeName" required>
        </div>

        <div class="field">
          <input type="text" class="textbox" id="recipe_title" value="카테고리">
          <select class="inputbox" id="slc_category" name="category">
            <option style="color: rgba(0, 0, 0, 0.54)" value="전체">종류를 선택해주세요.</option>
            <option <?php if($article['category']=='한식'){
              echo "selected";
            } ?>>한식</option>
            <option <?php if($article['category']=='중식'){
              echo "selected";
            } ?>>중식</option>
            <option <?php if($article['category']=='일식'){
              echo "selected";
            } ?>>일식</option>
            <option <?php if($article['category']=='양식'){
              echo "selected";
            } ?>>양식</option>
            <option <?php if($article['category']=='분식'){
              echo "selected";
            } ?>>분식</option>
            <option <?php if($article['category']=='아시안'){
              echo "selected";
            } ?>>아시안</option>
            <option <?php if($article['category']=='패스트푸드'){
              echo "selected";
            } ?>>패스트푸드</option>
            <option <?php if($article['category']=='디저트'){
              echo "selected";
            } ?>>디저트</option>
          </select>
        </div>

        <div class="field" name="cost">
          <input type="text" class="textbox" id="recipe_cost" value="레시피 가격">
          <input type="text" class="inputbox" id="input_cost" value="<?=$article['cost']?>" name="cost" pattern="\d*" required>
        </div>

        <div class="field" name="ingredient">
          <input type="text" class="textbox" id="recipe_cost" value="레시피 재료">
          <div class="box" >
            <div class="add">
              <?php
              $ingre = explode('MRCUT', $article['ingrediants']);
                foreach ($ingre as $value) {
                  echo '<div class="ing"> <input type="text" name = "ingredient[]" class="inputbox" id="recipe_ing" value="'.$value.'" <button type="button" class="btn_minus"><img src="image/button_minus.png" class="img_minus"></button> </div>';
               }
               ?>
            </div>
            <div class="field_btn_add" name=btnadd>
              <button type="button" class="btn_plus"><img src="image/button_plus.png" class="img_plus"></button>
            </div>
          </div>
        </div>
        <input type="hidden" name="originImg" value="<?=$article['img_name']?>">
        <input type="hidden" name="postID" value="<?=$article['postID']?>">
        <div class="field" name="recipe">
          <input type="text" class="textbox" id="recipe_cost" value="요리 순서">
          <div class="box">
            <div class="recipe_add">
              <?php
              $recipe = explode('MRCUT', $article['recipe']);
              $i = 1;
                foreach ($recipe as $value) {
                  echo '<div class="ing"> <span>'.$i.'</span> <input type="text" name = "recipe[]" class="inputbox" id="recipe_ing" value="'.$value.'" <button type="button" class="btn_minus"><img src="image/button_minus.png" class="img_minus"></button> </div>';
                  $i++;
               }
               ?>
            </div>
            <div class="field_btn_add" name=btnadd>
              <button type="button" class="btn_recipe_plus"><img src="image/button_plus.png" class="img_plus"></button>
            </div>
          </div>
        </div>

        <div class="write">
          <input type="submit" id="btn_write" value="작성하기">
        </div>
      </form>
      <script type="text/javascript">
        $(document).ready(function(){
          $(".btn_plus").click(function(){
            $('.add').append(
              "<div class='ing'> <span>"+i+"</span> <input type='text' class='inputbox' name='recipe[]'' id='recipe_ing' ".$value."> <button type='button' class='btn_recipe_minus'><img src='image/button_minus.png' class='img_minus'></button> </div><div class='img_plus'><input type='file' name='img_file[]' accept='image/*'></div>"
            );
            $('.btn_minus').on('click',function(){
              $(this).parent().remove();

            });
          });
        });
      </script>

      <script type="text/javascript">
        $(document).ready(function(){
          var i = <?php echo $i; ?>;
          $(".btn_recipe_plus").click(function(){

            $('.recipe_add').append("<div class='ing'> <span>"+i+"</span> <input type='text' class='inputbox' name='recipe[]'' id='recipe_ing' placeholder='예) 파를 다듬은 뒤 적당한 크기로 썰어주세요'> <button type='button' class='btn_recipe_minus'><img src='image/button_minus.png' class='img_minus'></button> </div><div class='img_plus'><input type='file' name='img_file[]' accept='image/*'></div>");
              i++;
            $('.btn_recipe_minus').on('click',function(){-
              i--;
              $(this).parent().remove();
            });
          });
        });
      </script>

    </main>
  </body>
</html>
