

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
<script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
    <script>
    var checkID = false;
    var checkPW = false;
    $(document).ready(function(e) {
    	$(".check").on("keyup", function(){ //check라는 클래스에 입력을 감지
    		var self = $(this);
    		var userid;
    		if(self.attr("id") === "myRecipe_id"){
    			userid = self.val();
    		}

    		$.post(
      		"checkID.php",
          {  type : "id",
            checkValue:userid},
    			function(data){
    				if(data.result==1){ //만약 data값이 전송되면
    					self.parent().parent().find("p").html('회원가입이 가능한 아이디입니다.'); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
    					self.parent().parent().find("p").css("color", "blue"); //div 태그를 찾아 css효과로 빨간색을 설정합니다
              checkID = true;
    				}else{
              self.parent().parent().find("p").html('회원가입이 불가능한 아이디입니다.'); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
    					self.parent().parent().find("p").css("color", "red"); //div 태그를 찾아 css효과로 빨간색을 설정합니다
              checkID = false;
            }
    			},
          'json'
    		);
    	});
    });
    </script>
    <script>
        function check(){
          if(document.getElementById('myRecipe_id').innerText=='사용 가능한 아이디입니다.'){
             document.getElementById('signup').disabled = false;
           }
        }
    </script>
  </head>

  <body>
    <header>
      <img class="icon" src="image/icon_back.svg" alt="back">
      <h1>회원가입</h1>
    </header>
    <form name="register" action="member_process.php?mode=register" onsubmit="return check()" method="post" class="signup">
      <input type="text" class="check"name="myRecipe_id" id="myRecipe_id" placeholder="아이디를 입력해주세요" required>
      <p id="checkID" onchange="check()"></p>
      <input type="password" id="myRecipe_pw" placeholder="비밀번호를 입력해주세요" required>
      <input type="password" id="myRecipe_re-pw" name="myRecipe_re-pw" placeholder="비밀번호를 재입력해주세요" required>
      <div class="match" id="pw-match" >
        <span class=pw-match>비밀번호가 일치합니다.</span>
      </div>
      <div class="match" id="pw-unmatch">
        <span class=pw-unmatch>비밀번호가 일치하지 않습니다.</span>
      </div>
      <input type="text" id="myRecipe_nickname" name="myRecipe_nickname" placeholder="닉네임을 입력해주세요" required>
      <input type="submit" id="signup" disabled value="회원가입">
    </form>

    <script type="text/javascript">
      var pw = document.getElementById("myRecipe_pw");
      var re_pw = document.getElementById("myRecipe_re-pw");
      var pw_match = document.getElementById("pw-match");
      var pw_unmatch = document.getElementById("pw-unmatch");
      var myRecipe_id = document.getElementById("myRecipe_id");

      re_pw.addEventListener("keyup", function(e){
        if(pw.value == re_pw.value){
          pw_match.style.display = "block";
          pw_unmatch.style.display = "none";
          checkPW = true;
        }
        else{
          pw_match.style.display = "none";
          pw_unmatch.style.display = "block";
          checkPW = false;
        }
      })

      pw.addEventListener("keyup", function(e){
        if(re_pw.value==""){
          pw_match.style.display = "none";
          pw_unmatch.style.display = "none";
          checkPW = false;
        }
        else{
          if(pw.value == re_pw.value){
            pw_match.style.display = "block";
            pw_unmatch.style.display = "none";
            checkPW = true;
          }
          else{
            pw_match.style.display = "none";
            pw_unmatch.style.display = "block";
            checkPW = false;
          }
        }
      })
    </script>
  </body>
</html>
