<?php
if( !empty($_SESSION["userid"])){//세션에 값이 있는 경우
    if(time() - $_SESSION["signin_time"] > 60 * 1) {  //로그인 지속시간(분단위, 30분)
        unset($_SESSION["userid"]);
        session_unset();
        session_destroy();
        ?>
        <script>
          alert('세션이 만료되었습니다.');
          history.back();
        </script>
    <?php
    }
    else{//세션 갱신
      $_SESSION['signin_time'] = time();
    }
}
else{
  ?>
  <script>
    alert('로그인이 필요합니다.');
    location.href = "signin.php";
  </script>
  <?php
}
 ?>
