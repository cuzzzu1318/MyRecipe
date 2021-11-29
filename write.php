<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <meta charset="utf-8"  name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no,
maximum-scale=1.0, minimum-scale=1.0">
    <title>MyRecipe</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
    crossorigin="anonymous">
    <link rel="stylesheet" href="myRecipe.css">
    <link rel="stylesheet" href="write.css">
  </head>
  <body>
    <header>
      <img class="icon" src="image/icon_back.svg" alt="back" onclick="history.back()">
      <img class="logo_btn" src="image/logo.png" alt="main-logo" onclick="location.href='index.php'">
    </header>

    <main class="content">
      <div class="field_top" name="name">
        <input type="text" class="name" value="레시피 등록">
      </div>
      <div class="field" name="title">
        <input type="text" class="textbox" id="recipe_title" value="레시피 제목">
        <input type="text" class="inputbox" id="input_title" placeholder="예) 김치볶음밥 만들기">
      </div>

      <div class="field" name="category">
        <input type="text" class="textbox" id="recipe_title" value="카테고리">
        <select class="inputbox" id="slc_category">
          <option style="color: rgba(0, 0, 0, 0.54)">종류를 선택해주세요.</option>
          <option>한식</option>
          <option>중식</option>
          <option>일식</option>
          <option>양식</option>
          <option>분식</option>
          <option>아시안</option>
          <option>패스트푸드</option>
          <option>디저트</option>
        </select>
      </div>

      <div class="field" name="cost">
        <input type="text" class="textbox" id="recipe_cost" value="레시피 가격">
        <input type="text" class="inputbox" id="input_cost" placeholder="예) 5000원">
      </div>

      <div class="field" name="ingredient">
        <input type="text" class="textbox" id="recipe_cost" value="레시피 재료">
        <div class="ing">
          <input type="text" class="inputbox" id="recipe_ing" placeholder="예) 설탕">
          <input type="text" class="inputbox" id="ing_cost" placeholder="예) 1T">
          <button type="button" class="btn_minus"><img src="image/button_minus.png" class="img_minus"></button>
        </div>
      </div>

        <button type="button" class="btn_plus"><img src="image/button_plus.png" class="img_plus"></button>
        <script type="text/javascript">
          $(document).ready(function(){
            $('.btn_plus').click(function(){
              $('.ing').append('<input type="text" class="inputbox" id="recipe_ing" placeholder="예) 설탕"> <input type="text" class="inputbox" id="ing_cost" placeholder="예) 1T">\
              <button type="button" class="btn_minus">\
              <img src="image/button_minus.png" class="img_minus">
              </button>'
              );
              $('.button_minus').on('click',function(){
                $(this).prev().remove();
                $(this).next().remove();
                $(this).remove();
              });
            });
          });
        </script>



    </main>



  </body>
</html>
