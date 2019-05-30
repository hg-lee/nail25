<?
include_once('./_common.php');

function get_myrecipe_last(){
    global $g5;

    $sql = " SELECT mr_id FROM Nail25_nailart_list ";
    $sql.= " ORDER BY mr_id DESC LIMIT 1 ";
    error_log($sql);
    //$result=sql_query($sql);
    $row=sql_fetch($sql);

    return $row['mr_id'];
}

function get_myrecipe($idx){
    global $g5;

    $sql = " SELECT * FROM Nail25_nailart_list WHERE mr_id='$idx' ";
    error_log($sql);
    $row=sql_fetch($sql);

    return $row;
}
//echo "<pre>";
//print_r($_POST);
$mode=$_GET['mode'];
if($mode==''){
    $mode=$_POST['mode'];
}

$work_from=$_GET['work_from'];
if($work_from==''){
    $work_from=$_POST['work_from'];
    if($work_from=='') $work_from='mr';
}

if($work_from=='mr'){
    $DIR_2="/content/MyRecipe/";
    $ltype='2';
}else{
    $DIR_2="/content/NailArt/";
    $ltype='1';
}
error_log($mode);
/*
echo "<pre>";
print_r($_POST);
echo "<br>=======<br>";
print_r($_FILES);
echo "<br>=======<br>";

print_r($_FILES['comp_img']);
echo "<br>=======<br>";
*/

$uidx=$_POST['user_idx'];
//$subject=
$s_tag=explode(",",trim($_POST['selected_tags']));
for($k=0;$k<count($s_tag);$k++){
    error_log("[".$s_tag[$k]."]");
}

$cnt_v=0;
for($i=0;$i<count($s_tag);$i++){
    if(strlen($s_tag[$i])>=1){
        $tags[$cnt_v]=trim(str_replace("#", '', $s_tag[$i]));
        $cnt_v++;
    }
}
$u_tag=explode(" ",trim($_POST['user_tag']));
if(count($u_tag)>=1){
    for($i=0;$i<count($u_tag);$i++){
        if($u_tag[$i]!=''){
            $tags[$cnt_v]=str_replace("#", '', $u_tag[$i]);
            $cnt_v++;
        }
    }
}
//print_r($_POST['selected_tags']);
//print_r($s_tag);
//exit;
$is_comp=$_POST['is_complete'];
/*
echo "<br>=======<br>1111";
print_r($tags);
echo "<br>=======<br>1111";

selected_tags
user_tag

file list
complete img : comp_img
순서 : ex_file1~ ex_file10
설명 : rep_exp1_txt ~ rep_exp10_txt

기본 케어 포함여부 : default_care  on / off

complete image : comp_img
order image : ex_file1 ~ ex_file10
order explain : rep_exp1_txt ~ rep_exp10_txt




if ($_FILES['co_himg']['name'])
    {
        $dest_path = G5_DATA_PATH."/content/".$co_id."_h";
        @move_uploaded_file($_FILES['co_himg']['tmp_name'], $dest_path);
        @chmod($dest_path, G5_FILE_PERMISSION);
    }
    if ($_FILES['co_timg']['name'])
    {
        $dest_path = G5_DATA_PATH."/content/".$co_id."_t";
        @move_uploaded_file($_FILES['co_timg']['tmp_name'], $dest_path);
        @chmod($dest_path, G5_FILE_PERMISSION);
    }
}
*/

if($mode=='d'){
    $mr_id=$_GET['mr_id'];
    $recipe_info=get_myrecipe($mr_id);
    //print_r($recipe_info);
    //echo "DELETE $mr_id";

    //@unlink(G5_DATA_PATH."/content/{$co_id}_t");
    for($i=1;$i<=10;$i++){
        $field_name="mr_img".$i;
        if($recipe_info[$field_name]!='') @unlink(G5_DATA_PATH.$DIR_2.$mr_id."/".$recipe_info[$field_name]);
    }
    
    $sql = " DELETE FROM Nail25_nailart_list WHERE mr_id='$mr_id' ";
    $rst=sql_query($sql);

    if($rst) alert('정상처리되었습니다.'.G5_DOMAIN);
    else alert('레시피 삭제에 문제가 발생하였습니다. 관리자에게 문의하세요.');
}

if($mode=='m'){
    $mr_id=$_POST['mr_id'];
    $recipe_info=get_myrecipe($mr_id);

    //print_r($recipe_info);
}

$mr_id=$_POST['mr_id'];
$shop_idx=$_POST['shop_idx'];
$l_idx=get_myrecipe_last();
$last_idx=$l_idx+1;

$d_tmp=$_POST['default_care'];
if($d_tmp) $default_c='Y';
else $default_c='N';
$recipe_price=str_replace(",","",$_POST['price']);

@mkdir(G5_DATA_PATH.$DIR_2.$last_idx, G5_DIR_PERMISSION, true);
@chmod(G5_DATA_PATH.$DIR_2.$last_idx, G5_DIR_PERMISSION);

//완성이미지 업로드

    if($_FILES['comp_img']['name']){
        $tmp_ext=explode(".", $_FILES['comp_img']['name']);
        $ext_name=$tmp_ext[1];
        $fname=md5(date('YmdHis')."comp_img");

        $dest_path=G5_DATA_PATH.$DIR_2.$last_idx;
        if(@move_uploaded_file($_FILES['comp_img']['tmp_name'], $dest_path."/".$fname.".".$ext_name)){
            error_log($_FILES['comp_img']['tmp_name']."(".$dest_path."/".$fname.".".$ext_name.") is Upload OK");
            //@chmod($dest_path, G5_FILE_PERMISSION);
            $comp_img_dir=$DIR_2.$last_idx."/".$fname.".".$ext_name;
        }else{
            error_log($_FILES['comp_img']['tmp_name']." is Upload Fail[".$_FILES["comp_img"]["error"]."]");
            alert('이미지 등록에 문제가 있습니다. 확인 후 다시 시도해주세요.');
        }
    }else{
        if($mode=='m'){
            $comp_img_dir=$recipe_info['mr_comp_img'];
        }else{
            error_log("comp_img is Not Found");
            alert('이미지 등록에 문제가 있습니다. 확인 후 다시 시도해주세요.');
        }
    }
for($i=1;$i<=10;$i++){
    $tmp_ext="";
    $ext_name="";
    $fname="";

    $img_tmp="ex_file".$i;
    $img_exp_arr_tmp="rep_exp".$i."_txt";
    $tmp_ext=explode(".", $_FILES[$img_tmp]['name']);
    $ext_name=$tmp_ext[1];
    $fname=md5(date('YmdHis').$img_tmp);
    error_log($fname);
	
    if($_FILES[$img_tmp]['name']){
        $dest_path=G5_DATA_PATH.$DIR_2.$last_idx;
        if(move_uploaded_file($_FILES[$img_tmp]['tmp_name'], $dest_path."/".$fname.".".$ext_name)){
            error_log($_FILES[$img_tmp]['tmp_name']."(".$dest_path."/".$fname.".".$ext_name.") is Upload OK");
            //chmod($dest_path, G5_FILE_PERMISSION);
            $img_tmp_dir=$DIR_2.$last_idx."/".$fname.".".$ext_name;
            $name_tmp="mr_img".$i;
            $img_arr[$i]=$img_tmp_dir;
            $img_exp_arr[$i]=$_POST[$img_exp_arr_tmp];
            //echo "<br>".$img_exp_arr_tmp."[".$_POST[$img_exp_arr_tmp]."]<br>";
        }else{
            error_log($_FILES[$img_tmp]['tmp_name']."($img_tmp) is Upload Fail[".$dest_path."/".$fname.".".$ext_name."]");
            alert('이미지 등록에 문제가 있습니다. 확인 후 다시 시도해주세요.');
        }
    }else{
        if($mode=='m'){
            $exist_img_name="mr_img".$i;
            $img_arr[$i]=$recipe_info[$exist_img_name];
            $img_exp_arr[$i]=$_POST[$img_exp_arr_tmp];
        }else{
            error_log("$img_tmp is Not Found[".$_FILES[$img_tmp]["error"]."]");
            $img_arr[$i]='';
            $img_exp_arr[$i]='';
        }
        //alert('이미지 등록에 문제가 있습니다. 확인 후 다시 시도해주세요.');
    }
}
/*
echo "%%%%%<br>";
print_r($img_exp_arr);
echo "<br>------<br>";
echo $_POST['rep_exp1_txt'];
echo "<br>------<br>";
print_r($tags);
echo "%%%%%<br>";
*/
    global $g5;

    $hashtags="";
    $progress_img="";
    $progress_img_exp="";
    for($i=0;$i<count($tags);$i++){
        if($i==0)   $hashtags=$tags[$i];
        else $hashtags=$hashtags.",".$tags[$i];
    }

    for($i=1;$i<=count($img_arr);$i++){
        if($mode=='m'){
            if($i==1){
                $progress_img="mr_img".$i."='".$img_arr[$i]."'";
                $progress_img_exp="mr_img".$i."_exp='".$img_exp_arr[$i]."'";
            }
            else{
                $progress_img=$progress_img.",mr_img".$i."='".$img_arr[$i]."'";
                $progress_img_exp=$progress_img_exp.",mr_img".$i."_exp='".$img_exp_arr[$i]."'";
            }
        }else{
            if($i==1){
                $progress_img="'".$img_arr[$i]."'";
                $progress_img_exp="'".$img_exp_arr[$i]."'";
            }
            else{
                $progress_img=$progress_img.",'".$img_arr[$i]."'";
                $progress_img_exp=$progress_img_exp.",'".$img_exp_arr[$i]."'";
            }
        }
    }
    //echo "[".$progress_img_exp."]<br>";
    if($mode=='m' || $mr_id>0){
        $sql = " UPDATE Nail25_nailart_list SET mr_subject='', mr_contents='', mr_hashtag='$hashtags', mr_ltype='$ltype', mr_comp_img='$comp_img_dir' ";
        $sql.= " ,$progress_img, $progress_img_exp, mr_complete='$is_comp', mr_default_care='$default_c', mr_price='$recipe_price' WHERE mr_id='$mr_id'";
    }else{
        $sql = " INSERT INTO Nail25_nailart_list(mr_sidx, mr_shopidx, mr_subject, mr_contents, mr_hashtag, mr_ltype, mr_comp_img ";
        $sql.= " ,mr_img1, mr_img2, mr_img3, mr_img4, mr_img5,  mr_img6, mr_img7, mr_img8, mr_img9, mr_img10, ";
        $sql.= " mr_img1_exp, mr_img2_exp, mr_img3_exp, mr_img4_exp, mr_img5_exp, mr_img6_exp, mr_img7_exp, mr_img8_exp, mr_img9_exp, mr_img10_exp,";
        $sql.= " mr_complete,mr_default_care, mr_price) ";
        $sql.= " VALUES($uidx,$shop_idx,'','','$hashtags','$ltype','$comp_img_dir', ";
        $sql.= " $progress_img, $progress_img_exp,'$is_comp','$default_c','$recipe_price' )";
    }

    //echo $sql;
    //exit;

    $rst=sql_query($sql);
    if($rst){
        if($is_comp=='N'){
            if($mr_id>0) $last_id=$mr_id;
            else $last_id=get_myrecipe_last();

            ?>
            <script>
                alert('임시저장되었습니다.');
                //history.back();
                //location.reload();
                location.href='shop_nailart_manage.php?mode=m&mr_id=<?=$last_id?>';
                //opener.location.reload();
            </script>
            <?
        }else alert('정상처리 되었습니다.','shop_nailart_manage.php');
    }else{
        alert('레시피 등록에 문제가 발생하였습니다. 잠시후 다시 시도해주세요.('.$sql.')');
    }
//print_r($img_arr);
//echo $sql;
?>