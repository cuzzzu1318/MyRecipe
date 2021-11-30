<?php
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
function getRealClientIp() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) {
        $ipaddress = getenv('HTTP_CLIENT_IP');
    } else if(getenv('HTTP_X_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    } else if(getenv('HTTP_X_FORWARDED')) {
        $ipaddress = getenv('HTTP_X_FORWARDED');
    } else if(getenv('HTTP_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    } else if(getenv('HTTP_FORWARDED')) {
        $ipaddress = getenv('HTTP_FORWARDED');
    } else if(getenv('REMOTE_ADDR')) {
        $ipaddress = getenv('REMOTE_ADDR');
    } else {
        $ipaddress = '알수없음';
    }
    return $ipaddress;

}

  $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
  $ip = getRealClientIp();
  if ($ip == '127.0.0.1') {
    $ip = "관리자";
  }
  if (empty($_POST['recipeName'])==false&&empty($_POST['recipe'])==false) {
    $filterd = array(
      'recipeName'=>$mysqli->real_escape_string($_POST['recipeName']),
      'recipe'=>$mysqli->real_escape_string($_POST['recipe'])
    );
    if (!empty($_FILES['image']['name'])) {
      $dir = './image';
      $name = GetUniqFileName($_FILES['image']['name'], $dir);
      move_uploaded_file($_FILES['image']['tmp_name'], "$dir/$name");
      $sql = "
      INSERT INTO topic
        (found, category, title, description, image, id, created)
        VALUES(
          '{$_POST['found']}',
          '{$_POST['select']}',
          '{$filterd['title']}',
          '{$filterd['content']}',
          '{$name}',
          '{$ip}',
          NOW()
        )
      ";
    }else{
      $sql = "
      INSERT INTO topic
        (found, category, title, description, id, created)
        VALUES(
          '{$_POST['found']}',
          '{$_POST['select']}',
          '{$filterd['title']}',
          '{$filterd['content']}',
          '{$ip}',
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
  }


 ?>
