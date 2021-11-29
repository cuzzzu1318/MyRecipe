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
    <link rel="stylesheet" href="signin.css">
  </head>

  <body>
    <header>
      <img class="icon" src="image/icon_back.svg" alt="back" onclick="history.back()">
      <h1>로그인</h1>
    </header>

    <main class="content">
      <form action="member_process.php?mode=signin"  class="login" method="post">
        <input type="text" id="id" placeholder="아이디를 입력해주세요">
        <input type="text" id="pw" placeholder="비밀번호를 입력해주세요">
        <input type="submit" id="login_submit" value="login" onclick="location.href='index.php'">
      </form>
      <input type="button" id="signup" value="회원가입" onclick="location.href='signup.php'">
    </main>
  </body>
</html>
