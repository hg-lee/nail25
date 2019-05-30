<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<div class="register">
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js?v=<?php echo G5_JS_VER; ?>"></script>
    <?php } ?>

    <form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="agree" value="<?php echo $agree ?>">
    <input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">
    <?php if (isset($member['mb_sex'])) { ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php } ?>
    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면 ?>
    <input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
    <input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
    <?php } ?>
    <?php @include_once(get_social_skin_path().'/social_register.skin.php'); // 소셜로그인 사용시 소셜로그인 버튼 ?>
    <div class="form_01">
        <h2>사이트 이용정보 입력</h2>
        <ul>
        	<li>
	            <label for="reg_mb_name" class="sound_only">이름<strong>필수</strong></label>
	           <input type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="frm_input full_input <?php echo $required ?> <?php echo $readonly ?>" placeholder="이름">
	        </li>
	        <li>
	            <label for="reg_mb_id" class="sound_only">아이디<strong>필수</strong></label>
	            <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" class="frm_input full_input <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="20" <?php echo $required ?> <?php echo $readonly ?> placeholder="아이디">
	            <span id="msg_mb_id"></span>
	            <span class="frm_info">이메일 형식으로 입력하세요.</span>
	        </li>
	        <li>
	            <label for="reg_mb_password" class="sound_only">비밀번호<strong>필수</strong></label>
	            <input type="password" name="mb_password" id="reg_mb_password" class="frm_input full_input <?php echo $required ?>" minlength="3" maxlength="20" <?php echo $required ?> placeholder="비밀번호">
	        </li>
	        <li>
	            <label for="reg_mb_password_re" class="sound_only">비밀번호 확인<strong>필수</strong></label>
	            <input type="password" name="mb_password_re" id="reg_mb_password_re" class="frm_input full_input <?php echo $required ?>" minlength="3" maxlength="20" <?php echo $required ?>  placeholder="비밀번호확인">
	        </li>
        </ul>
    </div>

    <div class="form_01">
        
    </div>

    <div class="form_01">
    	<?php @include_once(get_social_skin_path().'/social_register.skin.php'); // 소셜로그인 사용시 소셜로그인 버튼 ?>
    </div>

    <div class="btn_top top">
        <a href="<?php echo G5_URL; ?>/" class="btn_cancel">취소</a>
        <input type="submit" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" id="btn_submit" class="btn_submit" accesskey="s">
    </div>
    </form>

    <script>
    $(function() {
        $("#reg_zip_find").css("display", "inline-block");

        <?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
        // 아이핀인증
        $("#win_ipin_cert").click(function() {
            if(!cert_confirm())
                return false;

            var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
            certify_win_open('kcb-ipin', url);
            return;
        });

        <?php } ?>
        <?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
        // 휴대폰인증
        $("#win_hp_cert").click(function() {
            if(!cert_confirm())
                return false;

            <?php
            switch($config['cf_cert_hp']) {
                case 'kcb':
                    $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                    $cert_type = 'kcb-hp';
                    break;
                case 'kcp':
                    $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                    $cert_type = 'kcp-hp';
                    break;
                default:
                    echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                    echo 'return false;';
                    break;
            }
            ?>

            certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
            return;
        });
        <?php } ?>
    });

    // 인증체크
    function cert_confirm()
    {
        var val = document.fregisterform.cert_type.value;
        var type;

        switch(val) {
            case "ipin":
                type = "아이핀";
                break;
            case "hp":
                type = "휴대폰";
                break;
            default:
                return true;
        }

        if(confirm("이미 "+type+"으로 본인확인을 완료하셨습니다.\n\n이전 인증을 취소하고 다시 인증하시겠습니까?"))
            return true;
        else
            return false;
    }

    // submit 최종 폼체크
    function fregisterform_submit(f)
    {
        // 회원아이디 검사
        if (f.w.value == "") {
            var msg = reg_mb_id_check();
            if (msg) {
                alert(msg);
                f.mb_id.select();
                return false;
            }
        }

        if (f.w.value == '') {
            if (f.mb_password.value.length < 3) {
                alert('비밀번호를 3글자 이상 입력하십시오.');
                f.mb_password.focus();
                return false;
            }
        }

        if (f.mb_password.value != f.mb_password_re.value) {
            alert('비밀번호가 같지 않습니다.');
            f.mb_password_re.focus();
            return false;
        }

        if (f.mb_password.value.length > 0) {
            if (f.mb_password_re.value.length < 3) {
                alert('비밀번호를 3글자 이상 입력하십시오.');
                f.mb_password_re.focus();
                return false;
            }
        }

        // 이름 검사
        if (f.w.value=='') {
            if (f.mb_name.value.length < 1) {
                alert('이름을 입력하십시오.');
                f.mb_name.focus();
                return false;
            }
        }

        <?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
        // 본인확인 체크
        if(f.cert_no.value=="") {
            alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
            return false;
        }
        <?php } ?>

        // 닉네임 검사
        /*
        if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
            var msg = reg_mb_nick_check();
            if (msg) {
                alert(msg);
                f.reg_mb_nick.select();
                return false;
            }
        }

        // E-mail 검사
        if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
            var msg = reg_mb_email_check();
            if (msg) {
                alert(msg);
                f.reg_mb_email.select();
                return false;
            }
        }
        */

        <?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
        // 휴대폰번호 체크
        var msg = reg_mb_hp_check();
        if (msg) {
            alert(msg);
            f.reg_mb_hp.select();
            return false;
        }
        <?php } ?>

        if (typeof f.mb_icon != "undefined") {
            if (f.mb_icon.value) {
                if (!f.mb_icon.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
                    alert("회원아이콘이 이미지 파일이 아닙니다.");
                    f.mb_icon.focus();
                    return false;
                }
            }
        }

        if (typeof f.mb_img != "undefined") {
            if (f.mb_img.value) {
                if (!f.mb_img.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
                    alert("회원이미지가 이미지 파일이 아닙니다.");
                    f.mb_img.focus();
                    return false;
                }
            }
        }

        if (typeof(f.mb_recommend) != 'undefined' && f.mb_recommend.value) {
            if (f.mb_id.value == f.mb_recommend.value) {
                alert('본인을 추천할 수 없습니다.');
                f.mb_recommend.focus();
                return false;
            }

            var msg = reg_mb_recommend_check();
            if (msg) {
                alert(msg);
                f.mb_recommend.select();
                return false;
            }
        }

        <?//php echo chk_captcha_js(); ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</div>