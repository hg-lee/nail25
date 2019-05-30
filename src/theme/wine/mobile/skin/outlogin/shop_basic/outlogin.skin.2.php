<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$outlogin_skin_url.'/style.css">', 0);
?>

<!-- 로그인 후 외부로그인 시작 -->
<aside id="ol_after" class="ol">
   
    <h2>나의 회원정보</h2>
    <div id="ol_after_hd">
        <div class="profile_img">
            <?php echo get_member_profile_img($member['mb_id'], 60, 60); ?> <?php echo $nick ?>

        </div>
        <div class="btn_wr">
            <a href="<?php echo G5_SHOP_URL; ?>/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="sound_only"> 장바구니</span><strong class="count"><?php echo get_boxcart_datas_count(); ?></strong></a>
            <a href="<?php echo G5_BBS_URL ?>/memo.php" target="_blank" class="win_point">
                <i class="fa fa-envelope" aria-hidden="true"></i><span class="sound_only">안 읽은 쪽지</span>
                <strong class="count"><?php echo $memo_not_read ?></strong>
            </a>
        </div>
    </div>        
     <ul class="ol_my_link">
        <li id="ol_after_pt">
            <a href="<?php echo G5_BBS_URL ?>/point.php" target="_blank" class="win_point">포인트<strong><?php echo $point ?></strong></a>
        </li>
        <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이페이지</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form.php" id="ol_after_info">정보수정</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/logout.php" id="ol_after_logout">로그아웃</a></li>

    </ul>
  



</aside>

<script>
// 탈퇴의 경우 아래 코드를 연동하시면 됩니다.
function member_leave()
{
    if (confirm("정말 회원에서 탈퇴 하시겠습니까?"))
        location.href = "<?php echo G5_BBS_URL ?>/member_confirm.php?url=member_leave.php";
}
</script>
<!-- 로그인 후 외부로그인 끝 -->
