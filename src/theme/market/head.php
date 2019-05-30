<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
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

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>
    
    <?php if ($is_admin) {  ?>
    <div id="hd_admin">
		<span class="hello_adm"><b>관리자</b>로 접속하셨습니다.</span>
    	<a href="<?php echo G5_ADMIN_URL ?>" class="admin_btn">관리자모드</a>
    </div>
    <?php }  ?>
    
    <div id="hd_wrapper">
    	
		<div id="hd_wr">
			<div id="logo">
	            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_DATA_URL; ?>/common/nail25_logo_b.png" alt="<?php echo $config['cf_title']; ?>"></a>
	        </div>
    
	        <ul id="hd_qnb">
	        	<li>
	        		<button class="sch_btn"><i class="fa fa-search"></i><span class="sound_only">검색</span></button>
	        	</li>
	        	<li>
	        		<button class="login_btn"><i class="fa fa-user-o" aria-hidden="true"></i><span class="sound_only">로그인</span></button>
	        		<div id="member_menu">
						<div class="member_div">
							<?php echo outlogin('theme/basic'); // 외부 로그인, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>  
						</div>
					</div>
					<script>
				    $(function(){
				        $(".login_btn").click(function(){
				            $("#member_menu").toggle();
				        });
				        $(".login_cls_btn").click(function(){
				            $("#member_menu").hide();
				        });
				    });
					</script>
	        	</li>
	        	<li><a href="<?php echo G5_BBS_URL ?>/current_connect.php" class="visit"><i class="fa fa-eye" aria-hidden="true"></i><span class="sound_only">접속자</span><strong class="visit-num"><?php echo connect('theme/basic'); // 현재 접속자수, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?></strong></a></li>
	        	<?php if(G5_COMMUNITY_USE) { ?>
	            <li class="tnb_left tnb_shop"><a href="<?php echo G5_SHOP_URL; ?>/"><i class="fa fa-shopping-bag" aria-hidden="true"></i><span class="sound_only">쇼핑몰</span></a></li>
	            <li class="tnb_left tnb_community"><a href="<?php echo G5_URL; ?>/"><i class="fa fa-home" aria-hidden="true"></i><span class="sound_only">커뮤니티</span></a></li>
	            <?php } ?>
	        </ul>  
		</div>
		
        <div class="hd_sch_wr">
            <fieldset id="hd_sch">
                <legend>사이트 내 전체검색</legend>
                <form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);">
                <input type="hidden" name="sfl" value="wr_subject||wr_content">
                <input type="hidden" name="sop" value="and">
                
                <label for="sch_stx" class="sound_only">검색어 필수</label>
	                <div class="sch_ipt">
	                	<input type="text" name="stx" id="sch_stx" maxlength="20" placeholder="검색어를 입력해주세요">
                		<button type="submit" id="sch_submit" value="검색"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
            		</div>
            	</form>
            	<button class="sch_close_btn"><span class="sound_only">닫기</span><i class="fa fa-times"></i></button>
			</fieldset>
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
            <?php echo popular('theme/basic'); // 인기검색어, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?>
            
        </div>
		<script>
	    $(function(){
	        $(".sch_btn").click(function(){
	            $(".hd_sch_wr").show();
	        });
	        $(".sch_close_btn").click(function(){
	            $(".hd_sch_wr").hide();
	        });
	    });
		</script>
        
        <!-- <div id="tnb">
	        <ul>
	            <?php if ($is_member) {  ?>
	
	            <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php"><i class="fa fa-cog" aria-hidden="true"></i> 정보수정</a></li>
	            <li><a href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> 로그아웃</a></li>
	            <?php if ($is_admin) {  ?>
	            <li class="tnb_admin"><a href="<?php echo G5_ADMIN_URL ?>"><b><i class="fa fa-user-circle" aria-hidden="true"></i> 관리자</b></a></li>
	            <?php }  ?>
	            <?php } else {  ?>
	            <li><a href="<?php echo G5_BBS_URL ?>/register.php"><i class="fa fa-user-plus" aria-hidden="true"></i> 회원가입</a></li>
	            <li><a href="<?php echo G5_BBS_URL ?>/login.php"><b><i class="fa fa-sign-in" aria-hidden="true"></i> 로그인</b></a></li>
	            <?php }  ?>
	        </ul>
	    </div> -->
    </div>
    
    <nav id="gnb">
        <h2>메인메뉴</h2>
        <div class="gnb_wrap">
            <ul id="gnb_1dul">
                <!-- <li class="gnb_1dli gnb_mnal"><button type="button" class="gnb_menu_btn"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">전체메뉴열기</span></button></li> -->
                <?php
                $sql = " select *
                            from {$g5['menu_table']}
                            where me_use = '1'
                              and length(me_code) = '2'
                            order by me_order, me_id ";
                $result = sql_query($sql, false);
                $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
                $menu_datas = array();

                for ($i=0; $row=sql_fetch_array($result); $i++) {
                    $menu_datas[$i] = $row;

                    $sql2 = " select *
                                from {$g5['menu_table']}
                                where me_use = '1'
                                  and length(me_code) = '4'
                                  and substring(me_code, 1, 2) = '{$row['me_code']}'
                                order by me_order, me_id ";
                    $result2 = sql_query($sql2);
                    for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                        $menu_datas[$i]['sub'][$k] = $row2;
                    }

                }

                $i = 0;
                foreach( $menu_datas as $row ){
                    if( empty($row) ) continue; 
                ?>
                <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                    <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
                    <?php
                    $k = 0;
                    foreach( (array) $row['sub'] as $row2 ){

                        if( empty($row2) ) continue; 

                        if($k == 0)
                            echo '<span class="bg">하위분류</span><ul class="gnb_2dul">'.PHP_EOL;
                    ?>
                        <li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
                    <?php
                    $k++;
                    }   //end foreach $row2

                    if($k > 0)
                        echo '</ul>'.PHP_EOL;
                    ?>
                </li>
                <?php
                $i++;
                }   //end foreach $row

                if ($i == 0) {  ?>
                    <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                <?php } ?>
            </ul>
	        <ul class="tnb">
	       		<li><a href="<?php echo G5_BBS_URL ?>/faq.php">FAQ</a></li>
	            <li><a href="<?php echo G5_BBS_URL ?>/qalist.php">1:1문의</a></li>
	            <li><a href="<?php echo G5_BBS_URL ?>/new.php">새글</a></li> 	
	        </ul>
        </div>
    </nav>
</div>
<!-- } 상단 끝 -->

<!-- 콘텐츠 시작 { -->
<div id="wrapper">

	<?php if(defined('_INDEX_')) { ?>
	<div id="idx_container">
		<div class="gall">
		    <!--  사진 최신글2 { -->
		    <?php
		    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
		    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
		    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
		    echo latest('theme/gallery', 'gallery', 5, 23);
		    ?>
		    <!-- } 사진 최신글2 끝 -->
		</div>
	</div>
	<?php } ?>
	
	<?php if (!defined("_INDEX_")) { ?>
		<h2 id="cnt_title"><span title="<?php echo get_text($g5['title']); ?>"><?php echo get_head_title($g5['title']); ?></span></h2>
	<?php } ?>
	
	<div id="container">