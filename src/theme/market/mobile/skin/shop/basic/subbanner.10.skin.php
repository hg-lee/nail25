<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/swiper/swiper.min.css">', 0);
add_javascript('<script src="'.G5_JS_URL.'/swiper/swiper.min.js"></script>', 10);
?>

<?php
$max_width = $max_height = 0;
$bn_slide_btn = '';
$bn_sl = ' class="bn_sl"';

for ($i=0; $row=sql_fetch_array($result); $i++)
{
    if ($i==0) echo '<div id="sub_bn" class="swiper-container">'.PHP_EOL.'<div class="swiper-wrapper">'.PHP_EOL;
    //print_r2($row);
    // 테두리 있는지
    $bn_border  = ($row['bn_border']) ? ' class="sbn_border"' : '';;
    // 새창 띄우기인지
    $bn_new_win = ($row['bn_new_win']) ? ' target="_blank"' : '';

    $bimg = G5_DATA_PATH.'/item/'.$row['it_img1'];
    if (file_exists($bimg))
    {
        $banner = '';
        $size = getimagesize($bimg);

        if($size[2] < 1 || $size[2] > 16)
            continue;

        if($max_width < $size[0])
            $max_width = $size[0];

        if($max_height < $size[1])
            $max_height = $size[1];

        echo '<div class="swiper-slide">'.PHP_EOL;
        if ($row['bn_url'][0] == '#')
            $banner .= '<a href="'.$row['bn_url'].'">';
        else if ($row['bn_url'] && $row['bn_url'] != 'http://') {
            $banner .= '<a href="'.G5_SHOP_URL.'/bannerhit.php?bn_id='.$row['bn_id'].'"'.$bn_new_win.'>';
        }
        echo $banner.'<img src="'.G5_DATA_URL.'/item/'.$row['it_img1'].'" width="100%" alt="'.get_text($row['bn_alt']).'"'.$bn_border.'>';
        if($banner)
            echo '</a>'.PHP_EOL;
        echo '</div>'.PHP_EOL;

        $bn_sl = '';
    }else{
        echo "<h1>없음</h1>";
    }
}

if ($i > 0) {
    echo '</div>'.PHP_EOL;

    echo '<div class="swiper-pagination"></div>'.PHP_EOL;

    echo '</div>'.PHP_EOL;
?>

<script>
jQuery(function($){
    var swiper = new Swiper('#sub_bn', {
        slidesPerView: 3,
        spaceBetween:50,
        spaceBetween: 0,
        loop: true,
        //autoplay: {delay: 5000, disableOnInteraction:false},
    });
});
</script>

<?php
}
?>