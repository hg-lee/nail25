<?php
$sub_menu = '1300200';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

//auth_check($auth[$sub_menu], "r");

$g5['title'] = '매장 정보 관리';
include_once (G5_ADMIN_PATH.'/admin.partnercenter_limit.head.php');

check_input_vars();

$sql = " SELECT * FROM Nail25_nailshop_list WHERE shop_uidx='$member[mb_no]' ";
//echo $sql;
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++){
	//echo "[".$row['shop_name']."][".$row['shop_detail']."][".$row['shop_addr1']."][".$row['shop_img_main']."]<br>";
	$shop_info_lst[$i]['shop_name']=$row['shop_name'];
	$shop_info_lst[$i]['shop_detail']=$row['shop_detail'];
	$shop_info_lst[$i]['shop_addr1']=$row['shop_addr1'];
	$shop_info_lst[$i]['shop_img_main']=$row['shop_img_main'];
	$shop_info_lst[$i]['shop_contract']=$row['shop_contract'];
}
//print_r($shop_info_lst);
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
			location.href='shop_info_form.php';
		}
	}
</script>
<?
if(count($shop_info_lst)>0){
?>
	<section id="anc_sitfrm_img">
		<h2 class="h2_frm">매장 정보</h2>

		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>매장정보 입력</caption>
			<colgroup>
				<col class="grid_1">
			</colgroup>
			<tbody>
				<tr>
					<td>순번</td><td>매장명</td><td>대표이미지</td><td>주소</td><td>연락처</td>
				</tr>
				<?for($i=0;$i<count($shop_info_lst);$i++){?>
				<tr onClick="javascript:alert('aa');">
					<td><?=($i+1)?></td><td><?=$shop_info_lst[$i]['shop_name']?></td><td><img style="width:100px;height:50px;" src="/data/item/<?=$shop_info_lst[$i]['shop_img_main']?>"</td><td><?=$shop_info_lst[$i]['shop_addr1']?></td><td><?=$shop_info_lst[$i]['shop_contract']?></td>
				</tr>
				<?}?>
			</tbody>
			</table>
		</div>
	</section>
<?}else{?>
	<section id="anc_sitfrm_ini">
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<colgroup>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>
				<tr>
					<td colspan="3" style="height:300px">
						<center>등록 정보가 없습니다.</center>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<center><button class="btn_frmline reg_btn2" style="margin-bottom:10px;" onClick="change_info(1)">네일 레시피 등록</button></center>
					</td>
			</tbody>
			</table>
		</div>
	</section>
<?}?>
<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>