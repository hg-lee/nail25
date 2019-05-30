<?php
$sub_menu = '1300200';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

//auth_check($auth[$sub_menu], "r");

$g5['title'] = '매장 정보 관리';
include_once (G5_ADMIN_PATH.'/admin.partnercenter_limit.head.php');

check_input_vars();

$sql = " SELECT * FROM Nail25_nailshop_list WHERE shop_uidx='$member[mb_no]' AND shop_id='$no' ";
//echo $sql;
$shop = sql_fetch($sql);
$shop_detail=$shop['shop_detail'];
$shop_open_time1=$shop['shop_open_time1'];
$shop_open_time2=$shop['shop_open_time2'];
$shop_close_time1=$shop['shop_close_time1'];
$shop_close_time2=$shop['shop_close_time2'];
$shop_dayoff=$shop['shop_dayoff'];
$shop_note=$shop['shop_memo'];

$sot1=explode(':',$shop_open_time1);
$sot2=explode(':',$shop_open_time2);
$sct1=explode(':',$shop_close_time1);
$sct2=explode(':',$shop_close_time2);

//print_r($sot1);
if($no>0) $w="u";
//$comp_img="/img/nail25_logo_big.png";
//echo "[".$no."]";
//$no=$_GET['no'];
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
		}
	}
</script>
<form name="fitemform" action="./shop_info_update_2.php" method="post" enctype="MULTIPART/FORM-DATA" autocomplete="off" onsubmit="return fitemformcheck(this)">
<input type="hidden" name="from" value="si">
<input type="hidden" name="it_id" value="<?=$no?>">
<input type="hidden" name="w" value="<?=$w?>">
	<section id="anc_sitfrm_ini">
		<h2 class="h2_frm">매장 정보</h2>

		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>매장정보 입력</caption>
			<colgroup>
				<col class="grid_4">
				<col>
				<col class="grid_3">
			</colgroup>
			<tbody>
				<tr>
					<th scope="row">매장정보</th>
					<td colspan="2"> <?php echo editor_html('it_explan', get_text($shop['shop_detail'], 0)); ?></td>
				</tr>
			</tbody>
			</table>
		</div>
	</section>
	<section id="anc_sitfrm_ini">
		<h2 class="h2_frm">주소</h2>
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>주소 입력</caption>
			<colgroup>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>
				<tr>
					<td colspan="2">
						<center><div style="width:500px;height:300px;border:1px solid gray;"></div></center>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="it_basic">주소</label></th>
					<td colspan="2">
						<input type="text" name="it_address" value="<?php echo get_text($shop['shop_addr1']); ?>" id="it_basic" class="frm_input" size="95">
					</td>
				</tr>
			</tbody>
			</table>
		</div>
	</section>
	<section id="anc_sitfrm_ini">
		<h2 class="h2_frm">매장 연락처</h2>
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>연락처 입력</caption>
			<colgroup>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>
				<tr>
					<th scope="row"><label for="it_basic">연락처</label></th>
					<td colspan="2">
						<input type="text" name="it_contact" value="<?php echo get_text($shop['shop_contract']); ?>" id="it_basic" class="frm_input" size="95">
					</td>
				</tr>
			</tbody>
			</table>
		</div>
	</section>
	<section id="anc_sitfrm_ini">
		<h2 class="h2_frm">영업 시간</h2>
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>영업 시간 입력</caption>
			<colgroup>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>
				<tr>
					<th scope="row"><label for="it_shop_memo">영업시간</label></th>
					<td colspan="2">
						<table>
							<tr>
								<td>평일</td>
								<td>
									<select name="common_start_hour">
										<?for($i=0;$i<24;$i++){
											if($i<10) $start_t="0".$i;
											else $start_t=$i;
											if($start_t==$sot1[0]) $s_msg="selected";
											else $s_msg="";
											echo "<option value='".$start_t."' $s_msg>".$start_t."</option>";
										}?>
									</select>
									<select name="common_start_min">
										<option value="00" <?if($sot1[1]=="00") echo "selected";?>>00</option>
										<option value="30" <?if($sot1[1]=="30") echo "selected";?>>30</option>
									</select>
									~
									<select name="common_end_hour">
										<?for($i=0;$i<24;$i++){
											if($i<10) $start_t="0".$i;
											else $start_t=$i;
											if($start_t==$sct1[0]) $s_msg="selected";
											else $s_msg="";
											echo "<option value='".$start_t."' $s_msg>".$start_t."</option>";
										}?>
									</select>
									<select name="common_end_min">
										<option value="00" <?if($sct1[1]=="00") echo "selected";?>>00</option>
										<option value="30" <?if($sct1[1]=="30") echo "selected";?>>30</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>주말/공휴일</td>
								<td>
									<select name="week_start_hour">
										<?for($i=0;$i<24;$i++){
											if($i<10) $start_t="0".$i;
											else $start_t=$i;
											if($start_t==$sot2[0]) $s_msg="selected";
											else $s_msg="";
											echo "<option value='".$start_t."' $s_msg>".$start_t."</option>";
										}?>
									</select>
									<select name="week_start_min">
										<option value="00" <?if($sct2[1]=="00") echo "selected";?>>00</option>
										<option value="30" <?if($sct2[1]=="30") echo "selected";?>>30</option>
									</select>
									~
									<select name="week_end_hour">
										<?for($i=0;$i<24;$i++){
											if($i<10) $start_t="0".$i;
											else $start_t=$i;
											if($start_t==$sct2[0]) $s_msg="selected";
											else $s_msg="";
											echo "<option value='".$start_t."' $s_msg>".$start_t."</option>";
										}?>
									</select>
									<select name="week_end_min">
										<option value="00" <?if($sct2[1]=="00") echo "selected";?>>00</option>
										<option value="30" <?if($sct2[1]=="30") echo "selected";?>>30</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>휴무일</td>
								<td>매주
									<select name="shop_dayoff">
										<option value="0" <?if($shop_dayoff==0) echo "selected";?>>없음</option>
										<option value="1" <?if($shop_dayoff==1) echo "selected";?>>일요일</option>
										<option value="2" <?if($shop_dayoff==2) echo "selected";?>>월요일</option>
										<option value="3" <?if($shop_dayoff==3) echo "selected";?>>화요일</option>
										<option value="4" <?if($shop_dayoff==4) echo "selected";?>>수요일</option>
										<option value="5" <?if($shop_dayoff==5) echo "selected";?>>목요일</option>
										<option value="6" <?if($shop_dayoff==6) echo "selected";?>>금요일</option>
										<option value="7" <?if($shop_dayoff==7) echo "selected";?>>토요일</option>
									</select>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</tbody>
			</table>
		</div>
	</section>
	<section id="anc_sitfrm_ini">
		<h2 class="h2_frm">부가 정보</h2>
		<div class="tbl_frm01 tbl_wrap">
			<table>
			<caption>부가정보 입력</caption>
			<colgroup>
				<col class="grid_4">
				<col>
			</colgroup>
			<tbody>
				<tr>
					<th scope="row"><label for="it_shop_memo">부가정보</label></th>
					<td colspan="2">
						<textarea name="it_shop_info2" id="it_shop_info2"><?php echo $shop['shop_memo']; ?></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div style="width:100%;float:left;padding:10px;text-align:center;">
							<button class="btn_frmline reg_btn2" style="margin-bottom:10px;">매장 정보 등록</button>
						</div>
					</td>
				</tr>
			</tbody>
			</table>
		</div>
	</section>
</form>
<script>
function fitemformcheck(f)
{
	<?php echo get_editor_js('it_explan'); ?>
	return true;
}
</script>
<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>