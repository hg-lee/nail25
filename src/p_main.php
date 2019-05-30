<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">


<?
include_once('../../include/common.php');
$dataPoints = array(
	array("label"=> "1월", "y"=> 41),
	array("label"=> "2월", "y"=> 35, "indexLabel"=> "Lowest"),
	array("label"=> "3월", "y"=> 50),
	array("label"=> "4월", "y"=> 45),
	array("label"=> "5월", "y"=> 52),
	array("label"=> "6월", "y"=> 68),
	array("label"=> "7월", "y"=> 38),
	array("label"=> "8월", "y"=> 71, "indexLabel"=> "Highest"),
	array("label"=> "9월", "y"=> 52),
	array("label"=> "10월", "y"=> 60),
	array("label"=> "11월", "y"=> 36),
	array("label"=> "12월", "y"=> 49)
);

$wf_param=$_GET['wf'];

?>
<html xmlns="http://www.w3.org/1999/xhtml"> 

	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="http://www.google.com/jsapi"></script>
		<link href="../../assets/css/main.css" rel="stylesheet">
		<!--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>//-->

		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		

		<script>
			var wf_p='<?=$wf_param?>';
			if(wf_p==3){
				var d=new Date();
				var n=d.getTime();
				$('#detail_contents').load('/SRCMS/PCenter/Shop/shop_list.php?d='+idx+"&t="+n);
			}
			function save_popup(){
				//$("#over_popup").toggle();
				var frm=document.sr_form_1;
				var addr=$("#addr").val();
				//alert(addr);
				if(addr == '' ){
					alert('주소를 입력하세요.');
					$("#addr").focus();
					return 0;
				}else{
					//get_addr(addr);

					//if($("#lat").val()==0){
						//alert('주소오류. 확인바랍니다.');
					//}else{
						//frm.action='Shop/shop_add_process.php';
						//frm.submit();
					//}
					//start_order_lat_non(addr);
					//var send_addr=encodeURI(addr);
					
					$.ajax({
						type: "post",
						url:"http://nail25.srman.net/api/address_api.php",
						//data:createData(),
						data:"addr="+addr,
						dataType:"json",
						contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
						//async:false,
						success : function(data, status, xhr){
							console.log(data);
							//alert('p_main : '+data['lat']);
							$("#lat").val(data['lat']);
							$("#lng").val(data['lng']);
							$("#zipcode").val(data['zipcode']);
							$("#addr").val(data['road_addr']);
							if(data['lat'] != ''){
								frm.action="Shop/shop_add_process.php";
								frm.submit();
							}else{
								alert('주소 오류입니다. 확인 후 다시 시도해주세요.');
								$("#addr").focus();
								return 0;
							}
						},
						error:function(jqXHR, textStatus, errorThrown){
							console.log(textStatus);
							alert('주소 오류입니다. 확인 후 다시 시도해주세요.');
							return 0;
						}
					});
				}
			}
			function change_depth(idx){
				//alert('aa:'+idx);
				var d=new Date();
				var n=d.getTime();
				if(idx==1) $('#detail_contents').load('/SRCMS/PCenter/Reserve/reserv_list.php?d='+idx+"&t="+n);
				else if(idx==2){
					$('#detail_contents').load('/SRCMS/PCenter/Purchase/purchase_list.php?d='+idx+"&t="+n,function(){
						var dP1;
						$.ajax({
							url:'./purchase_data.php',
							type:'post',
							data:idx,
							success:function(data){
								//alert(data);
								dP1=data;

								var chart = new CanvasJS.Chart("chartContainer", {
									animationEnabled: true,
									exportEnabled: true,
									theme: "light1", // "light1", "light2", "dark1", "dark2"
									title:{
										text: "2019년 월별 매출현황(단위 : 백만원)"
									},
									axisY: {
										title: "매출액",
										includeZero: false
									},
									data: [{
										type: "column", //change type to bar, line, area, pie, etc
										//indexLabel: "{y}", //Shows y value on all Data Points
										indexLabelFontColor: "#5A5757",
										indexLabelPlacement: "outside", 
										dataPoints: <?php echo json_encode($dataPoints); ?>
									}]
								});
								chart.render();
							}
						});
					});
				}else if(idx==3) $('#detail_contents').load('/SRCMS/PCenter/Shop/shop_list.php?d='+idx+"&t="+n);
				else if(idx==4) $('#detail_contents').load('/SRCMS/PCenter/Etc/notice_board.php?d='+idx+"&t="+n);
				else if(idx==5) $('#detail_contents').load('/SRCMS/PCenter/Etc/qna_board.php?d='+idx+"&t="+n);
				else $('#detail_contents').load('/SRCMS/PCenter/Reserve/reserv_list.php?d='+idx+"&t="+n);
			}

			function open_popup(idx){
				//alert('open_popup');
				$("#over_popup").toggle();
				var d=new Date();
				var n=d.getTime();
				$('#over_popup').load('/SRCMS/PCenter/Shop/shop_add.php?d='+idx+"&t="+n);
				
			}

			function edit_info(idx){
				$("#over_popup").toggle();
				var d=new Date();
				var n=d.getTime();
				$('#over_popup').load('/SRCMS/PCenter/Shop/shop_add.php?m=e&d='+idx+"&t="+n);
			}

			function close_popup(){
				$("#over_popup").toggle();
			}

		</script>

		<style>
			.wrap{
				width:100%;
				max-width:1200px;
				min-width:600px;
				display:table;
				overflow:scroll;
			}
			.menu_container{
				display:inline-block;
				vertical-align:middle;
				width:1200px;
				margin:0 auto;
			}
			.main_container{
				width:100%;
				display:table;
				text-align:center;
				vertical-align:middle;
				height:80px;
			}
			.contents_wrap{
				width:200px;
				border-radius: 10px;
				border:1px solid #e4e5e4;
				height:80px;
				display:inline-block;
				vertical-align:middle;
				margin-bottom: 10px;
				cursor: pointer;
			}
			.contents_list{
				vertical-align: middle;
				line-height:80px;
			}

			.over_popup{
				position: absolute;
				 width: 600px;
				 height: 470px;
				 left: 50%;
				 top: 50%;
				 margin-left: -300px;
				 margin-top: -250px;
				 border: #000 solid 1px;
				 display:none;
				 background:#e4e5e4;
			}
		</style>
	</head>
	<body>
<?
if($wf_param==3){
	//echo "<script>change_depth(".$wf_param.");</script>";
}
?>
		<header>
			<hgroup>
				<h1>네일25 Partner Center</h1>
			</hgroup>
		</header>
		<div class="wrap">

			<div class="menu_container">

				<div style="width:230px;float:left;">
					<div style="border-top:1px solid red;border-bottom:1px solid red;">
						<?
						include_once('menu_list.php');
						?>
					</div>
				</div>
				<div style="width:670px;float:left;" id="detail_contents">
					<div style="width:100%;height:100%;">
						<span style="font-size:25;text-align:center;top:50%;">CMS</span>
					</div>
				</div>
			</div>
			<div class="over_popup" id="over_popup">
			</div>

		</div>
		<footer>   Footer  </footer>
	</body>
</HTML>