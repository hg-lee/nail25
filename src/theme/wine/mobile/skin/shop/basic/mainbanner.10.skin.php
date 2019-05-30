<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
    add_javascript('<script src="'.G5_JS_URL.'/jquery.bxslider.js"></script>', 10);
?>
<div id="main_bn">
<?php
$max_width = $max_height = 0;
$bn_slide_btn = '';
$bn_sl = ' class="bn_sl"';

for ($i=0; $row=sql_fetch_array($result); $i++)
{
    if ($i==0) echo '<ul class="main_slider">'.PHP_EOL;
    //print_r2($row);
    // 테두리 있는지
    $bn_border  = ($row['bn_border']) ? ' class="sbn_border"' : '';;
    // 새창 띄우기인지
    $bn_new_win = ($row['bn_new_win']) ? ' target="_blank"' : '';

    $bimg = G5_DATA_PATH.'/banner/'.$row['bn_id'];
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

        echo '<li class="swiper-slide">'.PHP_EOL;
        if ($row['bn_url'][0] == '#')
            $banner .= '<a href="'.$row['bn_url'].'">';
        else if ($row['bn_url'] && $row['bn_url'] != 'http://') {
            $banner .= '<a href="'.G5_SHOP_URL.'/bannerhit.php?bn_id='.$row['bn_id'].'"'.$bn_new_win.'>';
        }
        echo $banner.'<img src="'.G5_DATA_URL.'/banner/'.$row['bn_id'].'" width="'.$size[0].'" alt="'.$row['bn_alt'].'"'.$bn_border.'>';
        if($banner)
            echo '</a>'.PHP_EOL;
        echo '</li>'.PHP_EOL;

        $bn_sl = '';
    }
}

if ($i > 0) {
    echo '</ul>'.PHP_EOL;

    echo '<div class="btn_wr"><a href="#" class="pager-prev"><i class="fa fa-angle-left"></i></a><div id="slide-counter"></div><a href="#" class="pager-next"><i class="fa fa-angle-right"></i></a> </div>'.PHP_EOL;

?>
</div>
<script>
$('#slide-counter').prepend('<strong class="slide-index current-index"></strong> / ');
 
var slider = $('.main_slider').bxSlider({
    auto: true,
    pager:false,
    controls: false,
    onSliderLoad: function (currentIndex){
        $('#slide-counter .current-index').text(currentIndex + 1);
    },
    onSlideBefore: function ($slideElement, oldIndex, newIndex){
        $('#slide-counter .current-index').text(newIndex + 1);
    }
});
 
$('#slide-counter').append('<span class="total-slides">'+slider.getSlideCount()+'</span>');

$('a.pager-prev').click(function () {
    var current = slider.getCurrentSlide();
    slider.goToPrevSlide(current) - 1;
});
$('a.pager-next').click(function () {
    var current = slider.getCurrentSlide();
    slider.goToNextSlide(current) + 1;
});
</script>

<?php
}
?>