<?php
$sub_menu = '1300100';
include_once('./_common.php');

if ($w == "u" || $w == "d")
	check_demo();

/*
if ($w == '' || $w == 'u')
	auth_check($auth[$sub_menu], "w");
else if ($w == 'd')
	auth_check($auth[$sub_menu], "d");
*/

@mkdir(G5_DATA_PATH."/item",G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH."/item", G5_DIR_PERMISSION);

check_input_vars();


print_r($_POST);
echo "<br>=======<br>";
print_r($_FILES);
echo "<br>=======<br>";
print_r($member);
echo "<br>[".$w."]";

//exit;
// 파일정보
if($w == "u") {
	$sql = " select shop_img_main, shop_img1, shop_img2, shop_img3, shop_img4, shop_img5, shop_img6, shop_img7, shop_img8, shop_img9, shop_img10
		from Nail25_nailshop_list
		where it_id = '$it_id' ";
	$file = sql_fetch($sql);
	$main_image=$file['shop_img_main'];
	$it_img1    = $file['shop_img1'];
	$it_img2    = $file['shop_img2'];
	$it_img3    = $file['shop_img3'];
	$it_img4    = $file['shop_img4'];
	$it_img5    = $file['shop_img5'];
	$it_img6    = $file['shop_img6'];
	$it_img7    = $file['shop_img7'];
	$it_img8    = $file['shop_img8'];
	$it_img9    = $file['shop_img9'];
	$it_img10   = $file['shop_img10'];
}
$it_img_dir = G5_DATA_PATH.'/item';
// 파일삭제
if ($it_img1_del) {
	$file_main_image = $it_img_dir.'/'.$main_image;
	@unlink($file_main_image);
	delete_item_thumbnail(dirname($file_main_image), basename($file_main_image));
	$main_image = '';
}
if ($it_img1_del) {
	$file_img1 = $it_img_dir.'/'.$it_img1;
	@unlink($file_img1);
	delete_item_thumbnail(dirname($file_img1), basename($file_img1));
	$it_img1 = '';
}
if ($it_img2_del) {
	$file_img2 = $it_img_dir.'/'.$it_img2;
	@unlink($file_img2);
	delete_item_thumbnail(dirname($file_img2), basename($file_img2));
	$it_img2 = '';
}
if ($it_img3_del) {
	$file_img3 = $it_img_dir.'/'.$it_img3;
	@unlink($file_img3);
	delete_item_thumbnail(dirname($file_img3), basename($file_img3));
	$it_img3 = '';
}
if ($it_img4_del) {
	$file_img4 = $it_img_dir.'/'.$it_img4;
	@unlink($file_img4);
	delete_item_thumbnail(dirname($file_img4), basename($file_img4));
	$it_img4 = '';
}
if ($it_img5_del) {
	$file_img5 = $it_img_dir.'/'.$it_img5;
	@unlink($file_img5);
	delete_item_thumbnail(dirname($file_img5), basename($file_img5));
	$it_img5 = '';
}
if ($it_img6_del) {
	$file_img6 = $it_img_dir.'/'.$it_img6;
	@unlink($file_img6);
	delete_item_thumbnail(dirname($file_img6), basename($file_img6));
	$it_img6 = '';
}
if ($it_img7_del) {
	$file_img7 = $it_img_dir.'/'.$it_img7;
	@unlink($file_img7);
	delete_item_thumbnail(dirname($file_img7), basename($file_img7));
	$it_img7 = '';
}
if ($it_img8_del) {
	$file_img8 = $it_img_dir.'/'.$it_img8;
	@unlink($file_img8);
	delete_item_thumbnail(dirname($file_img8), basename($file_img8));
	$it_img8 = '';
}
if ($it_img9_del) {
	$file_img9 = $it_img_dir.'/'.$it_img9;
	@unlink($file_img9);
	delete_item_thumbnail(dirname($file_img9), basename($file_img9));
	$it_img9 = '';
}
if ($it_img10_del) {
	$file_img10 = $it_img_dir.'/'.$it_img10;
	@unlink($file_img10);
	delete_item_thumbnail(dirname($file_img10), basename($file_img10));
	$it_img10 = '';
}
// 이미지업로드
if ($_FILES['main_image']['name']) {
	if($w == 'u' && $main_image) {
		$file_img1 = $it_img_dir.'/'.$main_image;
		@unlink($file_img1);
		delete_item_thumbnail(dirname($file_img1), basename($file_img1));
	}
	$main_image = it_img_upload($_FILES['main_image']['tmp_name'], $_FILES['main_image']['name'], $it_img_dir.'/'.$it_id);
}
if ($_FILES['it_img1']['name']) {
	if($w == 'u' && $it_img1) {
		$file_img1 = $it_img_dir.'/'.$it_img1;
		@unlink($file_img1);
		delete_item_thumbnail(dirname($file_img1), basename($file_img1));
	}
	$it_img1 = it_img_upload($_FILES['it_img1']['tmp_name'], $_FILES['it_img1']['name'], $it_img_dir.'/'.$it_id);
}
if ($_FILES['it_img2']['name']) {
	if($w == 'u' && $it_img2) {
		$file_img2 = $it_img_dir.'/'.$it_img2;
		@unlink($file_img2);
		delete_item_thumbnail(dirname($file_img2), basename($file_img2));
	}
	$it_img2 = it_img_upload($_FILES['it_img2']['tmp_name'], $_FILES['it_img2']['name'], $it_img_dir.'/'.$it_id);
}
if ($_FILES['it_img3']['name']) {
	if($w == 'u' && $it_img3) {
		$file_img3 = $it_img_dir.'/'.$it_img3;
		@unlink($file_img3);
		delete_item_thumbnail(dirname($file_img3), basename($file_img3));
	}
	$it_img3 = it_img_upload($_FILES['it_img3']['tmp_name'], $_FILES['it_img3']['name'], $it_img_dir.'/'.$it_id);
}
if ($_FILES['it_img4']['name']) {
	if($w == 'u' && $it_img4) {
		$file_img4 = $it_img_dir.'/'.$it_img4;
		@unlink($file_img4);
		delete_item_thumbnail(dirname($file_img4), basename($file_img4));
	}
	$it_img4 = it_img_upload($_FILES['it_img4']['tmp_name'], $_FILES['it_img4']['name'], $it_img_dir.'/'.$it_id);
}
if ($_FILES['it_img5']['name']) {
	if($w == 'u' && $it_img5) {
		$file_img5 = $it_img_dir.'/'.$it_img5;
		@unlink($file_img5);
		delete_item_thumbnail(dirname($file_img5), basename($file_img5));
	}
	$it_img5 = it_img_upload($_FILES['it_img5']['tmp_name'], $_FILES['it_img5']['name'], $it_img_dir.'/'.$it_id);
}
if ($_FILES['it_img6']['name']) {
	if($w == 'u' && $it_img6) {
		$file_img6 = $it_img_dir.'/'.$it_img6;
		@unlink($file_img6);
		delete_item_thumbnail(dirname($file_img6), basename($file_img6));
	}
	$it_img6 = it_img_upload($_FILES['it_img6']['tmp_name'], $_FILES['it_img6']['name'], $it_img_dir.'/'.$it_id);
}
if ($_FILES['it_img7']['name']) {
	if($w == 'u' && $it_img7) {
		$file_img7 = $it_img_dir.'/'.$it_img7;
		@unlink($file_img7);
		delete_item_thumbnail(dirname($file_img7), basename($file_img7));
	}
	$it_img7 = it_img_upload($_FILES['it_img7']['tmp_name'], $_FILES['it_img7']['name'], $it_img_dir.'/'.$it_id);
}
if ($_FILES['it_img8']['name']) {
	if($w == 'u' && $it_img8) {
		$file_img8 = $it_img_dir.'/'.$it_img8;
		@unlink($file_img8);
		delete_item_thumbnail(dirname($file_img8), basename($file_img8));
	}
	$it_img8 = it_img_upload($_FILES['it_img8']['tmp_name'], $_FILES['it_img8']['name'], $it_img_dir.'/'.$it_id);
}
if ($_FILES['it_img9']['name']) {
	if($w == 'u' && $it_img9) {
		$file_img9 = $it_img_dir.'/'.$it_img9;
		@unlink($file_img9);
		delete_item_thumbnail(dirname($file_img9), basename($file_img9));
	}
	$it_img9 = it_img_upload($_FILES['it_img9']['tmp_name'], $_FILES['it_img9']['name'], $it_img_dir.'/'.$it_id);
}
if ($_FILES['it_img10']['name']) {
	if($w == 'u' && $it_img10) {
		$file_img10 = $it_img_dir.'/'.$it_img10;
		@unlink($file_img10);
		delete_item_thumbnail(dirname($file_img10), basename($file_img10));
	}
	$it_img10 = it_img_upload($_FILES['it_img10']['tmp_name'], $_FILES['it_img10']['name'], $it_img_dir.'/'.$it_id);
}

if ($w == "" || $w == "u")
{
	//다음 입력을 위해서 옵션값을 쿠키로 한달동안 저장함
	//@setcookie("ck_ca_id",  $ca_id,  time() + 86400*31, $default[de_cookie_dir], $default[de_cookie_domain]);
	//@setcookie("ck_maker",  stripslashes($it_maker),  time() + 86400*31, $default[de_cookie_dir], $default[de_cookie_domain]);
	//@setcookie("ck_origin", stripslashes($it_origin), time() + 86400*31, $default[de_cookie_dir], $default[de_cookie_domain]);
	@set_cookie("ck_ca_id", $ca_id, time() + 86400*31);
	@set_cookie("ck_ca_id2", $ca_id2, time() + 86400*31);
	@set_cookie("ck_ca_id3", $ca_id3, time() + 86400*31);
	@set_cookie("ck_maker", stripslashes($it_maker), time() + 86400*31);
	@set_cookie("ck_origin", stripslashes($it_origin), time() + 86400*31);
}

$it_name = strip_tags(trim($_POST['it_name']));
if ($it_name == "")
	alert("업체명을 입력해 주십시오.");
/*
$sql_common = " ca_id               = '$ca_id',
	ca_id2              = '$ca_id2',
	ca_id3              ='$ca_id3',
	it_skin             = '$it_skin',
	it_mobile_skin      = '$it_mobile_skin',
	it_name             = '$it_name',
	it_maker            = '$it_maker',
	it_origin           = '$it_origin',
	it_brand            = '$it_brand',
	it_model            = '$it_model',
	it_option_subject   = '$it_option_subject',
	it_supply_subject   = '$it_supply_subject',
	it_basic            = '$it_basic',
	it_explan           = '$it_explan',
	it_explan2          = '".strip_tags(trim($_POST['it_explan']))."',
	it_mobile_explan    = '$it_mobile_explan',
	it_cust_price       = '$it_cust_price',
	it_price            = '$it_price',
	it_point            = '$it_point',
	it_point_type       = '$it_point_type',
	it_supply_point     = '$it_supply_point',
	it_notax            = '$it_notax',
	it_sell_email       = '$it_sell_email',
	it_use              = '$it_use',
	it_nocoupon         = '$it_nocoupon',
	it_soldout          = '$it_soldout',
	it_stock_qty        = '$it_stock_qty',
	it_stock_sms        = '$it_stock_sms',
	it_noti_qty         = '$it_noti_qty',
	it_sc_type          = '$it_sc_type',
	it_sc_method        = '$it_sc_method',
	it_sc_price         = '$it_sc_price',
	it_sc_minimum       = '$it_sc_minimum',
	it_sc_qty           = '$it_sc_qty',
	it_buy_min_qty      = '$it_buy_min_qty',
	it_buy_max_qty      = '$it_buy_max_qty',
	it_head_html        = '$it_head_html',
	it_tail_html        = '$it_tail_html',
	it_mobile_head_html = '$it_mobile_head_html',
	it_mobile_tail_html = '$it_mobile_tail_html',
	it_ip               = '{$_SERVER['REMOTE_ADDR']}',
	it_order            = '$it_order',
	it_tel_inq          = '$it_tel_inq',
	it_info_gubun       = '$it_info_gubun',
	it_info_value       = '$it_info_value',
	it_shop_memo        = '$it_shop_memo',
	ec_mall_pid         = '$ec_mall_pid',
	it_img1             = '$it_img1',
	it_img2             = '$it_img2',
	it_img3             = '$it_img3',
	it_img4             = '$it_img4',
	it_img5             = '$it_img5',
	it_img6             = '$it_img6',
	it_img7             = '$it_img7',
	it_img8             = '$it_img8',
	it_img9             = '$it_img9',
	it_img10            = '$it_img10',
	it_1_subj           = '$it_1_subj',
	it_2_subj           = '$it_2_subj',
	it_3_subj           = '$it_3_subj',
	it_4_subj           = '$it_4_subj',
	it_5_subj           = '$it_5_subj',
	it_6_subj           = '$it_6_subj',
	it_7_subj           = '$it_7_subj',
	it_8_subj           = '$it_8_subj',
	it_9_subj           = '$it_9_subj',
	it_10_subj          = '$it_10_subj',
	it_1                = '$main_image',
	it_2                = '$member[mb_no]',
	it_3                = '$it_3',
	it_4                = '$it_4',
	it_5                = '$it_5',
	it_6                = '$it_6',
	it_7                = '$it_7',
	it_8                = '$it_8',
	it_9                = '$it_9',
	it_10               = '$it_10'
	";
	*/
$sql_common="shop_name 		= '$it_name',
	shop_uidx		= '$member[mb_no]',
	shop_img_main 	= '$main_image',
	shop_img1		= '$it_img1',
	shop_img2		= '$it_img2',
	shop_img3		= '$it_img3',
	shop_img4		= '$it_img4',
	shop_img5		= '$it_img5',
	shop_img6		= '$it_img6',
	shop_img7		= '$it_img7',
	shop_img8		= '$it_img8',
	shop_img9		= '$it_img9',
	shop_img10		= '$it_img10'
";

if ($w == "")
{
	$it_id = $_POST['it_id'];

	if (!trim($it_id)) {
		alert('상품 코드가 없으므로 상품을 추가하실 수 없습니다.');
	}

	$t_it_id = preg_replace("/[A-Za-z0-9\-_]/", "", $it_id);
	if($t_it_id)
		alert('상품 코드는 영문자, 숫자, -, _ 만 사용할 수 있습니다.');

	$sql_common .= " , shop_time = '".G5_TIME_YMDHIS."' ";
	$sql_common .= " , shop_update_time = '".G5_TIME_YMDHIS."' ";
	$sql = " insert Nail25_nailshop_list
		set shop_id = '$it_id',
		$sql_common	";
	sql_query($sql);
}else if ($w == "u"){
	$sql_common .= " , it_update_time = '".G5_TIME_YMDHIS."' ";
	$sql = " update Nail25_nailshop_list
		set $sql_common
		where shop_id = '$it_id' ";
	sql_query($sql);
}

echo "<br>==============<br>";
echo $sql;
$qstr = "$qstr&amp;sca=$sca&amp;page=$page";

if ($w == "u") {
	goto_url("./itemform.php?w=u&amp;it_id=$it_id&amp;$qstr");
} else if ($w == "d")  {
	$qstr = "ca_id=$ca_id&amp;sfl=$sfl&amp;sca=$sca&amp;page=$page&amp;stx=".urlencode($stx)."&amp;save_stx=".urlencode($save_stx);
	goto_url("./itemlist.php?$qstr");
}

echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">";
//exit;
?>
<script>
	if (confirm("계속 입력하시겠습니까?"))
		//location.href = "<?php echo "./shop_info_image.php?it_id=$it_id&amp;sort1=$sort1&amp;sort2=$sort2&amp;sel_ca_id=$sel_ca_id&amp;sel_field=$sel_field&amp;search=$search&amp;page=$page"?>";
		location.href = "<?php echo "./shop_info_image.php?".str_replace('&amp;', '&', $qstr); ?>";
	else
	location.href = "<?php echo "./shop_info_list.php?".str_replace('&amp;', '&', $qstr); ?>";
</script>