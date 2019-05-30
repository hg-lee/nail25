<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_MSHOP_PATH.'/index.php');
    return;
}

include_once(G5_THEME_MOBILE_PATH.'/head.php');

?>

<?php echo display_banner('메인', 'mainbanner.10.skin.php'); ?>
<?php if($default['de_mobile_type4_list_use']) { ?>
<div class="sct_wrap">
    <h2><a href="<?php echo G5_NAIL25_URL; ?>/listtype.php?type=3">최신네일</a></h2>
</div>
<?php } ?>
<div style="width:100%;height:200px;">
<?php echo display_subbanner('최신', 'subbanner.10.skin.php'); ?>
</div>

<div style="width:100%;margin-top:2px;">
                    <div style="width:33%;float:left;">
                        <select style="width:100%;" onchange="on_change(this.value);">
                            <option value="1">네일</option>
                            <option value="2">패티</option>
                            <option value="3">네일/패티</option>
                        </select>
                    </div>
                    <div style="width:33%;float:left;">
                        <select style="width:100%;">
                            <option value="4">디자인1</option>
                            <option value="5">디자인2</option>
                        </select>
                    </div>
                    <div style="width:33%;float:left;">
                        <select style="width:100%">
                            <option value="6">흰색</option>
                            <option value="7">검정</option>
                            <option value="8">파랑</option>
                            <option value="9">노랑</option>
                        </select>
                    </div>
                </div>

<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>