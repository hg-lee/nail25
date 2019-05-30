<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

if(defined('_INDEX_')) { // index에서만 실행
    include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
}
?>

<div id="site_wrap">
    <div class="header">
        <h1><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/logo.png" alt="<?php echo $config[cf_title] ?>"></a></h1>
        <div class="global_nav">
            <ul>
                <?php if ($is_member) {  ?>
                <?php if ($is_admin) {  ?>
                <li><a href="<?php echo G5_ADMIN_URL ?>"><b>관리자</b></a></li>
                <?php }  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">정보수정</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                <?php } else {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/login.php"><b>로그인</b></a></li>
                <?php }  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/faq.php">FAQ</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/qalist.php">1:1문의</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/current_connect.php">접속자 <?php echo connect('basic'); // 현재 접속자수, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?></a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/new.php">새글</a></li>
            </ul>
        </div>
		
<style>
#mobile-header, #navigation {
    display: none;
}
@media only screen and (max-width: 767px){
    #mobile-header {
        display: block;
    }
}
@media only screen and (max-width: 767px){
.gnb_wrap {
display:none;
}
</style>
     
      
<div id="mobile-header" style="float:right">

	      <a id="responsive-menu-button" href="#sidr-main">Menu</a>
</div>

<div id="navigation">
    <nav class="nav">
        <ul>
		<li>
		   <?php
            $sql = " select * from {$g5['menu_table']} where me_use = '1' and length(me_code) = '2' order by me_order, me_id ";
            $result = sql_query($sql, false);
            $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

            for ($i=0; $row=sql_fetch_array($result); $i++) {
            ?>
			                <li>
                    <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>"><?php echo $row['me_name'] ?></a>
                    <?php
                    $sql2 = " select * from {$g5['menu_table']} where me_use = '1' and length(me_code) = '4' and substring(me_code, 1, 2) = '{$row['me_code']}' order by me_order, me_id ";
                    $result2 = sql_query($sql2);

                    for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                        if($k == 0)
                            echo '<ul class="submenu">'.PHP_EOL;
                ?>
                        <li><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><?php echo $row2['me_name'] ?></a></li>
                    <?php
                    }

                    if($k > 0)
                        echo '</ul>'.PHP_EOL;
                    ?>
                </li>
  <?php
                }

                if ($i == 0) {  ?>
                    <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                <?php } ?>
        </ul>
    </nav>
</div>

<script>
    $('#responsive-menu-button').sidr({
      name: 'sidr-main',
      source: '#navigation'
    });
</script>

        <div class="gnb_wrap">
            <ul class="gnb">
            <?php
            $sql = " select * from {$g5['menu_table']} where me_use = '1' and length(me_code) = '2' order by me_order, me_id ";
            $result = sql_query($sql, false);
            $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

            for ($i=0; $row=sql_fetch_array($result); $i++) {
            ?>
                <li>
                    <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>"><?php echo $row['me_name'] ?></a>
                    <?php
                    $sql2 = " select * from {$g5['menu_table']} where me_use = '1' and length(me_code) = '4' and substring(me_code, 1, 2) = '{$row['me_code']}' order by me_order, me_id ";
                    $result2 = sql_query($sql2);

                    for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                        if($k == 0)
                            echo '<ul class="submenu">'.PHP_EOL;
                ?>
                        <li><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><?php echo $row2['me_name'] ?></a></li>
                    <?php
                    }

                    if($k > 0)
                        echo '</ul>'.PHP_EOL;
                    ?>
                </li>
                <?php
                }

                if ($i == 0) {  ?>
                    <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="<?php echo (defined('_INDEX_')?'mainbg':'subbg') ?>">
        <ul class="bxslider">

			<li><img src="<?php echo G5_THEME_IMG_URL ?>/slide1.jpg" /></li>
			<li><img src="<?php echo G5_THEME_IMG_URL ?>/slide2.jpg" /></li>
			<li><img src="<?php echo G5_THEME_IMG_URL ?>/slide3.jpg" /></li>
        </ul>
    </div>


    <script type="text/javascript">
    $(document).ready(function(){
        $('.bxslider').bxSlider({auto: true});
    });
    </script>
    <div id="container">
<?php if ($gr_id || $co_id ) { ?>
        <div class="snb">
<?php
if($bo_table){
$menu_url = G5_BBS_URL."/board.php?bo_table=".$bo_table;
}else if($co_id){
$menu_url = G5_BBS_URL."/content.php?co_id=".$co_id;
}else{
$menu_url = G5_URL.$_SERVER[REQUEST_URI];
}
$snb_row  = sql_fetch(" select * from {$g5['menu_table']} where me_use = '1' and me_link = '$menu_url' ");
$me_code = substr($snb_row[me_code],0,2);
$snb_row1 = sql_fetch(" select * from {$g5['menu_table']} where me_use = '1' and me_code = '$me_code' ");

if ($me_code) {
?>
            <div class="titile"> <h2><?php echo $snb_row1['me_name'] ?></h2> </div>
            <ul class="snbgnb">
<?php
$sql2 = " select * from {$g5['menu_table']} where me_use = '1' and substring(me_code, 1, 2) = '$me_code' order by me_order, me_id ";
$result2 = sql_query($sql2);
for ($k=0; $row2=sql_fetch_array($result2); $k++) {
if ($k == 0) { $hidden = "hidden"; } else { $hidden = ""; }
?>
                <li class="<?php echo $hidden; if($row2[me_link] == $menu_url){ echo "active"; } ?>"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>"><?php echo $row2['me_name'] ?></a></li>
<?php } if ($k == 0) {  ?>
                <li id="empty">해당 페이지는 셋팅에 되어있지 않습니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } else { ?>관리자에게 문의 바랍니다.<?php } ?></div>
<?php } ?>
            </ul>
<?php } ?>
            <!-- sunb 애드센스 시작 { -->

            <!-- } sunb 애드센스 끝 -->
        </div>
        <div id="content">
<?php
if ($me_code) {
?>
            <div class="titile_box">
                <div class="titile">
                    <h3><?php echo $snb_row['me_name'] ?></h3>
                </div>
                <div class="location">
                    HOME <span> &gt; <?php echo $snb_row1['me_name'] ?> &gt; <?php echo $snb_row['me_name'] ?> </span>
                </div>
            </div>
<?php }
} ?>
        