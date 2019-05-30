<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

// 썸네일 LIB 
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
?>

    <div class="mainPhoto right" style="width:100%">
        <h2><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><strong><?php echo $bo_subject; ?></strong>　　<img src="<?php echo G5_THEME_IMG_URL ?>/interface.png"></a></h2>
        <ul style="width:100%">
            <?php
            for ($i=0; $i<count($list); $i++) {
            // 썸네일 생성
            $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], 332, 214);
            if($thumb['src']) { 
                $img_content = '<img class="thumb" src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="100%">'; 
            } else { 
                $img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>'; 
            } 
            ?>
            <li class="col-md-4 col-xs-6"  style="text-align:center">
                <?php
                //echo $list[$i]['icon_reply']." ";
                echo "<a href=\"".$list[$i]['href']."\">";
                echo $img_content;;
                echo "</a>";

                //echo $list[$i]['icon_reply']." ";
                echo "<a href=\"".$list[$i]['href']."\" class=\"title\">";
                if ($list[$i]['is_notice'])
                    echo "<strong>".$list[$i]['subject']."</strong>";
                else
                    echo $list[$i]['subject'];

                if ($list[$i]['comment_cnt'])
                    echo $list[$i]['comment_cnt'];

                echo "</a>";
                 ?>
            </li>
            <?php }  ?>
        </ul>
    </div>
<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->