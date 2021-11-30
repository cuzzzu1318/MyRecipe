<?php
$conn = mysqli_connect("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
$sql = "SELECT * FROM comments";
$result = mysqli_query($conn, $sql);
$list = '';
while($row = mysqli_fetch_array($result)) {
  $list = $list."<li>{$row['comment']}</li>";
}
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
    <link rel="stylesheet" href="comments.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
  </head>
  <body>
    <header>
      <img class="icon" src="image/icon_back.svg" alt="back" onclick="history.back()">
      <h1>댓글 보기</h1>
    </header>

    <script type="text/javascript">
     document.querySelector('#메인').id='cur_menu';
    </script>
    <div class="wrap">
      <div class="watch_comment">
        <div class="per">
          <div class="watch_nickname">
            <div class="nickname">
              <span>닉네임</span>
            </div>
            <div class="view">
              <input type="text" class="view_text">
            </div>
          </div>
        </div>
      </div>

      <footer>
        <div class="write_comment">
          <form class="comment" action="comments_process.php" method="post">
            <div class="total">
              <div class="wrap_title">
                <div class="title">
                  <span>댓글 쓰기</span>
                </div>
                <div class="wrap_nickname">
                  <div class="nickname">
                    <span>닉네임</span>
                  </div>
                  <div class="write">
                    <textarea class="text" onkeydown="resize(this)" onkeyup="resize(this)" cols="80" placeholder="댓글을 입력하시오."></textarea>
                    <input type="submit" class="store" name="submit" value="등록">
                  </div>
                </div>
              </div>
            </div>
          </form>
          <script type="text/javascript">
            function resize(obj){
              obj.style.height = "1px";
              obj.style.height = (obj.scrollHeight)+"px";
            }
          </script>
        </div>
      </footer>
    </div>

  </body>
</html>
