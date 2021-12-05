<?php
session_start();
$conn = mysqli_connect("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");

$sql = "UPDATE comments
        SET comment = '{$_POST['textarea']}'
        WHERE commentID = {$_POST['commentID']} ";
$result = mysqli_query($conn, $sql);
?>
<script>
  location.href="comments.php?postID=<?php echo $_POST['postID']; ?>";
</script>
