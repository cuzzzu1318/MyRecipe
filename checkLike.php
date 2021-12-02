<?php
  session_start();
  include('session_check.inc');
  ?>
  <?php
  $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
  $mode = $_POST['mode'];
  $postID = $_POST['postID'];
  switch ($mode) {
    case 'check':
      $sql = "
      SELECT COUNT(*) as cnt FROM post_like WHERE userid='{$_SESSION['userid']}' AND postid ='{$postID}';
      ";
      $result = $mysqli->query($sql);
      $count = $result->fetch_array();
      if ($count['cnt']==0) {
        echo '{"result":"0"}';
      }else{
        echo '{"result":"1"}';
      }
      break;
    case 'like':
        $sql = "
        SELECT * FROM post_like WHERE userid='{$_SESSION['userid']}' AND postid ='{$postID}';
        ";
        $result = $mysqli->query($sql);
        $count = $result->fetch_array();
        if ($count==0) {
          $sql = "
          INSERT INTO post_like values ('{$postID}', '{$_SESSION['userid']}', NOW())
          ";
          $result = $mysqli->query($sql);
          $sql1 = "
          UPDATE recipe set likes = likes + 1 WHERE postid ='{$postID}';
          ";
          $result = $mysqli->query($sql1);
          echo '{"result":"1"}';
        }else{
          $sql2 = "DELETE FROM post_like WHERE postid ='{$postID}'  AND userid='{$_SESSION['userid']}' ;";
          $result = $mysqli->query($sql2);
          $sql3 = "
          UPDATE recipe set likes = likes - 1 WHERE postid ='{$postID}';
          ";
          $result = $mysqli->query($sql3);
          echo '{"result":"0"}';
        }
      break;
  }
?>
