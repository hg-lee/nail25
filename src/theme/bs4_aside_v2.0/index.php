<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.php');
include_once(G5_THEME_PATH.'/aside.php');
?>

<?php if (!defined("_INDEX_")) { ?><h2 id="container_title"><span title="<?php echo get_text($g5['title']); ?>"><?php echo get_head_title($g5['title']); ?></span></h2><?php } ?>

        <!-- Three columns of text with circle imagel -->
        <div class="row box_circle">
          <div class="col-lg-4">
            <img class="rounded-circle" src="<?php echo G5_THEME_URL ?>/asset/images/main/circle_1.png" alt="Generic placeholder image" width="140" height="140">
            <p><h4>제목 1</h4></p>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="<?php echo G5_THEME_URL ?>/asset/images/main/circle_2.png" alt="Generic placeholder image" width="140" height="140">
            <p><h4>제목 2</h4></p>
            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="<?php echo G5_THEME_URL ?>/asset/images/main/circle_3.png" alt="Generic placeholder image" width="140" height="140">
            <p><h4>제목 3</h4></p>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->

	<hr class="featurette-divider">

      <!-- 최신글 Section -->
      <div class="row mb-4">
	    <div class="col-lg-5 mb-4">
		<!-- 최신글 1 시작 { -->
				<?php
				// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
				// 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
				// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
				// echo latest('theme/basic', $row['bo_table'], 7, 24);
				// 글자수는 자동 제한이 되므로 0으로 지정
				echo latest('theme/basic', 'list', 6, 0);
        		?>
		<!-- } 최신글 1 끝 -->
        </div>
        <div class="col-lg-7 mb-4">
		<!--  사진 최신글2 { -->
			<?php
			// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
			// 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
			// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
			echo latest('theme/pic_basic', 'gallery', 4, 23);
    		?>
			<!-- } 사진 최신글2 끝 -->
        </div>
      </div>
      <!-- /.row -->
	      
      <div class="row mb-4">
	    <div class="col-lg-5 mb-4">
		<!-- 최신글 1 시작 { -->
				<?php
				// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
				// 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
				// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
				// echo latest('theme/basic', $row['bo_table'], 7, 24);
				// 글자수는 자동 제한이 되므로 0으로 지정
				echo latest('theme/basic', 'list', 7, 0);
        		?>
		<!-- } 최신글 1 끝 -->
        </div>
        <div class="col-lg-7 mb-4">
		<!--  웹진 최신글2 { -->
			<?php
			// 이 함수가 바로 최신글을 추출하는 역할을 합니다.
			// 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
			// 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
			echo latest('theme/webzine_basic', 'webzine', 2, 0);
    		?>
			<!-- } 웹진 최신글2 끝 -->
        </div>
      </div>
      <!-- /.row -->

<!-- Main Parallax Section -->
<div class="jumbotron paral_main paralsec_main">
<h1 class="display-3">Here is a heading</h1>
<p class="lead">Here is a short description</p>
<p class="lead">
<a class="btn btn-info btn-lg btn-md" href="#" role="button">Here is a button</a>
</p>
</div>
   
      <!-- Marketing Icons Section -->
      <div class="row mt-4">
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header">카드 제목 1</h4>
            <div class="card-body">
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-outline-primary">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header">카드 제목 2</h4>
            <div class="card-body">
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis ipsam eos, nam perspiciatis natus commodi similique totam consectetur praesentium molestiae atque exercitationem ut consequuntur, sed eveniet, magni nostrum sint fuga.</p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-outline-primary">Learn More</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header">카드 제목 3</h4>
            <div class="card-body">
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-outline-primary">Learn More</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
 
 </div>
 </div>
      
<?php
include_once(G5_THEME_PATH.'/tail.php');
?>
