<?php
$sub_menu = '85000';
include_once('./_common.php');

$max_limit = 7; // 몇행 출력할 것인지?

$g5['title'] = '파트너 센터';
include_once (G5_ADMIN_PATH.'/admin.partnercenter_limit.head.php');


function get_myrecipe_list($idx, $level){
    global $g5;

    error_log("Level : ".$level);
    $sql = " SELECT * FROM {$g5['g5_partner_center_myrecipe_table']} ";
    if($level < 10) $sql.= " WHERE mr_sidx='$idx'";
    $sql.="  ORDER BY mr_id DESC";

    error_log($sql);
    $result=sql_query($sql);
    $cnt=0;
    while($row=sql_fetch_array($result)){
        $list[$cnt]['mr_id']=$row['mr_id'];
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

function get_max_value($arr)
{
    foreach($arr as $key => $val)
    {
        if(is_array($val))
        {
            $arr[$key] = get_max_value($val);
        }
    }

    sort($arr);

    return array_pop($arr);
}

function get_field_cnt(){
    global $g5;

    $sql = " SELECT * FROM {$g5['g5_partner_center_myrecipe_table']} ";
}
$NF=sql_field_count("{$g5['g5_partner_center_myrecipe_table']}");
$img_field_cnt=$NF-4;

//echo "[".$img_field_cnt."]<br>";
//echo "[".G5_ADMIN_URL."]";
//$mb = get_member($mb_id);
//echo $member['mb_no'];
//print_r($member);
?>

<div class="sidx">
    <section id="anc_sidx_ord">
        <h2>레시피 리스트</h2>
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
        <div style="width:100%;">
            <div style="width:80%;max-width:600px;float:left;margin-bottom: 20px;padding-top:10px;border-bottom:2px solid gray;">
                <div style="width:100%;max-width:600px;height:400px;background-image: url('/data/<?=$recipe_list[$r_cnt]['mr_comp_img']?>');background-size: contain;background-repeat: no-repeat;">
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
                        <a href="myrecipe_add.php?mode=m&mr_id=<?=$recipe_list[$r_cnt]['mr_id']?>"><button style="font-size:16px;width:120px;height:60px;">수정</button></a>
                    </div>
                    <div id="sidx_take_act" class="tbl_head01 tbl_wrap">
                        <a href="myrecipe_process.php?mode=d&mr_id=<?=$recipe_list[$r_cnt]['mr_id']?>"><button style="font-size:16px;width:120px;height:60px;">삭제</button></a>
                    </div>
                </section>
            </div>
        </div>

        <?
        }}else{
        ?>
        <div style="width:100%;margin-top:10px;">
            <div style="height:100px;text-align:center;line-height:100px;">작성된 레시피가 없습니다.</div>
        </div>
    </section>
    <div id="sidx_stat">
        <section id="anc_sidx_act">
            <h2>신규등록</h2>
            <div id="sidx_take_act" class="tbl_head01 tbl_wrap">
                <a href="myrecipe_add.php"><button style="font-size:16px;width:120px;height:60px;">신규 등록</button></a>
            </div>
        </section>
    </div>
        <?}?>
    </section>

    
</div>


</div>

<script>
$(function() {
    graph_draw();

    $("#sidx_graph_area div").hover(
        function() {
            if($(this).is(":animated"))
                return false;

            var title = $(this).attr("title");
            if(title && $(this).data("title") == undefined)
                $(this).data("title", title);
            var left = parseInt($(this).css("left")) + 10;
            var bottom = $(this).height() + 5;

            $(this)
                .attr("title", "")
                .append("<div id=\"price_tooltip\"><div></div></div>");
            $("#price_tooltip")
                .find("div")
                .html(title)
                .end()
//                .css({ left: left+"px", bottom: bottom+"px" })
                .show(200);
        },
        function() {
            if($(this).is(":animated"))
                return false;

            $(this).attr("title", $(this).data("title"));
            $("#price_tooltip").remove();
        }
    );
});

</script>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
