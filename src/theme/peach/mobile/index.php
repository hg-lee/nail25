<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>

<!-- 배너 최신글 -->
<?php
// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
// 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
echo latest('theme/banner', 'banner', 5, 33);
?>


<div class="idx_con">
    <ul>
        <li>
            <h2><i class="fa fa-briefcase"></i><span>Short title </span></h2>
            <p>간략한 설명을 입력해 주세요. <a href="https://fontawesome.com/v4.7.0/icons/">fontawesome</a>에서 원하시는 아이콘으로 변경해주세요 </p>
            <a href="">자세히보기</a>
        </li>
        <li>
            <h2><i class="fa fa-briefcase"></i><span>Short title </span></h2>
            <p>간략한 설명을 입력해 주세요.<a href="https://fontawesome.com/v4.7.0/icons/">fontawesome</a>에서 원하시는 아이콘으로 변경해주세요 </p>
            <a href="">자세히보기</a>
        </li>   
         <li>
            <h2><i class="fa fa-briefcase"></i><span>Short title </span></h2>
            <p>간략한 설명을 입력해 주세요.<a href="https://fontawesome.com/v4.7.0/icons/">fontawesome</a>에서 원하시는 아이콘으로 변경해주세요 </p>
            <a href="">자세히보기</a>
        </li>   
    </ul>
</div>

<!-- 갤러리 최신글 -->
<?php
// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
// 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
echo latest('theme/gallery', 'work', 6, 33);
?>




<!-- 뉴스 최신글 -->
<?php
// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
// 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
echo latest('theme/news', 'news', 4, 33);
?>


<!--  최신글 -->
<div class="idx_lt">
    <div class="idx_lt_wr">
        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest('theme/basic', 'notice', 4, 33);
        ?>

        <?php
        // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
        // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
        // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
        echo latest('theme/basic', 'free', 4, 33);
        ?>

        <?php echo poll('theme/basic'); // 설문조사, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>

    </div>
</div>

<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>