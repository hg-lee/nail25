<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);

$cart_action_url = G5_SHOP_URL.'/cartupdate.php';
?>

<!-- 장바구니 간략 보기 시작 { -->
<div id="sbsk">
    <form name="skin_frmcartlist" id="skin_sod_bsk_list" method="post" action="<?php echo G5_SHOP_URL.'/cartupdate.php'; ?>">
    <div class="sbsk_wr">
        <h2>장바구니 <a href="<?php echo G5_SHOP_URL; ?>/cart.php" class="more">바로가기</a></h2>
        
        <ul>
        <?php
        $cart_datas = get_boxcart_datas(true);
        $i = 0;
        foreach($cart_datas as $row)
        {
            if( !$row['it_id'] ) continue;

            echo '<li>';
            $it_name = get_text($row['it_name']);
            // 이미지로 할 경우
            $it_img = get_it_image($row['it_id'], 50, 50, true);
            echo '<a href="'.G5_SHOP_URL.'/cart.php" class="prd_tit">'.$it_name.'</a>';
             echo '<div class="prd_img">'.$it_img.'</div>';
     
            // 상품별 옵션
            $sql2 = " select ct_option, ct_qty, (IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price
                        from {$g5['g5_shop_cart_table']}
                        where od_id = '".get_session('ss_cart_id')."'
                          and it_id = '{$row['it_id']}'
                        order by ct_id ";
            $res2 = sql_query($sql2);

            for($k=0; $row2 = sql_fetch_array($res2); $k++) {
                echo '<div class="cart_op qk_opt">'.get_text($row2['ct_option']).''.PHP_EOL;
                echo '<span class="sound_only">수량</span> (+'.number_format($row2['ct_qty']).')</div>'.PHP_EOL;
                $price += (int)$row2['price'];
                $total_price += (int)$row2['price'];
            }

            echo '<div class="qk_prc">'.display_price($price).'</div>'.PHP_EOL;
            echo '<button class="cart_del prd_del btn_b02" type="button" data-it_id="'.$row['it_id'].'"><span class="sound_only">삭제</span><i class="fa fa-trash"></i></button>'.PHP_EOL;

            echo '</li>';

            echo '<input type="hidden" name="act" value="buy" >';
            echo '<input type="hidden" name="ct_chk['.$i.']" value="1" >';
            echo '<input type="hidden" name="it_id['.$i.']" value="'.$row['it_id'].'">';
            echo '<input type="hidden" name="it_name['.$i.']"  value="'.$it_name.'">';

            $i++;
        }   //end foreach

        if ($i==0)
            echo '<li class="li_empty">장바구니 상품 없음</li>'.PHP_EOL;
        ?>
        </ul>
    </div>
    <?php if($i){ ?><div class="btn_wr"><button type="submit" class="btn_b01 btn_buy">바로구매</button></div><?php } ?>
    </form>
  
</div>
<!-- } 장바구니 간략 보기 끝 -->

<script>
$(function () {
    $(".cart_del").on("click", function() {
        var it_id = $(this).data("it_id");
        var $wrap = $(this).closest("li");

        $.ajax({
            url: g5_theme_shop_url+"/ajax.cartdelete.php",
            type: "POST",
            data: {
                "it_id" : it_id
            },
            dataType: "json",
            async: true,
            cache: false,
            success: function(data, textStatus) {
                if(data.error != "") {
                    alert(data.error);
                    return false;
                }

                $wrap.remove();
            }
        });
    });
});
</script>
<!-- } 장바구니 간략 보기 끝 -->
