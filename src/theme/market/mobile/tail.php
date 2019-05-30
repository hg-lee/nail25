<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
    </div>
    <?//php echo poll('theme/basic'); // 설문조사 ?>
	<?//php echo visit('theme/basic'); // 방문자수 ?>
</div>

<div id="text_size">
<!-- font_resize('엘리먼트id', '제거할 class', '추가할 class'); -->
    <button id="size_down" onclick="font_resize('container', 'ts_up ts_up2', '', this);" class="select"><img src="<?php echo G5_URL; ?>/img/ts01.png" width="20" alt="기본"></button>
    <button id="size_def" onclick="font_resize('container', 'ts_up ts_up2', 'ts_up', this);"><img src="<?php echo G5_URL; ?>/img/ts02.png" width="20" alt="크게"></button>
    <button id="size_up" onclick="font_resize('container', 'ts_up ts_up2', 'ts_up2', this);"><img src="<?php echo G5_URL; ?>/img/ts03.png" width="20" alt="더크게"></button>
</div>

<div id="ft">
    <div id="ft_copy">
        <div id="ft_company">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보처리방침</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
        </div>
        Copyright &copy; <b>nail25.com</b> All rights reserved.<br>
    </div>       
    <button type="button" id="top_btn"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></button>
    <?php
    if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
    <a href="<?php echo get_device_change_url(); ?>" id="device_change">PC 버전으로 보기</a>
    <?php
    }

    if ($config['cf_analytics']) {
        echo $config['cf_analytics'];
    }
    ?>
</div>



<script>
jQuery(function($) {

    $( document ).ready( function() {

        // 폰트 리사이즈 쿠키있으면 실행
        font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
        
        //상단고정
        if( $(".top").length ){
            var jbOffset = $(".top").offset();
            $( window ).scroll( function() {
                if ( $( document ).scrollTop() > jbOffset.top ) {
                    $( '.top' ).addClass( 'fixed' );
                }
                else {
                    $( '.top' ).removeClass( 'fixed' );
                }
            });
        }

        //상단으로
        $("#top_btn").on("click", function() {
            $("html, body").animate({scrollTop:0}, '500');
            return false;
        });

    });
});
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>