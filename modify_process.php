<?php
session_start();
include('session_check.inc');

function GetUniqFileName($FN, $PN)
{
  $FileExt = substr(strrchr($FN, "."), 1);
  $FileName = substr($FN, 0, strlen($FN) - strlen($FileExt) - 1);
  $FileCnt=0;
  $ret = "$FileName.$FileExt";
  while(file_exists($PN."/".$ret))
  {
    $FileCnt++;
    $ret = $FileName."_".$FileCnt.".".$FileExt;
  }

  return($ret);
}

  $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
  $postID = $mysqli->real_escape_string($_POST['postID']);
  $recipeName = $mysqli->real_escape_string($_POST['recipeName']);
  $category = $mysqli->real_escape_string($_POST['category']);
  $cost = $mysqli->real_escape_string($_POST['cost']);
  $ingrediants = $mysqli->real_escape_string(implode('MRCUT',$_POST['ingredient']));
  $recipe = $mysqli->real_escape_string(implode('MRCUT',$_POST['recipe']));
  $originImg = $mysqli->real_escape_string($_POST['originImg']);
  echo $recipe;
  if (!empty($_FILES['img_file']['name'])) {
    $dir = './upload';
    $img = $_FILES['img_file'];
    $name = $img['name'];
    $cnt = count($img['name']);
    echo $cnt;
     while ($cnt>0) {
       if (!empty($img['name'][$cnt-1])) {
         $img['name'][$cnt-1] = GetUniqFileName($img['name'][$cnt-1], $dir);
         $cc = $img['name'][$cnt-1];
       }
       move_uploaded_file($img['tmp_name'][$cnt-1], "$dir/$cc");
       $cnt--;
     }
    $name = implode(',', $img['name']);
    $name = $originImg.",".$name;
    $sql = "
      UPDATE recipe SET category='{$category}', recipename='{$recipeName}', ingrediants='{$ingrediants}', recipe='{$recipe}',
      cost='{$cost}', img_name='{$name}' WHERE postID = '{$postID}'
      ";
    }else{
      $sql = "
        UPDATE recipe SET category='{$category}', recipename='{$recipeName}', ingrediants='{$ingrediants}', recipe='{$recipe}',
        cost='{$cost}' WHERE postID = '{$postID}'
        ";
    }
    $result = $mysqli->query($sql);
    if ($result == false) {
      echo $mysqli->error;
    }else{
        header('Location: list.php?cur_page=1');
      }
 ?>
