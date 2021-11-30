<?php
  session_start();
  include('session_check.inc');
  $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
  $postID = $_POST['postID'];
  $sql = "
  SELECT * FROM post_like WHERE userid='{$_SESSION['userid']} AND postid = '{$postid}''
  ";
  $result = $mysqli->query($sql);
  $count = $result->fetch_array();
  if ($count==0) {
    $sql = "
    INSERT INTO post_like values ('{$postID}', '{$_SESSION['userid']}')
    ";
    $result = $mysqli->query($sql);
    echo '{"result":"1"}';
  }else{
    echo '{"result":"0"}';
  }
?>
