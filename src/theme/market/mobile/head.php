<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>

    <div id="hd_wrapper">

        <div id="logo">
           <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_DATA_URL; ?>/common/nail25_logo_w.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>

        <button type="button" id="gnb_open" class="hd_opener"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only"> 메뉴열기</span></button>

        <div id="gnb" class="hd_div">
            <button type="button" id="gnb_close" class="hd_closer"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">메뉴 닫기</span></button>

            <ul id="gnb_1dul">
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
                            echo '<button type="button" class="btn_gnb_op">하위분류</button><ul class="gnb_2dul">'.PHP_EOL;
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
            </ul>
            <ul id="hd_nb">
                <li><a href="<?php echo G5_BBS_URL ?>/qalist.php" id="snb_qa">1:1문의</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/faq.php" id="snb_faq">FAQ</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/current_connect.php">접속자</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/new.php" id="snb_new">새글</a></li>
            </ul>
        </div>
        
        <button id="sch_btn" class="hd_opener"><span class="sound_only">검색창 열기</span><i class="fa fa-search" aria-hidden="true"></i></button>
        <div id="hd_sch" class="hd_div">
            <h2 class="hd_sch_h2">사이트 내 전체검색</h2>
            <form name="fsearchbox" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);" method="get">
            	<input type="hidden" name="sfl" value="wr_subject||wr_content">
            	<input type="hidden" name="sop" value="and">
            	<input type="text" name="stx" id="sch_stx" placeholder="검색어를 입력하세요" required maxlength="20">
            	<button type="submit" value="검색" id="sch_submit"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
            </form>

            <script>
            function fsearchbox_submit(f)
            {
                if (f.stx.value.length < 2) {
                    alert("검색어는 두글자 이상 입력하십시오.");
                    f.stx.select();
                    f.stx.focus();
                    return false;
                }

                // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
                var cnt = 0;
                for (var i=0; i<f.stx.value.length; i++) {
                    if (f.stx.value.charAt(i) == ' ')
                        cnt++;
                }

                if (cnt > 1) {
                    alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
                    f.stx.select();
                    f.stx.focus();
                    return false;
                }

                return true;
            }
            </script>
            <button type="button" id="sch_btn_cls" class="hd_closer"><i class="fa fa-times" aria-hidden="true"></i><span class="sound_only">메뉴 닫기</span></button>
			<?php echo popular('theme/basic'); // 인기검색어 ?>
        </div>
        <a href="<?php echo G5_SHOP_URL; ?>/" class="shop_btn"><i class="fa fa-shopping-bag" aria-hidden="true"></i><span class="sound_only">쇼핑몰</span></a>
	    
        <button type="button" id="user_btn" class="hd_opener"><i class="fa fa-user-o" aria-hidden="true"></i><span class="sound_only">사용자메뉴</span></button>
                
        <div class="hd_div" id="user_menu">
            <?php echo outlogin('theme/basic'); // 외부 로그인 ?>
        </div>

        <script>
        $(function () {
            //폰트 크기 조정 위치 지정
            var font_resize_class = get_cookie("ck_font_resize_add_class");
            if( font_resize_class == 'ts_up' ){
                $("#text_size button").removeClass("select");
                $("#size_def").addClass("select");
            } else if (font_resize_class == 'ts_up2') {
                $("#text_size button").removeClass("select");
                $("#size_up").addClass("select");
            }

            $(".hd_opener").on("click", function() {
                var $this = $(this);
                var $hd_layer = $this.next(".hd_div");

                if($hd_layer.is(":visible")) {
                    $hd_layer.hide();
                    $this.find("span").text("열기");
                } else {
                    var $hd_layer2 = $(".hd_div:visible");
                    $hd_layer2.prev(".hd_opener").find("span").text("열기");
                    $hd_layer2.hide();

                    $hd_layer.show();
                    $this.find("span").text("닫기");
                }
            });

            $("#container").on("click", function() {
                $(".hd_div").hide();

            });

			$(".btn_gnb_op").click(function(){
				$(this).toggleClass("btn_gnb_cl").next(".gnb_2dul").slideToggle(300);
			});

            $(".hd_closer").on("click", function() {
                var idx = $(".hd_closer").index($(this));
                $(".hd_div:visible").hide();
                $(".hd_opener:eq("+idx+")").find("span").text("열기");
            });
        });
        </script>
        
    </div>
</header>

<div id="wrapper">

    <div id="container">
    <?php if (!defined("_INDEX_")) { ?><h2 id="container_title" class="top" title="<?php echo get_text($g5['title']); ?>"><?php echo get_head_title($g5['title']); ?></h2><?php } ?>
