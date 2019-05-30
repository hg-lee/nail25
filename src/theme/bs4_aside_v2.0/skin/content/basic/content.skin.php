<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/aside.php');
?>

<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/skin/content/basic/style.css">

	<div id="content">
		<!-- Page Content -->
		<div class="section-header page">	
			<h3><?php echo $g5['title'] ?></h3>
		</div> 
		<div id="ctt_con">
			<?php echo $str; ?>
    </div>
	</div>