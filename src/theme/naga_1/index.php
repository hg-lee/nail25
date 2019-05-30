<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>

<div class="col-md-12" style="padding-bottom:15px">
	<div class="col-md-5 col-xs-12">
<?php echo latest('theme/notice', 'notice', 5, 20); ?>
<!-- <?php echo latest('theme/notice', '게시판ID입력부분입니다.', 5, 20); ?> -->
</div>
	<div class="col-md-4 col-xs-6">
		<a href="/bbs/content.php?co_id=company">
		<h3>동원전기ENG소개</h3>
		<p>
			자세히 보기
		</p>
		<img src="이미지주소"> </a>
	</div>

	<div class="col-md-3 col-xs-6">
		<a href="">
		<h3>1:1 문의</h3>
		<p>
			관리자님.! 질문있어요.!
		</p>
		<img src="이미지주소"> </a>
	</div>
</div>
<div class="col-md-12">　</div>


	<div style="width:100%">
<?php echo latest('theme/photo', 'port', 3, 30); ?>
</div>
<div class="col-md-12">　</div>
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>