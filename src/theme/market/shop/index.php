<?php
include_once('./_common.php');

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/index.php');
    return;
}

define("_INDEX_", TRUE);

include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
?>

<section id="idx_banner">
	<?php echo display_banner('메인', 'mainbanner.10.skin.php'); // 큰 배너 1 ?>
	<div id="idx_bn_link">
		<div id="bn_cnt_link">
			<ul>
				<li><a href=""><i class="fas fa-shopping-basket"></i><br>사용후기</a></li>
				<li><a href=""><i class="fas fa-gift"></i><br>이벤트</a></li>
				<li><a href=""><i class="fas fa-grin-alt"></i><br>커뮤니티</a></li>
				<li><a href=""><i class="fas fa-comment-dots"></i><br>문의</a></li>
			</ul>
		</div>
	</div>
</section>
	
<?php if($default['de_type4_list_use']) { ?>
<!-- 인기상품 시작 { -->
<section class="main">
	<div class="sale_prd">
	    <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">인기상품</a></h2>
	    <?php
	    $list = new item_list();
	    $list->set_type(4);
	    $list->set_view('it_id', false);
	    $list->set_view('it_name', true);
	    $list->set_view('it_basic', true);
	    $list->set_view('it_cust_price', false);
	    $list->set_view('it_price', true);
	    $list->set_view('it_icon', true);
	    $list->set_view('sns', false);
	    echo $list->run();
	    ?>
	</div>
</section>
<!-- } 인기상품 끝 -->
<?php } ?>

<?php if($default['de_type2_list_use']) { ?>
<section class="main2">
	<h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2" class="main_tit">추천상품</a></h2>
	<p>SIR 마켓에서 추천해드리는 상품입니다.</p>
	<!-- 추천상품 시작 { -->
	<div class="sct_wrap">
	    <?php
	    $list = new item_list();
	    $list->set_type(2);
	    $list->set_view('it_id', false);
	    $list->set_view('it_name', true);
	    $list->set_view('it_basic', true);
	    $list->set_view('it_cust_price', true);
	    $list->set_view('it_price', true);
	    $list->set_view('it_icon', true);
	    $list->set_view('sns', true);
	    echo $list->run();
	    ?>
	</div>
	<!-- } 추천상품 끝 -->
</section>
<?php } ?>

<section class="main3">
	<h2 class="main_tit">이벤트 기획전</h2>
	<?php include_once(G5_SHOP_SKIN_PATH.'/boxevent.skin.php'); // 이벤트 ?> 
</section>
	
<section class="main4">
	<?php if($default['de_type1_list_use']) { ?>
	<!-- 히트상품 시작 { -->
	<h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1" class="main_tit">히트상품</a></h2>
    <?php
    $list = new item_list();
    $list->set_type(1);
    $list->set_view('it_img', true);
    $list->set_view('it_id', false);
    $list->set_view('it_name', true);
    $list->set_view('it_basic', true);
    $list->set_view('it_cust_price', true);
    $list->set_view('it_price', true);
    $list->set_view('it_icon', false);
    $list->set_view('sns', false);
    echo $list->run();
    ?>
	<!-- } 히트상품 끝 -->
	<?php } ?>
</section>

<script>
$("#container_inner").removeClass("container").addClass("idx-container");
</script>

<?php
include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
?>