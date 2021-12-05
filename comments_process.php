<?php
$conn = mysqli_connect("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
$postID = $_POST['postID'];
$nickname = $_POST['nickname'];
$textarea = $_POST['textarea'];
$sql = "INSERT INTO comments (postID, nickname, comment)VALUES(
        '{$postID}', '{$nickname}', '{$textarea}'
);";
$result = mysqli_query($conn, $sql);
if($result === false){
  echo '저장하는 과정에서 문제가 발생했습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
}
else{
  ?>
  <script>
    location.href="comments.php?postID=<?php echo $postID; ?>";
  </script>
  <?php
}
 ?>
