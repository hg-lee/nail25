<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
?>

<script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>

<?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>

    <?php if($default['de_mobile_type2_list_use']) { ?>
    <div id="main_rec">
        <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">추천상품</a></h2>
        <?php
        $list = new item_list();
        $list->set_mobile(true);
        $list->set_type(2);
        $list->set_view('it_id', false);
        $list->set_view('it_name', true);
        $list->set_view('it_cust_price', true);
        $list->set_view('it_price', true);
        $list->set_view('it_icon', false);
        $list->set_view('sns', false);
        echo $list->run();
        ?>
    </div>
    <?php } ?>


    <!-- 갤러리 최신글 -->
    <div id="idx_galley">
        <?php
        echo latest('theme/gallery', 'gallery', 3, 23);
        ?>
    </div>

    <?php include_once(G5_MSHOP_SKIN_PATH.'/main.event.skin.php'); // 이벤트 ?>

    <?php
    if (!$_COOKIE['ck_top_banner_close'])
        echo display_banner( '왼쪽');
    ?>

<script>
$("#hd").addClass("hd-idx").removeClass("hd");
</script>

<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>