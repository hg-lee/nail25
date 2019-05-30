<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// 스크랩 갯수 표시
$sql = " select count(*) as cnt from {$g5['scrap_table']} where mb_id = '{$member['mb_id']}' ";
$row = sql_fetch($sql);
$scrap_cnt = $row['cnt'];

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);
?>

<!-- 로그인 후 아웃로그인 시작 { -->
<section id="gn_ol_after" class="gnb_ol">
	<h2>나의 회원정보</h2>
    <span class="profile_img">
        <?php echo get_member_profile_img($member['mb_id']); ?>
    </span>
    <strong><?php echo $nick ?>님</strong>
</section>

<script>
// 탈퇴의 경우 아래 코드를 연동하시면 됩니다.
function member_leave()
{
    if (confirm("정말 회원에서 탈퇴 하시겠습니까?"))
        location.href = "<?php echo G5_BBS_URL ?>/member_confirm.php?url=member_leave.php";
}
</script>
<!-- } 로그인 후 아웃로그인 끝 -->
