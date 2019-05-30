<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_MSHOP_PATH.'/index.php');
    return;
}
define("_INDEX_", TRUE);
include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>

<!-- 메인화면 최신글 시작 -->
<?php echo display_banner('메인', 'mainbanner.1.skin.php'); ?>

<!-- 메인화면 최신글 끝 -->
<?
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>