<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

$menus = array();

$sql = " select * from {$g5['menu_table']} where me_use = '1' and length(me_code) = '2' order by me_order, me_id ";
$result = sql_query($sql, false);

$active_bo_table = isset($bo_table) ? $bo_table : '';
$active_co_id = isset($co_id) ? $co_id : '';
$active_gr_id = isset($gr_id) ? $gr_id : '';

$active_checks = array('bo_table'=>$active_bo_table, 'co_id'=>$active_co_id, 'gr_id'=>$active_gr_id);

function cm_menu_is_active($active_checks, $url)
{
    foreach($active_checks as $key=>$value) {
        if(!$value) continue;
        if(preg_match('/'.$key.'='.$value.'/', $url)) return true;
    }
    return false;
}

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $menu_item = array('url' => $row['me_link'], 'target' => $row['me_target'], 'name' => $row['me_name'], 'is_active'=>false, 'sub_menu' => array());
    if(cm_menu_is_active($active_checks, $row['me_link'])) {
        $menu_item['is_active'] = true;
    }
    $sql2 = " select * from {$g5['menu_table']} where me_use = '1' and length(me_code) = '4' and substring(me_code, 1, 2) = '{$row['me_code']}' order by me_order, me_id ";
    $result2 = sql_query($sql2);
    for ($k = 0; $row2 = sql_fetch_array($result2); $k++) {
        $sm = array('url' => $row2['me_link'], 'target' => $row2['me_target'], 'is_active'=>false, 'name' => $row2['me_name']);
        if(cm_menu_is_active($active_checks, $row2['me_link'])) {
            $menu_item['is_active'] = true;
            $sm['is_active'] = true;
        }
        array_push($menu_item['sub_menu'], $sm);
    }
    array_push($menus, $menu_item);
}
?>

<!-- 상단 시작 { -->
<h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
<div id="skip_to_container"><a href="#container">본문 바로가기</a></div>
<?php
if(defined('_INDEX_')) { // index에서만 실행
	include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
}
?>

<div id="hd_wrapper"></div>    

<!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-black fixed-top">
      <div class="container">
        <a class="navbar-brand" href="<?php echo G5_URL ?>"><?php echo $config['cf_title']; ?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto navbar-right">
                <?php

                foreach($menus as $menu_item) {

                    $is_active_menu = ($menu_item['is_active'] ? 'active' : '');

                    if(empty($menu_item['sub_menu'])) {
                           
                        echo '<li class="nav-item"><a class="nav-link" href="'.$menu_item['url'].'" target="_'.$menu_item['target'].'">'.$menu_item['name'].'</a></li>'.PHP_EOL;
                        } else {
                        	echo '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$menu_item['name'].'</a>'.PHP_EOL;
							echo '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">'.PHP_EOL;
                            foreach($menu_item['sub_menu'] as $sub_menu) {
                                echo '<a class="dropdown-item" href="'.$sub_menu['url'].'" target="_'.$sub_menu['target'].'">'.$sub_menu['name'].'</a>'.PHP_EOL;
                            }
                            echo '</div>'.PHP_EOL;
                            echo '</li>'.PHP_EOL;
                        }
                    }
                    ?>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                그누보드 메뉴
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/faq.php"><i class="fa fa-question" aria-hidden="true"></i><span> FAQ</span></a>
                <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/qalist.php"><i class="fa fa-comments" aria-hidden="true"></i><span> 1:1문의</span></a>
                <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/current_connect.php"><i class="fa fa-users" aria-hidden="true"></i><span> 접속자</span><strong class="visit-num"><?php echo connect('theme/basic'); // 현재 접속자수, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정  ?></strong></a>
                <a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/new.php"><i class="fa fa-history" aria-hidden="true"></i><span> 새글</span></a>
				<?php if ($is_member) { ?>
            	<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php"><i class="fa fa-cog" aria-hidden="true"></i> 정보수정</a>
				<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/logout.php"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> 로그아웃</a>
            
				<?php if ($is_admin) { ?>            
				<a class="dropdown-item" href="<?php echo G5_ADMIN_URL ?>"><b><i class="fas fa-user-circle" aria-hidden="true"></i> 관리자</b></a>
				<?php }  ?>
            	<?php } else {  ?>
            	<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/register.php"><i class="fa fa-user-plus" aria-hidden="true"></i> 회원가입</a>
				<a class="dropdown-item" href="<?php echo G5_BBS_URL ?>/login.php"><b><i class="fas fa-sign-in-alt" aria-hidden="true"></i> 로그인</b></a>         
				<?php }  ?>
              </div>
            </li>                            
            </ul>
        </div>
      </div>
    </nav>

<!-- } 상단 끝 -->
