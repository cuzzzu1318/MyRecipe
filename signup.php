
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
    <script>
        function checkId(id) {
          <?php
            $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
            $userid = "<script>document.write(id);</script>";
            echo $userid."aa";
          ?>
        }
        function check(){
          if(!register.double_check.value){
         alert("ID 중복체크를 하세요");
         return false;
          }
         return true;
        }
    </script>
  </head>

  <body>
    <header>
      <img class="icon" src="image/icon_back.svg" alt="back">
      <h1>회원가입</h1>
    </header>
    <form name="register" action="member_process.php?mode=register" onsubmit="return check()" method="post" class="signup">
      <input type="text" name="myRecipe_id" id="myRecipe_id" placeholder="아이디를 입력해주세요" required>
      <input type="button" name="double_check" id="double_check" value="중복 확인" onclick="checkId(document.getElementsByName(myRecipe_id).value);">
      <input type="password" id="myRecipe_pw" placeholder="비밀번호를 입력해주세요" required>
      <input type="password" id="myRecipe_re-pw" name="myRecipe_re-pw" placeholder="비밀번호를 재입력해주세요" required>
      <div class="match" id="pw-match" >
        <span class=pw-match>비밀번호가 일치합니다.</span>
      </div>
      <div class="match" id="pw-unmatch">
        <span class=pw-unmatch>비밀번호가 일치하지 않습니다.</span>
      </div>
      <input type="text" id="myRecipe_nickname" name="myRecipe_nickname" placeholder="닉네임을 입력해주세요" required>
      <input type="submit" id="signup"  value="회원가입">
    </form>

    <script type="text/javascript">
      var pw = document.getElementById("myRecipe_pw");
      var re_pw = document.getElementById("myRecipe_re-pw");
      var pw_match = document.getElementById("pw-match");
      var pw_unmatch = document.getElementById("pw-unmatch");
      var double_check = document.getElementById("double_check");

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
