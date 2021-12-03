  <header>
    <a href="/"><img class="logo" src="image/logo.png" alt="logo"></a>
    <form class="form_search" action="list.php" method="post">
      <input type="text" id="input_search" placeholder="레시피, 재료, 작성자">
      <input type="submit" name="" class="search_submit" value="검색">
    </form>
        <?php
        session_start();
        if(empty($_SESSION["userid"])){
            echo <<<login
            <div class="login"><a  href="signin.php">로그인</a></div>
            login;
        }
        else{
          echo <<<mypage
          <img class="icon" src="image/icon_user.svg" alt="user" onclick="location.href='signin.php'">
          mypage;
        }
         ?>


  </header>
