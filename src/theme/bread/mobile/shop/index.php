<?php
include_once('./_common.php');

define("_INDEX_", TRUE);

include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
?>

<script src="<?php echo G5_JS_URL; ?>/swipe.js"></script>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>

<?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>

<div id="index_wr">
    <?php echo display_banner('왼쪽', 'boxbanner.skin.php'); ?>
    
    <?php include_once(G5_MSHOP_SKIN_PATH.'/main.event.skin.php'); // 이벤트 ?>


  
    <div class="shop_tab">
        <h2>제품</h2>
        <ul class="tabs tab_01">
            <li class="tab-link current" data-tab="tab-1">히트상품</li>
            <li class="tab-link" data-tab="tab-2">추천상품</li>
            <li class="tab-link" data-tab="tab-3">최신상품</li>
            <li class="tab-link" data-tab="tab-4">할인상품</li>
        </ul>

        <?php if($default['de_mobile_type1_list_use']) { ?>
        <div id="tab-1" class="tab-content content01 current">
            <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=1">히트상품</a></h2>
            <?php
            $list = new item_list();
            $list->set_mobile(true);
            $list->set_type(1);
            $list->set_view('it_id', false);
            $list->set_view('it_name', true);
            $list->set_view('it_cust_price', true);
            $list->set_view('it_price', true);
            $list->set_view('it_icon', true);
            $list->set_view('sns', true);
            echo $list->run();
            ?>
        </div>
        <?php } ?>



        <?php if($default['de_mobile_type2_list_use']) { ?>
        <div id="tab-2" class="tab-content content01">
            <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=2">추천상품</a></h2>
            <?php
            $list = new item_list();
            $list->set_mobile(true);
            $list->set_type(2);
            $list->set_view('it_id', false);
            $list->set_view('it_name', true);
            $list->set_view('it_cust_price', true);
            $list->set_view('it_price', true);
            $list->set_view('it_icon', true);
            $list->set_view('sns', true);
            echo $list->run();
            ?>
        </div>
        <?php } ?>


        <?php if($default['de_mobile_type3_list_use']) { ?>
        <div id="tab-3" class="tab-content content01">
            <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=3">최신상품</a></h2>
            <?php
            $list = new item_list();
            $list->set_mobile(true);
            $list->set_type(3);
            $list->set_view('it_id', false);
            $list->set_view('it_name', true);
            $list->set_view('it_cust_price', true);
            $list->set_view('it_price', true);
            $list->set_view('it_icon', true);
            $list->set_view('sns', true);
            echo $list->run();
            ?>
        </div>
        <?php } ?>


        <?php if($default['de_mobile_type5_list_use']) { ?>
        <div id="tab-4" class="tab-content content01">
            <h2><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">할인상품</a></h2>
            <?php
            $list = new item_list();
            $list->set_mobile(true);
            $list->set_type(5);
            $list->set_view('it_id', false);
            $list->set_view('it_name', true);
            $list->set_view('it_cust_price', true);
            $list->set_view('it_price', true);
            $list->set_view('it_icon', true);
            $list->set_view('sns', true);
            echo $list->run();
            ?>
        </div>
        <?php } ?>

    </div>


    <script>
    $(document).ready(function(){
        
        $('ul.tab_01 li').click(function(){
            var tab_id = $(this).attr('data-tab');

            $('ul.tab_01 li').removeClass('current');
            $('.content01').removeClass('current');

            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
        })

    })
    </script>

    <!-- 메인리뷰-->
    <?php
    // 상품리뷰
    $sql = " select a.is_id, a.is_subject, a.is_content, a.it_id, b.it_name
                from `{$g5['g5_shop_item_use_table']}` a join `{$g5['g5_shop_item_table']}` b on (a.it_id=b.it_id)
                where a.is_confirm = '1'
                order by a.is_id desc
                limit 0,10 ";
    $result = sql_query($sql);

    for($i=0; $row=sql_fetch_array($result); $i++) {
        if($i == 0) {
            echo '<div id="idx_review" class="sct_wrap">'.PHP_EOL;
            echo '<h2><a href="'.G5_SHOP_URL.'/itemuselist.php">사용후기</a></h2>'.PHP_EOL;
            echo '<ul class="review">'.PHP_EOL;
        }

        $review_href = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
    ?>
        <li class="rv_li rv_<?php echo $i;?>">
            <div class="li_wr">
                <a href="<?php echo $review_href; ?>" class="rv_img"><?php echo get_itemuselist_thumbnail($row['it_id'], $row['is_content'], 300, 350); ?></a>
                <div class="txt_wr">
                    <span class="rv_tit"><?php echo get_text(cut_str($row['is_subject'], 20)); ?></span>
                    <a href="<?php echo $review_href; ?>" class="rv_prd"><?php echo $row['it_name']; ?></a>
                    <p><?php echo get_text(cut_str(strip_tags($row['is_content']), 90), 1); ?></p>
                </div>
            </div>
        </li>
    <?php
    }

    if($i > 0) {
        echo '</ul>'.PHP_EOL;
        echo '</div>'.PHP_EOL;
    }
    ?>

</div>

<script>
$(document).ready(function(){
    $('.review').bxSlider({
    slideWidth: 220,
    minSlides: 2,
    maxSlides: 5,
    slideMargin: 20 ,
    pager:false

    });
});

     $(".con_c").removeClass("con_c");

    $("body").addClass("index");
</script>
<?php
include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
?>