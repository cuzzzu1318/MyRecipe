<?php
$conn = mysqli_connect("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
var_dump($_POST);
$sql = "INSERT INTO comments VALUES(
        {$_POST['postID']},
        {$_POST['nickname']},
        {$_POST['textarea']},
);";
$result = mysqli_query($conn, $sql);
if($result === false){
  echo '저장하는 과정에서 문제가 발생했습니다. 관리자에게 문의해주세;'
  error_log(mysqli_error($conn));
}
else{
  echo '성공했습니다. <a href="comments.php">돌아가기</a>';
}
 ?>
