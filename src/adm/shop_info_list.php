<?php
$sub_menu = '1300100';
include_once('./_common.php');

//auth_check($auth[$sub_menu], "r");

$g5['title'] = '샵 소개';
include_once (G5_ADMIN_PATH.'/admin.partnercenter_limit.head.php');

$comp_img="/img/nail25_logo_big.png";

$sql = " SELECT * FROM Nail25_nailshop_list WHERE shop_uidx='$member[mb_no]' ";
$file = sql_fetch($sql);
$shop_no=$file['shop_id'];
$shop_main_img=$file['shop_img_main'];
$shop_note=$file['shop_detail'];

if($shop_no>0){
	$w='u';
	$btn_msg="수정";
}else{
	$w='';
	$btn_msg="등록";
}

if($shop_main_img) $comp_img='/data/item/'.$shop_main_img;
//echo $comp_img;
?>
<style>
	.reg_btn{
		width:100%;height:50px;line-height: 50px;font-size:14px;
	}
	.reg_btn2{
		width:60%;height:50px;line-height: 50px;font-size:14px;
	}
</style>
<script>
	function change_info(idx){
		if(idx==1){
			location.href='shop_info_image.php';
		}else if(idx==2) location.href='shop_info_form.php?no=<?=$shop_no?>';
		else if(idx==3) location.href='shop_nailart_list.php';
		else if(idx==4) location.href='shop_recepi_manage.php';
	}
</script>
<form name="fitemform" action="./shop_info_image_update.php" method="post" enctype="MULTIPART/FORM-DATA" autocomplete="off" onsubmit="return fitemformcheck(this)">
	<section id="anc_sitfrm_img">
		<h2 class="h2_frm">샵 소개 이미지</h2>

		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>이미지 업로드</caption>
			<colgroup>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>
				<tr style="text-align:center;">
					<td colspan="2">
						<div style="width:90%">
							<div style="width:90%;float:left;">
								<div style="width:100%;text-align: center;height:200px;border:1px solid black;background-image:url('<?=$comp_img?>');background-size: 100% 100%;"></div>
								<div style="width:100%;float:left;padding:10px;text-align:center;">
									<button class="btn_frmline reg_btn2" style="margin-bottom:10px;" onClick="change_info(1);return false;">샾 소개 이미지 <?=$btn_msg?></button>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
			</table>
		</div>
	</section>
	<section id="anc_sitfrm_ini">
		<h2 class="h2_frm">매장 정보</h2>
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>이미지 업로드</caption>
			<colgroup>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>
				<tr style="text-align:center;">
					<td colspan="2">
						<div style="width:90%">
							<div style="width:90%;float:left;">
								<div style="width:100%;text-align:left;height:400px;">
									<ul style="margin-left:100px;">
										<li>
											<?=$file['shop_detail']?>
										</li>
										<li><div style="width:300px;height:150px;border:1px solid gray;"></div></li>
										<li style="margin-bottom:20px;"><?=$file['shop_addr1'];?></li>
										<li><span style="font-size:15px;margin-bottom:20px;">전화번호 : </span><?=$file['shop_contract']?></li>
										<li><span style="font-size:15px;">영업시간</span></li>
										<li>평일 : <?=$file['shop_open_time1']?>~<?=$file['shop_close_time1']?></li>
										<li">주말/공휴일 : <?=$file['shop_open_time2']?>~<?=$file['shop_close_time2']?></li>
										<li style="margin-bottom:20px;">휴무일 : <?=$file['shop_open_time2']?>~<?=$file['shop_close_time2']?></li>
									</ul>
								</div>
								<div style="width:100%;float:left;padding:10px;text-align:center;">
									<button class="btn_frmline reg_btn2" style="margin-bottom:10px;" onClick="change_info(2);return false;">매장 정보 <?=$btn_msg?></button>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
			</table>
		</div>
	</section>
	<section id="anc_sitfrm_ini">
		<h2 class="h2_frm">네일 아트 정보</h2>
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>이미지 업로드</caption>
			<colgroup>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>
				<tr style="text-align:center;">
					<td colspan="2">
						<div style="width:90%">
							<div style="width:90%;float:left;">
								<div style="width:100%;text-align: center;height:100px;border:1px solid black;;">등록된 네일  아트가 없습니다.</div>
								<div style="width:100%;float:left;padding:10px;text-align:center;">
									<button class="btn_frmline reg_btn2" style="margin-bottom:10px;">네일 아트 <?=$btn_msg?></button>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
			</table>
		</div>
	</section>
	<div class="local_desc02 local_desc" style="text-align:center;">
		<p>부가정보</p>
	</div>
	<?php echo help("네일 아트 레시피를 등록 후 공유하시면 다른 샵에서 해당 레시피로 결제 시술시\n시술 금액의 1%를 소정의 정보 이용료로 지급해 드립니다."); ?>
	<section id="anc_sitfrm_ini">
		<h2 class="h2_frm">네일 아트 레시피 정보</h2>
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>이미지 업로드</caption>
			<colgroup>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>
				<tr style="text-align:center;">
					<td colspan="2">
						<div style="width:90%">
							<div style="width:90%;float:left;">
								<div style="width:100%;text-align: center;height:200px;border:1px solid black;;"></div>
								<div style="width:100%;float:left;padding:10px;text-align:center;">
									<button class="btn_frmline reg_btn2" style="margin-bottom:10px;" onClick="change_info(4);return false;">네일 레시피 <?=$btn_msg?></button>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
			</table>
		</div>
	</section>
</form>
<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>