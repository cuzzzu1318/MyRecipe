<?php
session_start();
$conn = mysqli_connect("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");

$sql = "DELETE FROM user WHERE userid = '{$_SESSION['userid']}'";
$result = mysqli_query($conn, $sql);
session_destroy();

 ?>
 <script>
 location.href="index.php";
 </script>
