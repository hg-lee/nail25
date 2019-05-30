<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$sql = " select * from {$g5['slide_table']}
          where '".G5_TIME_YMDHIS."' between nw_begin_time and nw_end_time
            and nw_device IN ( 'both', 'pc' )
          order by nw_id asc ";
$result = sql_query($sql, false);
?>
<?php
for ($j=0; $nw=sql_fetch_array($result); $j++)
{
if ($_COOKIE["hd_pops_{$nw['nw_id']}"])
continue;
$a = $j+ 1;

$matches = get_editor_image($nw['nw_content'], true);
for($i=0; $i<count($matches[1]); $i++) {
$img = $matches[1][$i];
preg_match("/src=[\'\"]?([^>\'\"]+[^>\'\"]+)/i", $img, $m);
$src = $m[1];
echo "<img src=".$src." >".PHP_EOL;
// echo "<div class=\"slide$a\"><img src=".$src." ></div>".PHP_EOL; 이건 slick 슬라이드 할때 쓰세용
}
}
if ($j == 0) echo '<span class="sound_only">등록된 이미지가 없습니다.</span>';
?>
