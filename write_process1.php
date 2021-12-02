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
  $recipeName = $mysqli->real_escape_string($_POST['recipeName']);
  $category = $mysqli->real_escape_string($_POST['category']);
  $cost = $mysqli->real_escape_string($_POST['cost']);
  $ingrediants = $mysqli->real_escape_string(implode('MRCUT',$_POST['ingredient']));
  echo $ingredients.'<br>';
  $recipe = $mysqli->real_escape_string(implode('MRCUT',$_POST['recipe']));
  echo $recipe;
  if (!empty($_FILES['image']['name'])) {
    $dir = './image';
    $img = $_FILES['img_file'];
    $name = $img['name'];
    $cnt = count($img['name']);
     while ($cnt>0) {
       $img['name'][$cnt-1] = GetUniqFileName($img['name'][$cnt-1], $dir);
       $cc = $img['name'][$cnt-1];
       move_uploaded_file($img['tmp_name'][$cnt-1], "$dir/$cc");
       $cnt--;
     }
    $name = implode(',', $img['name']);
      $sql = "
      INSERT INTO recipe
        (category, recipeName, ingrediants, recipe, cost, nickname, img_name, uploadDate)
        VALUES(
          '{$category}',
          '{$recipeName}',
          '{$ingrediants}',
          '{$recipe}',
          '{$cost}',
          (SELECT nickname FROM user WHERE userid = '{$_SESSION['userid']}'),
          '{$name}'
          NOW()
        )
      ";
    }else{
      $sql = "
      INSERT INTO recipe
        (category, recipeName, ingrediants, recipe, cost, nickname, uploadDate)
        VALUES(
          '{$category}',
          '{$recipeName}',
          '{$ingrediants}',
          '{$recipe}',
          '{$cost}',
          (SELECT nickname FROM user WHERE userid = '{$_SESSION['userid']}'),
          NOW()
        )
      ";
    }
    $result = $mysqli->query($sql);
    if ($result == false) {
      echo $mysqli->error;
    }else{
        header('Location: list.php?cur_page=1');
      }
 ?>
