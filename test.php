<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="Author" content="또군">
	<title>공지사항 롤링 by.또군</title>
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
	<style>
		/* 리셋css */
			html, body, div, span, applet, object, iframe,
			h1, h2, h3, h4, h5, h6, p, blockquote, pre,
			a, abbr, acronym, address, big, cite, code,
			del, dfn, em, img, ins, kbd, q, s, samp,
			small, strike, strong, sub, sup, tt, var,
			b, u, i, center,
			dl, dt, dd, ol, ul, li,
			fieldset, form, label, legend,
			table, caption, tbody, tfoot, thead, tr, th, td,
			article, aside, canvas, details, embed,
			figure, figcaption, footer, header, hgroup,
			menu, nav, output, ruby, section, summary,
			time, mark, audio, video {
				margin: 0;
				padding: 0;
				border: 0;
				font-size: 100%;
				font: inherit;
				vertical-align: baseline;
				text-decoration:none;
			}
			article, aside, details, figcaption, figure,
			footer, header, hgroup, menu, nav, section {
				display: block;
			}
			body {
				line-height: 1;
			}
			ol, ul {
				list-style: none;
			}
			blockquote, q {
				quotes: none;
			}
			blockquote:before, blockquote:after,
			q:before, q:after {
				content: '';
				content: none;
			}
			table {
				border-collapse: collapse;
				border-spacing: 0;
			}
		/* 또군css */
		body{background-color:#d1d1d1;}
		.notice{width:100%; height:50px; overflow:hidden; background-color:#fff;}
		.rolling{position:relative; width:100%; height:auto;}
		.rolling li{width:100%; height:50px; line-height:50px;}
		.rolling_stop{display:block; width:100px; height:20px; background-color:#000; color:#fff; text-align:center;}
		.rolling_start{display:block; width:100px; height:20px; background-color:#000; color:#0f0; text-align:center;}
	</style>
</head>
<body>
<div class="notice">
	<ul class="rolling">
		<li>
			<a href="#">공지사항 내용 1입니다.</a>
		</li>
		<li>
			<a href="#">공지사항 내용 2입니다.</a>
		</li>
		<li>
			<a href="#">공지사항 내용 3입니다.</a>
		</li>
		<li>
			<a href="#">공지사항 내용 4입니다.</a>
		</li>
		<li>
			<a href="#">공지사항 내용 5입니다.</a>
		</li>
	</ul>
</div>
<a href="#" class="rolling_stop">롤링 멈춤</a>
<a href="#" class="rolling_start">롤링 시작</a>
<script>
$(document).ready(function(){
	var height =  $(".notice").height();
	var num = $(".rolling li").length;
	var max = height * num;
	var move = 0;
	function noticeRolling(){
		move += height;
		$(".rolling").animate({"top":-move},600,function(){
			if( move >= max ){
				$(this).css("top",0);
				move = 0;
			};
		});
	};
	noticeRollingOff = setInterval(noticeRolling,1000);
	$(".rolling").append($(".rolling li").first().clone());

	$(".rolling_stop").click(function(){
		clearInterval(noticeRollingOff);
	});
	$(".rolling_start").click(function(){
		noticeRollingOff = setInterval(noticeRolling,1000);
	});
});
</script>
</body>
</html>
