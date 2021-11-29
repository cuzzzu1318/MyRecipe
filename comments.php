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
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
  </head>
  <body>
    <?php include('header.inc'); ?>
    <?php include('nav.inc'); ?>
    <script type="text/javascript">
     document.querySelector('#메인').id='cur_menu';
    </script>
    <div class="func_comment">
      <div class="comments">
        <ol>
          <?php
            echo $list;
          ?>
        </ol>
      </div>
      <form class="comment" action="comments_process.php" method="post">
        <p><textarea name="textarea" rows="8" cols="80" placeholder="댓글 내용을 입력해주세요."></textarea><p>
        <p><input type="submit" name="submit" value="작성완료"></p>
      </form>
    </div>

  </body>
</html>
