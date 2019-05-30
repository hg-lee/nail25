<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 쪽지 목록 시작 { -->
<div id="memo_list" class="new_win">
    <h1 id="win_title"><?php echo $g5['title'] ?></h1>
	<div class="new_win_con">
	    <ul class="win_ul">
	        <li><a href="./memo.php?kind=recv" class="<?php if ($kind == 'recv') { ?>selected<?php } ?>">받은쪽지</a></li>
	        <li><a href="./memo.php?kind=send" class="<?php if ($kind == 'send') { ?>selected<?php } ?>">보낸쪽지</a></li>
	        <li><a href="./memo_form.php">쪽지쓰기</a></li>
	    </ul>
	    
	    <div class="win_total">
            <span>전체 <?php echo $kind_title ?>쪽지</span>
            <span class="win_total_r"><?php echo $total_count ?>통</span>
        </div>
        
        <div class="list_02">
	        <ul>	            
	            <?php for ($i=0; $i<count($list); $i++) { ?>
	            <li>
                    <?php echo $list[$i]['memo_status_class'] ?>
                    <span class="memo_view memo_view_ico"><i class="far fa-envelope"></i><b class="sound_only">읽은쪽지</b></span>
	                <span class="memo_name">
	                	<a href="<?php echo $list[$i]['view_href'] ?>"><?php echo $list[$i]['mb_nick'] ?></a>
	                	<span class="memo_datetime"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $list[$i]['send_datetime'] ?> - <?php echo $list[$i]['read_datetime'] ?> <a href="<?php echo $list[$i]['del_href'] ?>" onclick="del(this.href); return false;" class="memo_del"><i class="far fa-trash-alt"></i> <span class="sound_only">삭제</span></a></span>
	                </span>
	            </li>
	            <?php }  ?>
	            
	            <?php if ($i==0) { echo "<li class=\"empty_list\">자료가 없습니다.</li>"; } ?>
	        </ul>
		</div>
        
        <!-- 페이지 -->
        <?php echo $write_pages; ?>

        <p class="win_desc">
            쪽지 보관일수는 최장 <strong><?php echo $config['cf_memo_del'] ?></strong>일 입니다.
        </p>
        
        <div class="win_btn">
            <button type="button" onclick="window.close();" class="btn_close">창닫기</button>
        </div>
	</div>
</div>
<!-- } 쪽지 목록 끝 -->