<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$thumb_width = 700;
$thumb_height = 480;
?>

<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->
<div class="lt_gal">
    <h2 class="con_tit"><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $bo_table; ?>"><?php echo $bo_subject; ?></a></h2>
    <ul>
		    <?php
		    for ($i=0; $i<count($list); $i++) {
		    $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);
		
		    if($thumb['src']) {
		        $img = $thumb['src'];
		    } else {
		        $img = G5_THEME_IMG_URL.'/no_img.png';
		        $thumb['alt'] = '이미지가 없습니다.';
		    }
		    $img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
		    ?>
        <li>
            <div class="lt_img"><a href="<?php echo $list[$i]['href']; ?>" class="lt_image"><?php echo $img_content; ?></a></div>
            <div class="lt_txt">
                <?php
                echo "<a href=\"".$list[$i]['href']."\" class=\"lt_tit\">";
                if ($list[$i]['is_notice'])
                    echo "<strong>".$list[$i]['subject']."</strong>";
                else
                    echo $list[$i]['subject'];
                echo "</a>";
                 ?>
            </div>
        </li>
    <?php }  ?>

    <?php if ($i == 0) { //게시물이 없을 때  ?>
        <li class="empty_list">게시물이 없습니다.</li>
    <?php }  ?>
    </ul>
    <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $bo_table; ?>" class="lt_more"><span class="sound_only"><?php echo $bo_subject; ?></span>MORE <i class="fa fa-angle-right"></i>
</a>
</div>
<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->