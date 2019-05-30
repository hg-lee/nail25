<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
global $is_admin; 
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
add_javascript('<script src="'.G5_JS_URL.'/jquery.bxslider.js"></script>', 10);

$thumb_width = 300;
$thumb_height = 200;
?>

<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->
<div class="lt_bn">
    <ul>
    <?php
    for ($i=0; $i<count($list); $i++) {
    $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

    if($thumb['ori']) {
        $img = $thumb['ori'];
    } else {
        $img = G5_IMG_URL.'/no_img.png';
        $thumb['alt'] = '이미지가 없습니다.';
    }
    ?>
        <li class="list_<?php echo $i ?>" style="background-image:url('<?php echo $img; ?>')">
            <div class="bg"></div>
            <div class="bn_txt">
                <div class="txt_wr">
                        <?php
                        echo "<div class=\"bn_tit\">";
                            echo $list[$i]['subject'];
                        echo "</div>";
                        ?>

                        <div class="bn_detail pc_view"> <?php echo get_text(cut_str(strip_tags($list[$i]['wr_content']), 50), 1); ?></div>

                        <?php
                        echo "<a href=\"".$list[$i]['href']."\" class=\"bn_view\">VEIW</a>";
                        ?>
                </div>
            </div>
        </li>
    <?php }  ?>
    <?php if (count($list) == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
    </ul>
    <?php if ($is_admin) { ?><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>" class="bn_link"><i class="fa fa-cog"></i><span class="sound_only"><?php echo $bo_subject ?></span></a> <?php }  ?>
</div>


<script>
    $('.lt_bn ul').show().bxSlider({
        mode: 'vertical',
        pager:false,
        controls:true,
        auto:true
    });
</script>

<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->