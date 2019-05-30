<?php
$sub_menu = '85000';
include_once('./_common.php');

$mode=$_GET['mode'];
//$mb = get_member($mb_id);

//echo "[".$mb['id']."]<br>";
$max_limit = 7; // 몇행 출력할 것인지?

$g5['title'] = ' Partner Center';
include_once (G5_ADMIN_PATH.'/admin.partnercenter_limit.head.php');

function get_myrecipe_list($idx){
    global $g5;

    $sql = " SELECT * FROM {$g5['g5_partner_center_myrecipe_table']} ";
    $sql.= " WHERE mr_id='$idx' ";
    $row=sql_fetch($sql);

    return $row;
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

function get_hashtag(){
    global $g5;

    $sql = " SELECT * FROM Nail25_hashtag WHERE ";
}

$NF=sql_field_count("{$g5['g5_partner_center_myrecipe_table']}");
$img_field_cnt=$NF-4;

$tag_list=get_tag_list();
//print_r($tag_list);
//$mb = get_member('srman');
//print_r($mb);
//echo "[".$member['mb_no']."]<br>";

$comp_img="/img/nail25_logo_big.png";
if($mode=="m"){
    $mr_no=$_GET['mr_id'];
    $recipe_list=get_myrecipe_list($mr_no);
    $comp_img="/data/".$recipe_list['mr_comp_img'];
}

//echo "[".$mode."][".$comp_img."]";
//print_r($recipe_list);
$tag_tmp=explode(",",$recipe_list['mr_hashtag']);
$get_hashtag="";
for($i=0;$i<count($tag_tmp);$i++){
    if($i==0) $get_hashtag="#".$tag_tmp[$i];
    else $get_hashtag=$get_hashtag.", #".$tag_tmp[$i];
}
$process_img_cnt=0;
for($i=1;$i<=10;$i++){
    $field_name="mr_img".$i;
    if(strlen($recipe_list[$field_name])>0) $process_img_cnt++;
}
?>

<style>
    .filebox label {
      display: inline-block;
      padding: .5em .75em;
      color: #fff;
      font-size: inherit;
      line-height: normal;
      vertical-align: middle;
      background-color: #5cb85c;
      cursor: pointer;
      border: 1px solid #4cae4c;
      border-radius: .25em;
      -webkit-transition: background-color 0.2s;
      transition: background-color 0.2s;
    }

    .filebox label:hover {
      background-color: #6ed36e;
    }

    .filebox label:active {
      background-color: #367c36;
    }

    .filebox input[type="file"] {
      position: absolute;
      width: 1px;
      height: 1px;
      padding: 0;
      margin: -1px;
      overflow: hidden;
      clip: rect(0, 0, 0, 0);
      border: 0;
    }

    .tagbox{
      width:100%;text-align: center;height:50px;border:1px solid black; 
      line-height: 50px; 
    }
    .tag_select_box_title{
      width:100px;text-align: center;height:100px;border:1px solid black; 
      line-height: 100px;
      float:left;
    }
    .tag_select_box_contents{
        width:575px;height:100px;border:1px solid red;margin-left:110px;
    }
    .tag_select_box_cTop{
        width:100%;border-bottom: 1px solid black;height:50px;
        line-height: 50px;
        text-align: center;
    }
    .tag_select_box_one{
        width:100%;height:100px;
        line-height:100px;
    }
    .tag_select_box_cBottom{
        width:100%;height:50px;
        line-height: 50px;
        text-align: center;
    }
    .hash_tag_subject{
        font-size:15px;
        cursor:pointer;
    }

    .recipe_work_wrap{
        width:100%;margin-top:10px;text-align: center;
    }
    .recipe_work_img{
        width:50%;text-align: center;height:200px;border:1px solid black;
        margin-left:25%;
        background-image:url('/img/nail25_logo_big.png');background-size: 100% 100%;
    }
    .recipe_work_contents{
        width:100%;text-align:center;margin-top:10px;
    }
    .rep_exp{
        width:50%;margin-left:25%;
    }
    .rep_exp_txt{
        width:100%;
    }
</style>
<script>
    $(function(){
        $('.add_div').click(function(){
            //alert($("#r_cnt").val());
            var n_cnt=parseInt($("#r_cnt").val())+1;
            var file_id_name='ex_file'+n_cnt;
            var textf_name='rep_exp'+n_cnt+'_txt';
            var tmpHtml="";
            //tmpHtml = tmpHtml+"<div class='recipe_work_wrap'><div class='recipe_work_img'>네일 이미지를 등록하세요.</div><div class='recipe_work_contents'><div class='filebox'><label for="+file_id_name+"'>이미지 불러오기</label><input type='file' id='imglist' name='"+file_id_name+"'></div></div></div>";
            tmpHtml=tmpHtml+"<div class='recipe_work_wrap'><div class='recipe_work_img'></div><div class='recipe_work_contents'><input type='file' id='imglist' name='"+file_id_name+"'> <div class='rep_exp'><textarea class='"+textf_name+"' cols='30' rows='5' placeholder='설명을 입력하세요..'' name='"+textf_name+"'></textarea></div></div></div>";
            $("#field").append(tmpHtml);
            $("#r_cnt").val(n_cnt);
            //alert(n_cnt);
        });
    });
    function example_append(hashtag_value) {
        //alert($(hashtag_value).text());
        var add_tag_name='';
        var search_cnt=0;
        var add_t="";
        var aa=$('#tag_li').text();
        var tmpSplit=aa.split(',');

        for( var i in tmpSplit ){
            var tmp_t=tmpSplit[i];
            search_tag=tmp_t.trim();
            if(search_tag==$(hashtag_value).text()) search_cnt++;
            else{
                add_tag_name=add_tag_name+','+search_tag;
            }
        }
        //alert(aa.length);

        if(search_cnt==0){
            if(aa.length>0) add_t=", ";
            else add_t="";
            var add_style="<span class='hash_tag_subject' onClick='remove_tags(this)'>";
            var end_style="</span>";
            $('#tag_li').append(add_t+add_style+$(hashtag_value).text()+end_style);
        }
        $("#selected_tags").val(add_tag_name);
    }

    function go_temp(){
        var obj=document.sr_form;
        $('#is_complete').val('N');
        obj.submit();
    }

    function on_work(idx){
        if(idx==1) history.back(-1);
        else{
            var obj=document.sr_form;
            obj.submit();
        }
    }

    function remove_tags(h_val){
        var search_tag=null;
        var add_tag_name='';
        var target_v=$(h_val).text();
        var tag_list=$('#tag_li').text();
        var tagSplit=tag_list.split(',');
        
        var add_style="<span class='hash_tag_subject' onClick='remove_tags(this)'>";
        var end_style="</span>";

        $('#tag_li').text(' ');
        for( var i in tagSplit ){
            var tmp_target=tagSplit[i];
            search_tag=tmp_target.trim();
            if(i>1) add_t=", ";
            else add_t="";
            //alert(search_tag+'|'+target_v);
            if(search_tag!=target_v){
                add_tag_name=add_tag_name+','+search_tag;
                $('#tag_li').append(add_t+add_style+search_tag+end_style);
            }
        }
        $("#selected_tags").val(add_tag_name);
    }

    var uploadFile = $('.filebox #imglist');
    uploadFile.on('change', function(){
        if(window.FileReader){
            var filename = $(this)[0].files[0].name;
        } else {
            var filename = $(this).val().split('/').pop().split('\\').pop();
        }

        $(this).siblings('.fileName').val(filename);
    });
</script>
<form name="sr_form" method="POST" action="myrecipe_process.php" enctype="MULTIPART/FORM-DATA">
    <input type="hidden" name="selected_tags" id="selected_tags">
    <input type="hidden" name="r_cnt" id="r_cnt" value="1">
    <input type="hidden" name="user_idx" value="<?=$member['mb_no']?>">
    <input type="hidden" name="is_complete" id="is_complete" value="Y">
<div class="sidx">
    <section id="anc_sidx_ord">
        <h2>레시피 리스트</h2>
        <div style="width:100%;margin-top:10px;">
            <div style="width:100%;text-align: center;height:400px;border:1px solid black;background-image:url('<?=$comp_img?>');background-size: 100% 100%;"></div>
            <div style="width:100%;text-align:center;margin-top:10px;">
                <input type="file" id="imglist" name="comp_img">
            </div>
        </div>
        <div style="width:100%;margin-top:10px;">
            <div class="tagbox">
                <span id="tag_li" style="font-size:15px;overflow: hidden;display: inline-block"><?=$get_hashtag?></span>
            </div>
        </div>

        <div style="width:100%;margin-top:10px;">
            <div class="tag_select_box_title">기본 태그 선택</div>
            <div class="tag_select_box_contents">
                <div class="tag_select_box_cTop">
                    <?for($i=0;$i<count($tag_list[1]);$i++){
                    echo "<span class='hash_tag_subject' onClick='example_append(this)'>#".$tag_list[1][$i]."</span>";
                    if($i<count($tag_list[1])-1) echo ",";
                    }?>
                </div>
                <div class="tag_select_box_cBottom">
                    <?for($i=0;$i<count($tag_list[2]);$i++){
                    echo "<span class='hash_tag_subject' onClick='example_append(this)'>#".$tag_list[2][$i]."</span>";
                    if($i<count($tag_list[2])-1) echo ",&nbsp;";
                    }?>
                </div>
            </div>
        </div>

        <div style="width:100%;margin-top:10px;">
            <div class="tag_select_box_title">컬러 태그 선택</div>
            <div class="tag_select_box_contents">
                <div class="tag_select_box_cTop">
                    <?for($i=0;$i<count($tag_list[3]);$i++){
                    echo "<span class='hash_tag_subject' onClick='example_append(this)'>#".$tag_list[3][$i]."</span>";
                    if($i<count($tag_list[3])-1) echo ",";
                    }?>
                </div>
                <div class="tag_select_box_cBottom">
                    <span>#골드</span>,<span>#실버</span>,<span>#믹스</span>
                </div>
            </div>
        </div>

        <div style="width:100%;margin-top:10px;">
            <div class="tag_select_box_title">사용자 태그 입력</div>
            <div class="tag_select_box_contents">
                <div class="tag_select_box_one">
                    <input type="text" name="user_tag" style="height:50px;width:100%;font-size:15px;">
                </div>
            </div>
        </div>

        <div style="width:100%;margin-top:10px;text-align: right;padding-bottom:30px;">
            <div style="float:left;"><input type="checkbox" name="default_care"></div>
            <div style="float:left;">
                <span style="font-size:20px;">기본 케어 포함</span>
            </div>
        </div>

        <div style="width:100%;margin-top:10px;text-align: center;padding-bottom:20px;">
            <div style="left:50%;">
                <button style="width:200px;height:50px;line-height: 50px;font-size:18px;" onClick='go_temp();return false;'>임시저장</button>
            </div>
        </div>
        <?if($mode=="m"){
            for($i=0;$i<$process_img_cnt;$i++){
                $p_field_name="mr_img".($i+1);
                $p_field_exp="mr_img".($i+1)."_exp";
                //echo $recipe_list[$p_field_name];
                ?>
                <div class="recipe_work_wrap">
                    <div class="recipe_work_img" style="background-image:url('/data/<?=$recipe_list[$p_field_name]?>');"></div>
                    <div class="recipe_work_contents">
                         <input type="file" id="imglist" name="ex_file1">
                         <div class="rep_exp">
                               <textarea class="rep_exp1_txt" cols="50" rows="5" placeholder="설명을 입력하세요.." name="rep_exp1_txt"><?=$recipe_list[$p_field_exp]?></textarea>
                        </div>
                    </div>
                </div>
            <?}?>
            <div style="width:100%;margin-top:10px;text-align: center;">
                <div style="left:50%;">
                    <button style="width:180px;height:50px;line-height: 50px;font-size:18px;margin-right:20px;" onClick='on_work(1);return false;'>취소</button>
                    <button style="width:180px;height:50px;line-height: 50px;font-size:18px;" onClick='on_work(2);return false;'>수정</button>
                </div>
            </div>
        <?}else{?>
        <div class="recipe_work_wrap">
            <div class="recipe_work_img"></div>
            <div class="recipe_work_contents">
                 <input type="file" id="imglist" name="ex_file1">
                 <div class="rep_exp">
                       <textarea class="rep_exp1_txt" cols="30" rows="5" placeholder="설명을 입력하세요.." name="rep_exp1_txt"></textarea>
                </div>
            </div>
        </div>

        <div id="field"></div>
        
        <div style="width:100%;margin-top:10px;text-align: center;" >
            <div style="left:50%;"  class="add_div">
                <button style="width:100px;height:30px;line-height: 30px;font-size:15px;" onClick="javascript:return false;">추가</button>
            </div>
        </div>
        <div style="width:100%;margin-top:10px;text-align: center;">
            <div style="left:50%;">
                <button style="width:180px;height:50px;line-height: 50px;font-size:18px;margin-right:20px;">취소</button>
                <button style="width:180px;height:50px;line-height: 50px;font-size:18px;margin-right:20px;">임시저장</button>
                <button style="width:180px;height:50px;line-height: 50px;font-size:18px;">저장</button>
            </div>
        </div>
        <?}?>

    </section>
</form>
</div>



<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>
