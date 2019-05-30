<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
add_javascript('<script src="'.G5_JS_URL.'/jquery.bxslider.js"></script>', 10);
?>

<?php
for ($i=0; $row=sql_fetch_array($result); $i++)
{

    if ($i==0) echo '<aside id="sbn_side" class="sbn"><h2>쇼핑몰 배너</h2><div class="sb_bn owl-carousel">'.PHP_EOL;
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
        echo '<div>'.PHP_EOL;
        if ($row['bn_url'][0] == '#')
            $banner .= '<a href="'.$row['bn_url'].'">';
        else if ($row['bn_url'] && $row['bn_url'] != 'http://') {
            $banner .= '<a href="'.G5_SHOP_URL.'/bannerhit.php?bn_id='.$row['bn_id'].'"'.$bn_new_win.'>';
        }
        echo $banner.'<img src="'.G5_DATA_URL.'/banner/'.$row['bn_id'].'" alt="'.get_text($row['bn_alt']).'" width="'.$size[0].'" height="'.$size[1].'"'.$bn_border.'>';
        if($banner)
            echo '</a>'.PHP_EOL;
        echo '</div>'.PHP_EOL;
    }
}
if ($i>0) echo '</div></aside>'.PHP_EOL;
?>

<script>
$(function(){    
	$('.sb_bn').owlCarousel({
	    loop:true,
	    nav:true,
	    autoplay:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        430:{
	            items:1
	        },
	        600:{
	            items:1
	        }
	    }
	})
});
</script>
