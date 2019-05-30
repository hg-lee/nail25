<?php
$sub_menu = '1300200';
include_once('./_common.php');

if ($w == "u" || $w == "d")
	check_demo();

/*
if ($w == '' || $w == 'u')
	auth_check($auth[$sub_menu], "w");
else if ($w == 'd')
	auth_check($auth[$sub_menu], "d");
*/
	check_input_vars();

	print_r($_POST);
	echo "<br>=======<br>";
	print_r($_GET);

echo "<br>=======<br>";
	echo $it_explan."<br>";
	echo strip_tags(trim($_POST['it_explan']));
	//exit;
	$shop_open=$common_start_hour.":".$common_start_min;
	$shop_close=$common_end_hour.":".$common_end_min;

	$shop_open=$week_start_hour.":".$week_start_min;
	$shop_close=$week_end_hour.":".$week_end_min;

	$sql_common = " shop_detail               = '$it_explan',
		shop_addr1			= '$it_address',
		shop_contract		='$it_contact',
		shop_memo			='$it_shop_info2',
		shop_open_time1		='$shop_open',
		shop_open_time2		='$shop_close',
		shop_close_time1	='$common_end_hour',
		shop_close_time2	='$week_end_hour',
		shop_dayoff			='$shop_dayoff'
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

		//$sql_common .= " , it_time = '".G5_TIME_YMDHIS."' ";
		$sql_common .= " , it_update_time = '".G5_TIME_YMDHIS."' ";
		$sql = " insert Nail25_nailshop_list
			set shop_id = '$it_id',
			$sql_common	";
		sql_query($sql);
	}else if ($w == "u"){
		//$sql_common .= " , it_update_time = '".G5_TIME_YMDHIS."' ";
		$sql = " update Nail25_nailshop_list
			set $sql_common
			where shop_id = '$it_id' ";
		sql_query($sql);
	}

	echo $sql;
	//exit;
?>
<script>
	if (confirm("계속 입력하시겠습니까?"))
		location.href = "<?php echo "./shop_info_form.php?id=$it_id";?>";
	else
	location.href = "<?php echo "./shop_info_form.php?".str_replace('&amp;', '&', $qstr); ?>";
</script>