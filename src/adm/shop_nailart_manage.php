<?php
$sub_menu = '1300300';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

//auth_check($auth[$sub_menu], "r");

$g5['title'] = '매장 정보 관리';
include_once (G5_ADMIN_PATH.'/admin.partnercenter_limit.head.php');

function get_myrecipe_list($idx, $level){
    global $g5;

    error_log("Level : ".$level);
    $sql = " SELECT * FROM Nail25_nailart_list ";
    if($level < 10) $sql.= " WHERE mr_sidx='$idx'";
    $sql.="  ORDER BY mr_id DESC";

    error_log($sql);
    $result=sql_query($sql);
    $cnt=0;
    while($row=sql_fetch_array($result)){
        $list[$cnt]['mr_id']=$row['mr_id'];
        $list[$cnt]['mr_shopidx']=$row['mr_shopidx'];
        $list[$cnt]['mr_subject']=$row['mr_subject'];
        $list[$cnt]['mr_contents']=$row['mr_contents'];
        $list[$cnt]['mr_hashtag']=$row['mr_hashtag'];
        $list[$cnt]['mr_comp_img']=$row['mr_comp_img'];
        $list[$cnt]['mr_img1']=$row['mr_img1'];
        $list[$cnt]['mr_img2']=$row['mr_img2'];
        $list[$cnt]['mr_img3']=$row['mr_img3'];
        $list[$cnt]['mr_img4']=$row['mr_img4'];
        $list[$cnt]['mr_img5']=$row['mr_img5'];
        $list[$cnt]['mr_img6']=$row['mr_img6'];
        $list[$cnt]['mr_img7']=$row['mr_img7'];
        $list[$cnt]['mr_img8']=$row['mr_img8'];
        $list[$cnt]['mr_img9']=$row['mr_img9'];
        $list[$cnt]['mr_img10']=$row['mr_img10'];

        $cnt++;
    }

    return $list;
}

$comp_img="/img/nail25_logo_big.png";
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

<div class="sidx">
    <section id="anc_sidx_ord">
        <h2>네일아트 리스트</h2>
        <div id="sidx_stat">
            <section id="anc_sidx_act">
                <div id="sidx_take_act" class="tbl_head01 tbl_wrap">
                    <a href="shop_nailart_add.php"><button style="font-size:12px;width:80px;height:30px;border-radius: 8px;">신규 등록</button></a>
                </div>
            </section>
        </div>
        <?
        $recipe_list=get_myrecipe_list($member['mb_no'],$member['mb_level']);
        //echo "<pre>";
        //print_r($recipe_list);
        $progress_img=0;
        //echo "[".count($recipe_list)."]<br>";
        if(count($recipe_list)>0){
            for($r_cnt=0;$r_cnt<count($recipe_list);$r_cnt++){
                for($tmp_cnt=0;$tmp_cnt<10;$tmp_cnt++){
                    $sub_img="mr_img".($tmp_cnt+1);
                    //echo $recipe_list[$r_cnt][$sub_img];
                    //echo strlen($recipe_list[$r_cnt][$sub_img])."|";
                    if(strlen($recipe_list[$r_cnt][$sub_img])>0) $progress_img++;
                }
                //echo $progress_img."]<br>";
        ?>
        <div style="width:100%;display:table;">
            <div style="width:80%;max-width:400px;float:left;margin-bottom: 20px;padding-top:10px;border-bottom:2px solid gray;text-align:center;">
                <div style="width:100%;max-width:200px;height:200px;background-image: url('/data/<?=$recipe_list[$r_cnt]['mr_comp_img']?>');background-size: contain;background-repeat: no-repeat;margin:0 auto;">
                </div>
                <div style="width:100%;overflow-x:scroll;margin-top:10px;">
                    <div style="width:100%;min-width:2000px;">
                        <?for($i=0;$i<$progress_img;$i++){
                            $sub_i_name="mr_img".($i+1);
                            //echo $sub_i_name;
                        ?>
                            <div style="width:150px;height:150px;margin-right:5px;float:left;background-image:url('/data/<?=$recipe_list[$r_cnt][$sub_i_name]?>');background-size: 145px 145px;background-repeat: no-repeat;">
                            </div>
                        <?}?>
                    </div>
                </div>
            </div>
            <div style="width:20%;max-width:200px;float:left;padding-left:20px;padding-top:10px;">
                <section>
                    <div id="sidx_take_act" class="tbl_head01 tbl_wrap">
                        <a href="shop_nailart_add.php?mode=m&mr_id=<?=$recipe_list[$r_cnt]['mr_id']?>"><button style="font-size:16px;width:100px;height:50px;">수정</button></a>
                    </div>
                    <div id="sidx_take_act" class="tbl_head01 tbl_wrap">
                        <a href="shop_naillist_process.php?mode=d&mr_id=<?=$recipe_list[$r_cnt]['mr_id']?>"><button style="font-size:16px;width:100px;height:50px;">삭제</button></a>
                    </div>
                </section>
            </div>
        </div>
        <?
        }}else{
        ?>
        <div style="width:100%;margin-top:10px;">
            <div style="height:100px;text-align:center;line-height:100px;">네일아트가 없습니다.</div>
        </div>
    </section>
        <?}?>
    </section>

    
</div>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>