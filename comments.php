<?php
session_start();
$conn = mysqli_connect("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");

// $sql_nickname = "SELECT nickname FROM recipe WHERE postID = '{$_GET['postID']}'";
// $result_nickname = mysqli_query($conn, $sql_nickname);
// $row_nickname = mysqli_fetch_array($result_nickname);

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
      <div class="comments">
        <?php
        $sql = "SELECT * FROM comments WHERE postID='{$_GET['postID']}';";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($result)){
          echo <<<comments
          <div class='box'>
            <div class="text">
              <div class="nickname"><strong>{$row['nickname']}</strong></div><div class="comment">{$row['comment']}</div></div>
          comments;
          if($_SESSION['nickname']==$row['nickname']){
            echo <<<modify
                <div class="modifyAndDelete">
                  <div class ="modify"><a href="comments_modify.php?commentID={$row['commentID']}&postID={$_GET['postID']}">수정</a></div>
                  <div class ="delete"><a href="comments_delete_process.php?commentID={$row['commentID']}&postID={$_GET['postID']}">삭제</a></div>
                </div>
                </div>
              modify;
          }else{
            echo "</div>";
          }

        }
         ?>
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
                    <span><?php echo $_SESSION["nickname"]; ?></span>
                  </div>
                  <div class="write">
                      <textarea class="text" name= "textarea" onkeydown="resize(this)" onkeyup="resize(this)" cols="80" placeholder="댓글을 입력하시오."></textarea>
                      <input type = "hidden" name = "postID" value ="<?php echo $_GET['postID'];?>">
                      <input type = "hidden" name = "nickname" value ="<?php echo  $_SESSION["nickname"];?>"/>
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
