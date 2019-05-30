<?php
$sub_menu = '1300100';
include_once('./_common.php');

//auth_check($auth[$sub_menu], "r");

$g5['title'] = '샾 소개 이미지';
include_once (G5_ADMIN_PATH.'/admin.partnercenter_limit.head.php');

$comp_img="/img/nail25_logo_big.png";

$sql = " SELECT * FROM Nail25_nailshop_list WHERE shop_uidx='$member[mb_no]' ";
$it = sql_fetch($sql);
$shop_no=$it['shop_id'];
$shop_main_img=$it['shop_img_main'];
$shop_note=$it['shop_detail'];
$shop_name=$it['shop_name'];

if($shop_no>0){
	$w='u';
	$btn_msg="수정";
}else{
	$w='';
	$btn_msg="등록";
}

if($shop_main_img) $comp_img='/data/item/'.$shop_main_img;
?>
<style>
	.reg_btn{
		width:100%;height:50px;line-height: 50px;font-size:18px;
	}
</style>
<form name="fitemform" action="./shop_info_image_update.php" method="post" enctype="MULTIPART/FORM-DATA" autocomplete="off" onsubmit="return fitemformcheck(this)">

	<input type="hidden" name="it_id" value="<?php echo time(); ?>" id="it_id" required class="frm_input required" size="20" maxlength="20">
	<input type="hidden" name="ca_id" value="30">
	<input type="hidden" name="w" value="<?php echo $w; ?>">

	<section id="anc_sitfrm_ini">
		<h2 class="h2_frm">기본정보</h2>
		<div class="tbl_frm01 tbl_wrap">
			<table>
				<caption>기본정보 입력</caption>
				<colgroup>
					<col class="grid_4">
					<col>
					<col class="grid_3">
				</colgroup>
				<tbody>
					<tr>
						<th scope="row"><label for="it_name">업체명</label></th>
						<td colspan="2">
							<?php echo help("HTML 입력이 불가합니다.");?>
							<input type="text" name="it_name" value="<?php echo get_text(cut_str($it['shop_name'], 250, "")); ?>" id="it_name" required class="frm_input required" size="95">
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</section>
	<section id="anc_sitfrm_img">
		<h2 class="h2_frm">이미지</h2>

		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>이미지 업로드</caption>
			<colgroup>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>
				<tr>
					<td colspan="2">
						<div style="width:100%">
							<div style="width:80%;float:left;">
								<div style="width:100%;text-align: center;height:400px;border:1px solid black;background-image:url('<?=$comp_img?>');background-size: 100% 100%;"></div>
								<div style="width:100%;text-align:center;margin-top:10px;">
									<input type="file" id="main_image" name="main_image">
								</div>
							</div>
							<div style="width:20%;float:left;padding:10px;">
								<button class="btn_frmline reg_btn" style="margin-bottom:10px;">신규등록</button>
								<button class="btn_frmline reg_btn" style="margin-bottom:10px;">수정</button>
								<button class="btn_frmline reg_btn" style="">삭제</button>
							</div>
						</div>
					</td>
				</tr>
				<?php for($i=1; $i<=10; $i++) { ?>
				<tr>
					<th scope="row"><label for="it_img<?php echo $i; ?>">이미지 <?php echo $i; ?></label></th>
					<td>
						<input type="file" name="it_img<?php echo $i; ?>" id="it_img<?php echo $i; ?>">
						<?php
						$it_img = G5_DATA_PATH.'/item/'.$it['it_img'.$i];
						if(is_file($it_img) && $it['it_img'.$i]) {
						$size = @getimagesize($it_img);
						$thumb = get_it_thumbnail($it['it_img'.$i], 25, 25);
						?>
						<label for="it_img<?php echo $i; ?>_del"><span class="sound_only">이미지 <?php echo $i; ?> </span>파일삭제</label>
						<input type="checkbox" name="it_img<?php echo $i; ?>_del" id="it_img<?php echo $i; ?>_del" value="1">
						<span class="sit_wimg_limg<?php echo $i; ?>"><?php echo $thumb; ?></span>
						<div id="limg<?php echo $i; ?>" class="banner_or_img">
							<img src="<?php echo G5_DATA_URL; ?>/item/<?php echo $it['it_img'.$i]; ?>" alt="" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>">
							<button type="button" class="sit_wimg_close">닫기</button>
						</div>
						<script>
							$('<button type="button" id="it_limg<?php echo $i; ?>_view" class="btn_frmline sit_wimg_view">이미지<?php echo $i; ?> 확인</button>').appendTo('.sit_wimg_limg<?php echo $i; ?>');
						</script>
						<?php } ?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
			</table>
		</div>
	</section>
</form>

<script>
var f = document.fitemform;

<?php if ($w == 'u') { ?>
$(".banner_or_img").addClass("sit_wimg");
$(function() {
    $(".sit_wimg_view").bind("click", function() {
        var sit_wimg_id = $(this).attr("id").split("_");
        var $img_display = $("#"+sit_wimg_id[1]);

        $img_display.toggle();

        if($img_display.is(":visible")) {
            $(this).text($(this).text().replace("확인", "닫기"));
        } else {
            $(this).text($(this).text().replace("닫기", "확인"));
        }

        var $img = $("#"+sit_wimg_id[1]).children("img");
        var width = $img.width();
        var height = $img.height();
        if(width > 700) {
            var img_width = 700;
            var img_height = Math.round((img_width * height) / width);

            $img.width(img_width).height(img_height);
        }
    });
    $(".sit_wimg_close").bind("click", function() {
        var $img_display = $(this).parents(".banner_or_img");
        var id = $img_display.attr("id");
        $img_display.toggle();
        var $button = $("#it_"+id+"_view");
        $button.text($button.text().replace("닫기", "확인"));
    });
});
<?php } ?>
</script>
<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>