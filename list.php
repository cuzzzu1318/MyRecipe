<?php
  $mysqli = new mysqli("localhost", "myrecipe", "thwnrhdgkr202!", "myrecipe");
  if (isset($_GET['cur_page'])) {
      $cur_page = $_GET['cur_page'];
    }else {
      $cur_page = 1;
    }
    $show = 10;
    $start = (($cur_page-1)*$show);

    function getTitle($title){
      if (mb_strlen($title, "UTF-8")>10) {
        return mb_substr($title,0, 10, "UTF-8")."...";
      }else{
        return $title;
      }

    }
 ?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8"  name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no,
maximum-scale=1.0, minimum-scale=1.0">
    <title>MyRecipe</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm"
    crossorigin="anonymous">
    <link rel="stylesheet" href="myRecipe.css">
    <link rel="stylesheet" href="list.css">
  </head>
  <body>
    <?php include('header.inc'); ?>
    <?php include('nav.inc'); ?>
    <script type="text/javascript">
     document.querySelector('#게시판').id='cur_menu';
    </script>
    <form class="" action="list.php" method="post">
      <div class="category">
        <select class="mr_select" id="category" onchange="submit()" name="cate">
          <option
          <?php if(isset($_POST['cate'])&&$_POST['cate']=='전체'){
            echo "selected";
          } ?>
            value="전체"
            >
            전체
          </option>
          <option value="한식"
          <?php if(isset($_POST['cate'])&&$_POST['cate']=='한식'){
            echo "selected";
          } ?>
          >
            한식
          </option>
          <option value="중식"<?php if(isset($_POST['cate'])&&$_POST['cate']=='중식'){
            echo "selected";
          } ?>>
            중식
          </option>
          <option <?php if(isset($_POST['cate'])&&$_POST['cate']=='양식'){
            echo "selected";
          } ?>>
            양식
          </option>
          <option <?php if(isset($_POST['cate'])&&$_POST['cate']=='일식'){
            echo "selected";
          } ?>>
            일식
          </option>
          <option <?php if(isset($_POST['cate'])&&$_POST['cate']=='분식'){
            echo "selected";
          } ?>>
            분식
          </option>
          <option <?php if(isset($_POST['cate'])&&$_POST['cate']=='아시안'){
            echo "selected";
          } ?>>
            아시안
          </option>
          <option <?php if(isset($_POST['cate'])&&$_POST['cate']=='아시안'){
            echo "selected";
          } ?>>
            패스트푸드
          </option>
          <option <?php if(isset($_POST['cate'])&&$_POST['cate']=='디저트'){
            echo "selected";
          } ?>>
            디저트
          </option>
        </select>
      </div>
    </form>
    <main class="description">
      <table>
        <thead>
          <tr>
            <th scope="col">추천 수</th>
            <th scope="col">제목</th>
            <th scope="col">비용</th>
            <th scope="col">작성자</th>
          </tr>
        </thead>
        <?php
        if(isset($_POST['cate'])&&$_POST['cate']!='전체'){
          $cate = $_POST['cate'];
          $sql = "
            SELECT * FROM recipe WHERE category = '$cate' ORDER BY postID DESC LIMIT $start, $show ;
          ";
        }else{
          $sql = "
            SELECT * FROM recipe ORDER BY postID DESC LIMIT $start, $show ;
          ";
        }
        $result = $mysqli->query($sql);
        if ($result == false) {
        echo $mysqli->error;
        }else{
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
              $article = array(
                'category' => $row['category'],
                'postID' => htmlspecialchars($row['postID']),
                'recipeName' => htmlspecialchars($row['recipeName']),
                'cost' =>number_format(htmlspecialchars($row['cost'])),
                'like' => htmlspecialchars($row['like']),
                'nickname' => htmlspecialchars($row['nickname']),
                'uploadDate' => htmlspecialchars($row['uploadDate'])
              );

            ?>

            <tbody>
             <tr style="height: 50px; cursor: pointer;" onclick="location.href='post.php?postID=<?=$row['postID']?>';">
               <td style="width: 50px;"><?=$article['like']?></td>
               <td style="width: 170px;"><?=getTitle($article['recipeName'])?></td>
               <td><?=$article['cost']?></td>
               <td><?=$article['nickname']?></td>
             </tr>
            </tbody>
            <?php
          }
          }
        }
         ?>
    </table>

  <div id="page">
    <div id="prev">
      <?php
      if ($cur_page>1) {
        $prev_page = $cur_page-1;
        echo "
        <a href=\"list.php?cur_page=$prev_page\">이전</a>
        ";
      }
      ?>
    </div>
    <div id="pages">
      <?php
      if(isset($_POST['cate'])&&$_POST['cate']!='전체'){
        $cate = $_POST['cate'];
        $sql = "
          SELECT COUNT(*) FROM recipe WHERE category = '$cate';
        ";
      }else{
        $sql = "
          SELECT COUNT(*) FROM recipe;
        ";
      }
      $result = $mysqli->query($sql);
      $row = $result->fetch_array();
      $page = 1;
      for ($count=0; $count < $row[0]; $count++) {
        if ($count%10==1) {
          if ($cur_page==$page) {
            echo "
            <a class=\"pagenum\" href=\"list.php?cur_page=$page\">$page</a>
            ";
          }
          else {
            echo "
            <a class=\"pagenum\" href=\"list.php?cur_page=$page\">$page</a>
            ";
          }
          $page++;
        }
      }
      ?>
    </div>
    <div id="next">
      <?php
      if ($cur_page<$page-1) {
        $next_page = $cur_page+1;
        echo "
        <a href=\"list.php?cur_page=$next_page\">다음</a>
        ";
      }
       ?>
    </div>
  </div>
    </main>
  <img src="image/button_plus.png" onclick="location.href='write.php'" id="write" alt="">
  </body>
</html>
