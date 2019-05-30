<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>

<div id="container_bottom">
	<article class="aricle_left">	
		<div class="latest_wr">
		<!-- 최신글 시작 { -->
		    <?php
		    //  최신글
		    $sql = " select bo_table
		                from `{$g5['board_table']}` a left join `{$g5['group_table']}` b on (a.gr_id=b.gr_id)
		                where a.bo_device <> 'mobile' ";
		    if(!$is_admin)
		        $sql .= " and a.bo_use_cert = '' ";
		    $sql .= " and a.bo_table not in ('notice', 'gallery') "; //공지사항과 갤러리 게시판은 제외
		    $sql .= " order by b.gr_order, a.bo_order ";
		    $result = sql_query($sql);
		    for ($i=0; $row=sql_fetch_array($result); $i++) {
		        if ($i%2==1) $lt_style = "margin-left:2%";
		        else $lt_style = "";
		    ?>
		    <div style="float:left;<?php echo $lt_style ?>" class="lt_wr">
		        <?php
		        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
		        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
		        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
		        echo latest('theme/basic', $row['bo_table'], 6, 24);
		        ?>
		    </div>
		    <?php
		    }
		    ?>
		    <!-- } 최신글 끝 -->
		</div>
		
		<div class="latest_wr">
		    <!-- 사진 최신글1 { -->
		    <?php
		    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
		    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
		    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
		    echo latest('theme/gallery_line', 'gallery', 3, 23);
		    ?>
		    <!-- } 사진 최신글1 끝 -->
		</div>
		
		<div class="latest_wr">
		    <!--  사진 최신글2 { -->
		    <?php
		    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
		    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
		    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
		    echo latest('theme/gallery_block', 'gallery', 6, 23);
		    ?>
		    <!-- } 사진 최신글2 끝 -->
		</div>
	</article>
	
	<aside class="aside_right">
		<div class="latest_wr">
		    <!-- 사진 최신글3 { -->
		    <?php
		    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
		    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
		    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
		    echo latest('theme/basic', 'free', 5, 23);
		    ?>
		    <!-- } 사진 최신글3 끝 -->
		</div>
		<div class="latest_wr">
		    <!--  최신글 { -->
		    <?php
		    // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
		    // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
		    // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
		    echo latest('theme/basic', 'free', 5, 23);
		    ?>
		    <!-- } 최신글 끝 -->
		</div>
		<?php echo poll('theme/basic'); // 설문조사, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
        <?php echo visit('theme/basic'); // 접속자집계, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
	</aside>
</div>
<?php include_once(G5_THEME_PATH.'/tail.php'); ?>