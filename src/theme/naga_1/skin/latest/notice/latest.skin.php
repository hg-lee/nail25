<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>

    <div class="mainBoard left">
        <h2><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=<?php echo $bo_table ?>"><strong><?php echo $bo_subject; ?></strong>　　<img src="<?php echo G5_THEME_IMG_URL ?>/interface.png" alt="<?php echo $bo_subject; ?> 더보기"></a></h2>
        <ul>
        <?php for ($i=0; $i<count($list); $i++) {  ?>
            <div class="col-md-12">
                <?php
                //echo $list[$i]['icon_reply']." ";
                echo "<a href=\"".$list[$i]['href']."\">";
                if ($list[$i]['is_notice'])
                    echo "<strong>".$list[$i]['subject']."</strong>";
                else
                    echo $list[$i]['subject'];

                if ($list[$i]['comment_cnt'])
                    echo $list[$i]['comment_cnt'];

                echo "</a>";

                // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
                // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

                if (isset($list[$i]['icon_new'])) echo " " . $list[$i]['icon_new'];
                if (isset($list[$i]['icon_hot'])) echo " " . $list[$i]['icon_hot'];
                if (isset($list[$i]['icon_file'])) echo " " . $list[$i]['icon_file'];
                if (isset($list[$i]['icon_link'])) echo " " . $list[$i]['icon_link'];
                if (isset($list[$i]['icon_secret'])) echo " " . $list[$i]['icon_secret'];
                 ?>
            </div>
            <?php }  ?>
            <?php if (count($list) == 0) { //게시물이 없을 때  ?>
                <li>게시물이 없습니다.</li>
            <?php }  ?>
        </ul>
    </div>