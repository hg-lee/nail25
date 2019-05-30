// 전체 선택, 개별 선택 체크박스 이미지와 실제 체크박스 체크되도록
$(document).ready(function(){
    $(".all_chk label").click(function(){
        $(this).toggleClass("click_on");

        if($(this).hasClass("click_on")) {
            $(".li_chk input[type=checkbox]").prop('checked', true);
            $(".li_chk label").addClass("click_on");
        } else {
            $(".li_chk input[type=checkbox]").prop('checked', false);
            $(".li_chk label").removeClass("click_on");
        }
    });
    $(".li_chk label").click(function(){
        $(this).toggleClass("click_on");

        var is_all = 1;
        $(".li_chk label").each(function(){
            if(!$(this).hasClass("click_on")) {
                is_all = 0;
            }
        });

        if(is_all) {
            $(".all_chk label").addClass("click_on");
        } else {
            $(".all_chk label").removeClass("click_on");
        }
    });
});




