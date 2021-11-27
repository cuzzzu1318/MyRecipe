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
      <input type="button" class="btn" name="공지" value="메인" onclick="location.href='main.php'" >
      <input type="button" class="btn" name="게시판 보기" value="게시판 보기" onclick="location.href='category.php'"  id="cur_menu">
    </div>
    <div id="write_form">
      <form action="index.html" method="post" ENCTYPE="multipart/form-data">

      </form>
    </div>
  </body>
</html>
