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
    <link rel="stylesheet" href="signup.css">
  </head>

  <body>
    <header>
      <img class="icon" src="image/icon_back.svg" alt="back">
      <h1>회원가입</h1>
    </header>

    <div class="content">
      <input type="text" id="id" placeholder="아이디를 입력해주세요">
      <input type="password" id="pw" placeholder="비밀번호를 입력해주세요">
      <input type="password" id="re-pw" placeholder="비밀번호를 재입력해주세요">
      <div class="match" id="pw-match">
        <span class=pw-match>비밀번호가 일치합니다.</span>
      </div>
      <div class="match" id="pw-unmatch">
        <span class=pw-unmatch>비밀번호가 일치하지 않습니다.</span>
      </div>
      <input type="text" id="nickname" placeholder="닉네임을 입력해주세요">
      <input type="button" id="signup" value="회원가입" onclick="location.href='signin.php'">
    </div>

    <script type="text/javascript">
      var pw = document.getElementById("pw");
      var re_pw = document.getElementById("re-pw");
      var pw_match = document.getElementById("pw-match");
      var pw_unmatch = document.getElementById("pw-unmatch");

      re_pw.addEventListener("keyup", function(e){
        if(pw.value == re_pw.value){
          pw_match.style.display = "block";
          pw_unmatch.style.display = "none";
        }
        else{
          pw_match.style.display = "none";
          pw_unmatch.style.display = "block";
        }
      })

      pw.addEventListener("keyup", function(e){
        if(re_pw.value==""){
          pw_match.style.display = "none";
          pw_unmatch.style.display = "none";
        }
        else{
          if(pw.value == re_pw.value){
            pw_match.style.display = "block";
            pw_unmatch.style.display = "none";
          }
          else{
            pw_match.style.display = "none";
            pw_unmatch.style.display = "block";
          }
        }
      })
    </script>
  </body>
</html>
