<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div id="point" class="new_win">
    <h1 id="win_title"><?php echo $g5['title'] ?></h1>

	<div class="new_win_con">
		<p class="point_all">
        	<span class="point_all_tit">보유포인트</span>
        	<span class="point_all_cnt"><i class="fa fa-1x fa-product-hunt" aria-hidden="true"></i> <?php echo number_format($member['mb_point']); ?></span>
		</p>
	    <ul id="point_ul">
	        <?php
	        $sum_point1 = $sum_point2 = $sum_point3 = 0;

	        $sql = " select *
	                    {$sql_common}
	                    {$sql_order}
	                    limit {$from_record}, {$rows} ";
	        $result = sql_query($sql);
	        for ($i=0; $row=sql_fetch_array($result); $i++) {
	            $point1 = $point2 = 0;
	            if ($row['po_point'] > 0) {
	                $point1 = '+' .number_format($row['po_point']);
	                $sum_point1 += $row['po_point'];
                    $point_class = '';
	            } else {
	                $point2 = number_format($row['po_point']);
	                $sum_point2 += $row['po_point'];
                    $point_class = ' point_num_sbt';
	            }

	            $po_content = $row['po_content'];

	            $expr = '';
				// if($row['po_expired'] == 1)
	                $expr = ' txt_expired';
	        ?>
	        <li>
	            <div class="point_cnt">
					<span class="point_num<?php echo $point_class ?>"><?php if ($point1) echo $point1; else echo $point2; ?></span>
                	<span class="point_log"><?php echo $po_content; ?></span>
				</div>

                <div class="point_date">
                	<i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo conv_date_format('y-m-d H시', $row['po_datetime']); ?>
                	<span class="point_expdate<?php echo $expr; ?>">
                        <?php if ($row['po_expired'] == 1) { ?>
	                    만료: <?php echo substr(str_replace('-', '', $row['po_expire_date']), 2); ?>
	                    <?php } else echo $row['po_expire_date'] == '9999-12-31' ? '&nbsp;' : $row['po_expire_date']; ?>
                    </span>
                </div>
	        </li>
	        <?php
	        }

	        if ($i == 0)
	            echo '<li class="empty_list">자료가 없습니다.</li>';
	        else {
	            if ($sum_point1 > 0)
	                $sum_point1 = "+" . number_format($sum_point1);
	            $sum_point2 = number_format($sum_point2);
	        }
	        ?>
	    </ul>

		<div class="point_status">
            <p class="point_status_add"><span>지급포인트</span><b class="sum_val"><?php echo $sum_point1; ?></b></p>
            <p class="point_status_sbt"><span>사용포인트</span><b class="sum_val"><?php echo $sum_point2; ?></b></p>
        </div>

        <?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>

        <div class="win_btn">
        	<button type="button" onclick="javascript:window.close();" class="btn_close">닫기</button>
        </div>
    </div>
</div>
