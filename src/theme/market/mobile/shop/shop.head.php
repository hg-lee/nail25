<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
?>

<header id="hd">
    <?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>
    
	<section id="hd_sec">
	    <div id="hd_wr">
			<div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/nail25_logo_b.png" alt="<?php echo $config['cf_title']; ?>"></a></div>
	        <div id="hd_btn">
	            <button type="button" id="btn_hdcate"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">분류</span></button>
	            <button type="button" id="user_btn"><i class="fas fa-user"></i><span class="sound_only">사용자메뉴</span></button>
		        <button type="button" id="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
		        
		        <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
			        <aside id="hd_sch">
			            <div class="sch_inner">
			                <h2>상품 검색</h2>
			                <label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
			                <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required placeholder="검색어를 입력해주세요">
			                <button type="submit" value="검색" class="sch_submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			            </div>
			            <button class="sch_close"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">검색닫기</span></button>
			        </aside>
		        </form>
		        <script>
		        function search_submit(f) {
		            if (f.q.value.length < 2) {
		                alert("검색어는 두글자 이상 입력하십시오.");
		                f.q.select();
		                f.q.focus();
		                return false;
		            }
		            return true;
		        }
		        </script>
		       
		        <div class="hd_div" id="user_menu">
		            <?php echo outlogin('theme/shop_basic'); // 외부 로그인 ?>
		        </div>
	
	            <a href="<?php echo G5_SHOP_URL; ?>/cart.php" class="sp_cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="sound_only">장바구니</span><span class="cart-count"><?php echo get_boxcart_datas_count(); ?></span></a>
	
	        </div>
	    </div>
    </section>
    <?php include_once(G5_THEME_MSHOP_PATH.'/category.php'); // 분류 ?>

    <script>
    $( document ).ready( function() {
        var jbOffset = $( '#hd_sec' ).offset();
        $( window ).scroll( function() {
            if ( $( document ).scrollTop() > jbOffset.top ) {
                $( '#hd_sec' ).addClass( 'fixed' );
            }
            else {
                $( '#hd_sec' ).removeClass( 'fixed' );
            }
        });
    });
	
	$("#user_btn").on("click", function() {
        $("#user_menu").show();
    });
    
    $("#btn_hdcate").on("click", function() {
        $("#category").show();
    });

    $("#sch_btn").on("click", function() {
        $("#hd_sch").show();
    });
    
    $(".sch_close").on("click", function() {
        $("#hd_sch").hide();
    });
    
    $(".cate_bg").on("click", function() {
        $(".menu").hide();
    });
    
    $(".menu_close").on("click", function() {
        $(".menu").hide();
    });
    
    $(".user_close").on("click", function() {
        $("#user_menu").hide();
    });
    
   </script>
</header>

<div id="container">
    <?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><h1 id="container_title"><?php echo $g5['title'] ?></h1><?php } ?>
