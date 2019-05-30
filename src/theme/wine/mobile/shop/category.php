<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

function get_mshop_category($ca_id, $len)
{
    global $g5;

    $sql = " select ca_id, ca_name from {$g5['g5_shop_category_table']}
                where ca_use = '1' ";
    if($ca_id)
        $sql .= " and ca_id like '$ca_id%' ";
    $sql .= " and length(ca_id) = '$len' order by ca_order, ca_id ";

    return $sql;
}

add_javascript('<script src="'.G5_THEME_JS_URL.'/jquery.sidr.min.js"></script>', 0);

?>

<div id="sidr" class="menu">
    <?php echo outlogin('theme/shop_basic'); // 외부 로그인 ?>
    <div class="menu_wr">
        <ul class="cate_tab">
            <li><a href="#cate_01" class="selected"><i class="fa fa-home"></i><span class="sound_only">커뮤니티</span></a></li>
            <li><a href="#cate_02"><i class="fa fa-shopping-bag"></i><span class="sound_only">쇼핑몰</span></a></li>
            <li><a href="#cate_03"><i class="fa fa-eye"></i><span class="sound_only">오늘본상품</span></a></li>
        </ul>
        <div class="content">
            <ul id="cate_01" class="con">
            <?php
            $sql = " select *
                        from {$g5['menu_table']}
                        where me_mobile_use = '1'
                          and length(me_code) = '2'
                        order by me_order, me_id ";
            $result = sql_query($sql, false);

            for($i=0; $row=sql_fetch_array($result); $i++) {
            ?>
                <li class="gnb_1dli">
                    <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a> 
                    <?php
                    $sql2 = " select *
                                from {$g5['menu_table']}
                                where me_mobile_use = '1'
                                  and length(me_code) = '4'
                                  and substring(me_code, 1, 2) = '{$row['me_code']}'
                                order by me_order, me_id ";
                    $result2 = sql_query($sql2);

                    for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                        if($k == 0)
                            echo '<button class="sub_ct_toggle ct_op"><i class="fa fa-chevron-down"></i><span class="sound_only"> 하위분류 열기</span></button><ul class="sub_cate">'.PHP_EOL;
                    ?>
                        <li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><span></span><?php echo $row2['me_name'] ?></a></li>
                    <?php
                    }

                    if($k > 0)
                        echo '</ul>'.PHP_EOL;
                    ?>
                </li>
            <?php
            }

            if ($i == 0) {  ?>
                <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하세요.<?php } ?></li>
            <?php } ?>

            <li><a href="<?php echo G5_BBS_URL; ?>/faq.php">고객센터</a>
                <button class="sub_ct_toggle ct_op"><i class="fa fa-chevron-down"></i><span class="sound_only"> 하위분류 열기</span></button>
                <ul class="sub_cate">
                    <li><a href="<?php echo G5_BBS_URL; ?>/faq.php">자주묻는 질문</a></li>
                    <li><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a></li>
                </ul>
            </li>
            </ul>
     

            <ul id="cate_02" class="con">
                <li>
                    <?php
                    $mshop_ca_href = G5_SHOP_URL.'/list.php?ca_id=';
                    $mshop_ca_res1 = sql_query(get_mshop_category('', 2));
                    for($i=0; $mshop_ca_row1=sql_fetch_array($mshop_ca_res1); $i++) {
                        if($i == 0)
                            echo '<ul class="cate">'.PHP_EOL;
                    ?>
                        <li>
                            <a href="<?php echo $mshop_ca_href.$mshop_ca_row1['ca_id']; ?>"><?php echo get_text($mshop_ca_row1['ca_name']); ?></a>
                            <?php
                            $mshop_ca_res2 = sql_query(get_mshop_category($mshop_ca_row1['ca_id'], 4));
                            if(sql_num_rows($mshop_ca_res2))
                                echo '<button class="sub_ct_toggle ct_op"><span class="sound_only">'.get_text($mshop_ca_row1['ca_name']).'하위분류 열기</span><i class="fa fa-chevron-down"></i></button>'.PHP_EOL;

                            for($j=0; $mshop_ca_row2=sql_fetch_array($mshop_ca_res2); $j++) {
                                if($j == 0)
                                    echo '<ul class="sub_cate sub_cate1">'.PHP_EOL;
                            ?>
                                <li>
                                    <a href="<?php echo $mshop_ca_href.$mshop_ca_row2['ca_id']; ?>"><?php echo get_text($mshop_ca_row2['ca_name']); ?></a>
                                    <?php
                                    $mshop_ca_res3 = sql_query(get_mshop_category($mshop_ca_row2['ca_id'], 6));
                                    if(sql_num_rows($mshop_ca_res3))
                                        echo '<button type="button" class="sub_ct_toggle ct_op"><span class="sound_only">'.get_text($mshop_ca_row2['ca_name']).'하위분류 열기</span><i class="fa fa-chevron-down"></i></button>'.PHP_EOL;

                                    for($k=0; $mshop_ca_row3=sql_fetch_array($mshop_ca_res3); $k++) {
                                        if($k == 0)
                                            echo '<ul class="sub_cate sub_cate2">'.PHP_EOL;
                                    ?>
                                        <li>
                                            <a href="<?php echo $mshop_ca_href.$mshop_ca_row3['ca_id']; ?>"><?php echo get_text($mshop_ca_row3['ca_name']); ?></a>
                                            <?php
                                            $mshop_ca_res4 = sql_query(get_mshop_category($mshop_ca_row3['ca_id'], 8));
                                            if(sql_num_rows($mshop_ca_res4))
                                                echo '<button type="button" class="sub_ct_toggle ct_op"><span class="sound_only">'.get_text($mshop_ca_row3['ca_name']).'하위분류 열기</span><i class="fa fa-chevron-down"></i></button>'.PHP_EOL;

                                            for($m=0; $mshop_ca_row4=sql_fetch_array($mshop_ca_res4); $m++) {
                                                if($m == 0)
                                                    echo '<ul class="sub_cate sub_cate3">'.PHP_EOL;
                                            ?>
                                                <li>
                                                    <a href="<?php echo $mshop_ca_href.$mshop_ca_row4['ca_id']; ?>"><?php echo get_text($mshop_ca_row4['ca_name']); ?></a>
                                                    <?php
                                                    $mshop_ca_res5 = sql_query(get_mshop_category($mshop_ca_row4['ca_id'], 10));
                                                    if(sql_num_rows($mshop_ca_res5))
                                                        echo '<button type="button" class="sub_ct_toggle ct_op"><span class="sound_only">'.get_text($mshop_ca_row4['ca_name']).'하위분류 열기</span><i class="fa fa-chevron-down"></i></button>'.PHP_EOL;

                                                    for($n=0; $mshop_ca_row5=sql_fetch_array($mshop_ca_res5); $n++) {
                                                        if($n == 0)
                                                            echo '<ul class="sub_cate sub_cate4">'.PHP_EOL;
                                                    ?>
                                                        <li>
                                                            <a href="<?php echo $mshop_ca_href.$mshop_ca_row5['ca_id']; ?>"><?php echo get_text($mshop_ca_row5['ca_name']); ?></a>
                                                        </li>
                                                    <?php
                                                    }

                                                    if($n > 0)
                                                        echo '</ul>'.PHP_EOL;
                                                    ?>
                                                </li>
                                            <?php
                                            }

                                            if($m > 0)
                                                echo '</ul>'.PHP_EOL;
                                            ?>
                                        </li>
                                    <?php
                                    }

                                    if($k > 0)
                                        echo '</ul>'.PHP_EOL;
                                    ?>
                                </li>
                            <?php
                            }

                            if($j > 0)
                                echo '</ul>'.PHP_EOL;
                            ?>
                        </li>
                    <?php
                    }

                    if($i > 0)
                        echo '</ul>'.PHP_EOL;
                    else
                        echo '<p>등록된 분류가 없습니다.</p>'.PHP_EOL;
                    ?>
                </li>


                <li>
                    <ul id="hd_tnb" class="cate">
                        <li class="bd"><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">주문내역</a></li>
                        <li><a href="<?php echo G5_SHOP_URL; ?>/couponzone.php">쿠폰존</a></li>

                        <li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">개인결제</a></li>
                        <li><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">세일상품</a></li>
                    </ul> 
                </li>
            </ul>

            <div id="cate_03" class="con"><?php include(G5_MSHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?></div> 
        </div>

    </div>
</div>
<script>
$(function (){

    $("button.sub_ct_toggle").on("click", function() {
        $(this).next(".sub_cate").toggle();
    });

    $(".content .con").hide();
    $(".content .con:first").show();   
    $(".cate_tab li a").click(function(){
        $(".cate_tab li a").removeClass("selected");
        $(this).addClass("selected");
        $(".content .con").hide();
        //$($(this).attr("href")).show();
        $($(this).attr("href")).fadeIn();
    });
});
$(document).ready(function() {
  $('#btn_hdcate').sidr();

});
</script>
