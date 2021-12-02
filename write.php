<?php
  session_start();
  include('session_check.inc'); ?>
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
    <link rel="stylesheet" href="write.css">
    <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
  </head>
  <body>
    <header>
      <img class="icon" src="image/icon_back.svg" alt="back" onclick="history.back()">
      <img class="logo_btn" src="image/logo.png" alt="main-logo" onclick="location.href='index.php'">
    </header>

    <main class="content">
      <form action="write_process1.php" method="post" enctype="multipart/form-data">
        <div class="field_top" name="name">
          <input type="text" class="top_name" value="레시피 등록">
        </div>
        <div class="field" name="title">
          <input type="text" class="textbox" id="recipe_title" value="레시피 제목">
          <input type="text" class="inputbox" id="input_title" placeholder="예) 김치볶음밥 만들기" name="recipeName" required>
        </div>

        <div class="field">
          <input type="text" class="textbox" id="recipe_title" value="카테고리">
          <select class="inputbox" id="slc_category" name="category">
            <option style="color: rgba(0, 0, 0, 0.54)" value="전체">종류를 선택해주세요.</option>
            <option>한식</option>
            <option>중식</option>
            <option>일식</option>
            <option>양식</option>
            <option>분식</option>
            <option>아시안</option>
            <option>패스트푸드</option>
            <option>디저트</option>
          </select>
        </div>

        <div class="field" name="cost">
          <input type="text" class="textbox" id="recipe_cost" value="레시피 가격">
          <input type="text" class="inputbox" id="input_cost" placeholder="예) 5000원" name="cost" pattern="\d*" required>
        </div>

        <div class="field" name="ingredient">
          <input type="text" class="textbox" id="recipe_cost" value="레시피 재료">
          <div class="box" >
            <div class="add">
              <div class="ing">
                <input type="text" class="inputbox" name = "ingredient[]" id="recipe_ing" placeholder="예) 설탕 1T">
                <button type="button" class="btn_minus"><img src="image/button_minus.png" class="img_minus"></button>
              </div>
            </div>
            <div class="field_btn_add" name=btnadd>
              <button type="button" class="btn_plus"><img src="image/button_plus.png" class="img_plus"></button>
            </div>
          </div>
        </div>

        <div class="field" name="recipe">
          <input type="text" class="textbox" id="recipe_cost" value="요리 순서">
          <div class="box">
            <div class="recipe_add">
              <div class="ing">
                <span>1</span>
                <input type="text" class="inputbox" name="recipe[]" id="recipe_ing" placeholder="예) 파를 다듬은 뒤 적당한 크기로 썰어주세요">
                <button type="button" class="btn_recipe_minus"><img src="image/button_minus.png" class="img_minus"></button>
              </div>
            </div>
            <div class="field_btn_add" name=btnadd>
              <button type="button" class="btn_recipe_plus"><img src="image/button_plus.png" class="img_plus"></button>
            </div>
          </div>
        </div>

        <div id='image_preview'>
            <h3>이미지 첨부</h3>
            <input type='file' id='btnAtt' name = "image" accept="upload/*" multiple='multiple' />
            <div id='att_zone'
              data-placeholder='파일을 첨부 하려면 파일 선택 버튼을 클릭하거나 파일을 드래그앤드롭 하세요'></div>
          </div>

          <script>
        ( /* att_zone : 이미지들이 들어갈 위치 id, btn : file tag id */
          imageView = function imageView(att_zone, btn){

            var attZone = document.getElementById(att_zone);
            var btnAtt = document.getElementById(btn)
            var sel_files = [];

            // 이미지와 체크 박스를 감싸고 있는 div 속성
            var div_style = 'display:inline-block;position:relative;'
                          + 'width:150px;height:120px;margin:5px;border:1px solid #00f;z-index:1';
            // 미리보기 이미지 속성
            var img_style = 'width:100%;height:100%;z-index:none';
            // 이미지안에 표시되는 체크박스의 속성
            var chk_style = 'width:30px;height:30px;position:absolute;font-size:24px;'
                          + 'right:0px;bottom:0px;z-index:999;background-color:rgba(255,255,255,0.1);color:#f00';

            btnAtt.onchange = function(e){
              var files = e.target.files;
              var fileArr = Array.prototype.slice.call(files)
              for(f of fileArr){
                imageLoader(f);
              }
            }


            // 탐색기에서 드래그앤 드롭 사용
            attZone.addEventListener('dragenter', function(e){
              e.preventDefault();
              e.stopPropagation();
            }, false)

            attZone.addEventListener('dragover', function(e){
              e.preventDefault();
              e.stopPropagation();

            }, false)

            attZone.addEventListener('drop', function(e){
              var files = {};
              e.preventDefault();
              e.stopPropagation();
              var dt = e.dataTransfer;
              files = dt.files;
              for(f of files){
                imageLoader(f);
              }

            }, false)



            /*첨부된 이미리즐을 배열에 넣고 미리보기 */
            imageLoader = function(file){
              sel_files.push(file);
              var reader = new FileReader();
              reader.onload = function(ee){
                let img = document.createElement('img')
                img.setAttribute('style', img_style)
                img.src = ee.target.result;
                attZone.appendChild(makeDiv(img, file));
              }

              reader.readAsDataURL(file);
            }

            /*첨부된 파일이 있는 경우 checkbox와 함께 attZone에 추가할 div를 만들어 반환 */
            makeDiv = function(img, file){
              var div = document.createElement('div')
              div.setAttribute('style', div_style)

              var btn = document.createElement('input')
              btn.setAttribute('type', 'button')
              btn.setAttribute('value', 'x')
              btn.setAttribute('delFile', file.name);
              btn.setAttribute('style', chk_style);
              btn.onclick = function(ev){
                var ele = ev.srcElement;
                var delFile = ele.getAttribute('delFile');
                for(var i=0 ;i<sel_files.length; i++){
                  if(delFile== sel_files[i].name){
                    sel_files.splice(i, 1);
                  }
                }

                dt = new DataTransfer();
                for(f in sel_files) {
                  var file = sel_files[f];
                  dt.items.add(file);
                }
                btnAtt.files = dt.files;
                var p = ele.parentNode;
                attZone.removeChild(p)
              }
              div.appendChild(img)
              div.appendChild(btn)
              return div
            }
          }
        )('att_zone', 'btnAtt')

        </script>

        <div class="write">
          <input type="submit" id="btn_write" value="작성하기">
        </div>
      </form>
      <script type="text/javascript">
        $(document).ready(function(){
          $(".btn_plus").click(function(){
            $('.add').append(
              '<div class="ing"> <input type="text" name = "ingredient[]" class="inputbox" id="recipe_ing" placeholder="예) 설탕 1T"> <button type="button" class="btn_minus"><img src="image/button_minus.png" class="img_minus"></button> </div>'
            );
            $('.btn_minus').on('click',function(){
              $(this).parent().remove();

            });
          });
        });
      </script>

      <script type="text/javascript">
        $(document).ready(function(){
          var i = 2;
          $(".btn_recipe_plus").click(function(){

            $('.recipe_add').append("<div class='ing'> <span>"+i+"</span> <input type='text' class='inputbox' name='recipe[]'' id='recipe_ing' placeholder='예) 파를 다듬은 뒤 적당한 크기로 썰어주세요'> <button type='button' class='btn_recipe_minus'><img src='image/button_minus.png' class='img_minus'></button> </div>");
              i++;
            $('.btn_recipe_minus').on('click',function(){-
              i--;
              $(this).parent().remove();
            });
          });
        });
      </script>

    </main>
  </body>
</html>
