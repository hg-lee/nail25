<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

//출력배너너비
$thumb_width = 1920;
//출력배너 높이
$thumb_height = 510;
?>
<style>
	.main_slider_baner{padding: 20px 0;	}
	.swiper-slide img{width: 100%;}
</style>

<div class="main_slider_baner">
	<link rel="stylesheet" href="<?php echo $latest_skin_url?>/swiper.min.css">
 <!-- Swiper -->
  <div class="swiper-container">
    <div class="swiper-wrapper">
	<?php
    for ($i=0; $i<count($list); $i++) {
    $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

    if($thumb['src']) {
        $img = $thumb['src'];
    } else {
        $img = G5_IMG_URL.'/no_img.png';
        $thumb['alt'] = '이미지가 없습니다.';
    }
    $img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
    ?>
      <div class="swiper-slide"><a href="http://<?=$list[$i]['wr_link1']?>" target="_blank"><?=$img_content?></a></div>
		
      <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li class="swiper-slide">배너 구역입니다.</li>
	<?}?>
		
    </div>
    <!-- 롤링점 -->
    <div class="swiper-pagination"></div>
	  <!-- 좌우버튼 -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>

  <!-- Swiper JS -->
  <script src="<?php echo $latest_skin_url?>/swiper.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.swiper-container', {
      pagination: {
        el: '.swiper-pagination',
        dynamicBullets: true,
      	},
		navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      	},
		loop : true,
		autoplay: {
		delay: 3000, //롤링 시 정지타임 
		stopOnLastSlide: false,
		disableOnInteraction: true, //롤링 여부false시 롤링끄기
		},
    });
  </script>
</div>

