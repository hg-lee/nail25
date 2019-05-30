<?php
//if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/index.php');
    return;
}

include_once(G5_MOBILE_PATH.'/head.php');

if(defined('_INDEX_')) { 
include G5_BBS_PATH.'/slide.inc.php';
}
?>
<link rel="stylesheet" href="<?php echo G5_CSS_URL; ?>/swiper.css">
<div class="swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<div style="width:100%;height:100%;background-image:url(http://folanailspalmharbor.com/uploads/folanakvn50tq/logo/2018/01/11/1_1515649687_50_h4.jpg);background-size:cover;cursor: pointer;" onClick='go_detail(1);'>
								</div>
							</div>
							<div class="swiper-slide">
								<div style="width:100%;height:100%;background-image:url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQevi6yF5b9oS002uqKubHl04XaUfQEg9oAGkwuT0kf1tWgSLK-);background-size:cover;cursor: pointer;" onClick='go_detail(2);'>
								</div>
							</div>
							<div class="swiper-slide">
								<div style="width:100%;height:100%;background-image:url(https://www.gannett-cdn.com/-mm-/a0a28bd666af6d80b33247a358069ae6b7ce0cc4/c=0-108-2121-1306/local/-/media/2018/07/25/USATODAY/USATODAY/636681140660997892-GettyImages-640018462.jpg?width=3200&height=1680&fit=crop);background-size:cover;cursor: pointer;" onClick='go_detail(3);'>
								</div>
							</div>
							<div class="swiper-slide"><div style="width:100%;height:100%;background-image:url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAjpZOlrLDQMViNZStG8b9XbA8Ekyqg2SEN1EKr-Us1MZPA8Oz);background-size:cover;cursor: pointer;" onClick='go_detail(4);'>
								</div></div>
							<div class="swiper-slide"><div style="width:100%;height:100%;background-image:url(https://scontent-frx5-1.cdninstagram.com/vp/60afae44fe5eb2039d8db7f202bdda4f/5CF94703/t51.2885-15/e35/50670231_1988924894741999_4748261691381395642_n.jpg?_nc_ht=scontent-frx5-1.cdninstagram.com&se=7&ig_cache_key=MTk2ODA5NjA2ODUyMTkzNzUxNg%3D%3D.2);background-size:cover;cursor: pointer;" onClick='go_detail(5);'>
								</div></div>
						</div>
						<div class="swiper-pagination"></div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>

<script type='text/javascript' src='<?php echo G5_JS_URL; ?>/swipe.js'></script>
<script>
	var swiper = new Swiper('.swiper-container', {
		slidesPerView: 1,
		spaceBetween: 30,
		effect: 'fade',
		loop: true,
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
		autoplay:true,
		},
	});
</script>

<?php
include_once(G5_MOBILE_PATH.'/tail.php');
?>