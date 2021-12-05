<?php
session_start();
$conn = mysqli_connect("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");

$sql = "DELETE FROM comments WHERE commentID = {$_GET['commentID']}";
$result = mysqli_query($conn, $sql);


 ?>
 <script>
 location.href="comments.php?postID=<?php echo $_GET['postID']; ?>";
 </script>
