<?php
session_start();
$conn = mysqli_connect("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");



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
      <h1>댓글 수정</h1>
    </header>
      <div class="comments">
        <?php
        $sql = "SELECT * FROM comments WHERE commentID= {$_GET['commentID']};";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_array($result)){
          $comment = $row['comment'];
          echo <<<comments
          <div class='box'>
            <div class="text">
              <div class="nickname"><strong>수정할 댓글</strong></div><div class="comment">{$row['comment']}</div></div>
          comments;
          if($_SESSION['nickname']==$row['nickname']){
            echo <<<modify
                <div class="modifyAndDelete">
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
          <form class="comment" action="comments_modify_process.php" method="post">
            <div class="total">
              <div class="wrap_title">
                <div class="title">
                  <span>댓글 수정하기</span>
                </div>
                <div class="wrap_nickname">
                  <div class="nickname">
                    <span><?php echo $_SESSION["nickname"]; ?></span>
                  </div>
                  <div class="write">
                      <textarea class="text" name= "textarea" onkeydown="resize(this)" onkeyup="resize(this)" cols="80"><?php echo $comment; ?></textarea>
                      <input type = "hidden" name = "postID" value ="<?php echo $_GET['postID'];?>">
                      <input type = "hidden" name = "commentID" value ="<?php echo $_GET['commentID']; ?>">
                      <input type = "hidden" name = "nickname" value ="<?php echo  $_SESSION["nickname"];?>"/>
                      <input type="submit" class="store" name="submit" value="수정">
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
