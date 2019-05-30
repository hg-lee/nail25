<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_LIB_PATH.'/theme.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
add_javascript('<script src="'.G5_THEME_JS_URL.'/jquery.shop.list.js"></script>', 10);
?>

<?php
// 상품진열 10 시작
for ($i=1; $row=sql_fetch_array($result); $i++) {
	$icon = '<span class="sit_icon">';
	
	if ($row['it_type1'])
	    $icon .= '<span class="shop_icon shop_icon_1">히트</span>';
	
	if ($row['it_type2'])
	    $icon .= '<span class="shop_icon shop_icon_2">추천</span>';
	
	if ($row['it_type3'])
	    $icon .= '<span class="shop_icon shop_icon_3">최신</span>';
	
	if ($row['it_type4'])
	    $icon .= '<span class="shop_icon shop_icon_4">인기</span>';
	
	if ($row['it_type5'])
	    $icon .= '<span class="shop_icon shop_icon_5">할인</span>';
	
	
	// 쿠폰상품
	$sql = " select count(*) as cnt
	            from {$g5['g5_shop_coupon_table']}
	            where cp_start <= '".G5_TIME_YMD."'
	              and cp_end >= '".G5_TIME_YMD."'
	              and (
	                    ( cp_method = '0' and cp_target = '{$row['it_id']}' )
	                    OR
	                    ( cp_method = '1' and ( cp_target IN ( '{$row['ca_id']}', '{$row['ca_id2']}', '{$row['ca_id3']}' ) ) )
	                  ) ";
	$row2 = sql_fetch($sql);
	if($row2['cnt'])
	    $icon .= '<span class="shop_icon shop_icon_coupon">쿠폰</span>';
	
	// 품절
	if (is_soldout($row['it_id']))
	    $icon .= '<span class="shop_icon_soldout">품절</span>';
	
	$icon .= '</span>';

    if ($this->list_mod >= 2) { // 1줄 이미지 : 2개 이상
        if ($i%$this->list_mod == 0) $sct_last = 'sct_last'; // 줄 마지막
        else if ($i%$this->list_mod == 1) $sct_last = 'sct_clear'; // 줄 첫번째
        else $sct_last = '';
    } else { // 1줄 이미지 : 1개
        $sct_last = 'sct_clear';
    }

    if ($i == 1) {
        if ($this->css) {
            echo "<ul class=\"{$this->css}\">\n";
        } else {
            echo "<ul class=\"slider10 sct sct_20\">\n";
        }
    }

    echo "<li class=\"sct_li sct_li_{$i} {$sct_last}\" style=\"width:{$this->img_width}px\">\n";
	
    echo "<div class=\"sct_20_wrap\">\n";
	echo "<div class=\"sct_img\">\n";

    if ($this->href) {
        echo "<a href=\"{$this->href}{$row['it_id']}\">\n";
    }

    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
    }

    if ($this->href) {
        echo "</a>\n";
    }


    if ($this->view_sns) {
        $sns_top = $this->img_height + 10;
        $sns_url  = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];
        $sns_title = get_text($row['it_name']).' | '.get_text($config['cf_title']);
        echo "<div class=\"sct_sns\">";
        echo get_sns_share_link('facebook', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/facebook.png');
        echo get_sns_share_link('twitter', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/twitter.png');
        echo get_sns_share_link('googleplus', $sns_url, $sns_title, G5_SHOP_SKIN_URL.'/img/gplus.png');
        echo "</div>\n";
    }
	
    echo "</div>\n";

    if ($this->view_it_id) {
        echo "<div class=\"sct_id\">&lt;".stripslashes($row['it_id'])."&gt;</div>\n";
    }


	echo "<div class=\"sct_cnt\">\n";
	echo "<span class=\"sct_rank\"><span class=\"sct_rank_{$i}\">{$i}위 상품</span></span>\n";

    if ($this->href) {
        echo "<div class=\"sct_txt\"><a href=\"{$this->href}{$row['it_id']}\">\n";
    }

    if ($this->view_it_name) {
        echo stripslashes($row['it_name'])."\n";
    }

    if ($this->href) {
        echo "</a></div>\n";
    }
	
	if ($this->view_it_basic && $row['it_basic']) {
        echo "<div class=\"sct_basic\">".stripslashes($row['it_basic'])."</div>\n";
    }
    
    if ($this->view_it_cust_price || $this->view_it_price) {

        echo "<div class=\"sct_cost\">\n";

        if ($this->view_it_cust_price && $row['it_cust_price']) {
            echo "<span class=\"sct_discount\">".display_price($row['it_cust_price'])."</span>\n";
        }

        if ($this->view_it_price) {
            echo display_price(get_price($row), $row['it_tel_inq'])."\n";
        }

        echo "</div>\n";

    }
	
    if ($this->view_it_icon) {
        echo "<div class=\"sct_icon\">".$icon."</div>\n";
    }
	
	echo "</div>\n";
	echo "</div>\n";
    
    echo "</li>\n";
}

if ($i > 1) echo "</ul>\n";

if($i == 1) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
// 상품진열 10 끝
?>

<script>
$(document).ready(function(){
    $('.slider10').bxSlider({
    //slideWidth:1200,
    minSlides:16,
    maxSlides:16,
    slideMargin:32,
    pager:false,
	auto:true
    });
});
</script>