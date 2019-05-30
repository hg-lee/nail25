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
<section id="ol_after" class="ol">
	<h2>나의 회원정보</h2>
    <header id="ol_after_hd">
        <span class="profile_img">
            <?php echo get_member_profile_img($member['mb_id']); ?>
        </span>
        <strong><?php echo $nick ?>님</strong>
    	<a href="<?php echo G5_BBS_URL ?>/point.php" target="_blank" id="ol_after_pt" class="win_point">포인트 <b><?php echo $point ?></b> 점</a>
    </header>
    <ul id="ol_after_private">
    	<li>
    		<a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form.php" id="ol_after_info" title="정보수정">정보수정</a>
    	</li>
        <li>
            <a href="<?php echo G5_BBS_URL ?>/memo.php" target="_blank" id="ol_after_memo" class="win_memo">
				<i class="fa fa-envelope-o" aria-hidden="true"></i>
				<span class="sound_only">안 읽은 </span>쪽지
				
                <strong><?php echo $memo_not_read ?></strong>
            </a>
        </li>
        <li>
            <a href="<?php echo G5_BBS_URL ?>/scrap.php" target="_blank" id="ol_after_scrap" class="win_scrap">
            	<i class="fa fa-thumb-tack" aria-hidden="true"></i>
            	스크랩
            	<strong class="scrap"><?php echo $point ?></strong>
            </a>     
        </li>
    </ul>
    <a href="<?php echo G5_BBS_URL ?>/logout.php" id="ol_after_logout" class="btn_b04">로그아웃</a>
</section>
<button class="login_cls_btn"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">닫기</span></button>

<script>
// 탈퇴의 경우 아래 코드를 연동하시면 됩니다.
function member_leave()
{
    if (confirm("정말 회원에서 탈퇴 하시겠습니까?"))
        location.href = "<?php echo G5_BBS_URL ?>/member_confirm.php?url=member_leave.php";
}
</script>
<!-- } 로그인 후 아웃로그인 끝 -->
