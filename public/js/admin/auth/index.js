// JavaScript Document
function popup(popupName){
    var windowWidth = $(window).width(),
        windowHeight = $(window).height(),
        popupHeight = $(popupName).height(),
        popupWidth = $(popupName).width(),
        _posiTop = (windowHeight - popupHeight)/2,
        _posiLeft = (windowWidth - popupWidth)/2;
    if(windowHeight>popupHeight){
        $(popupName).css({"left": _posiLeft + "px","top":_posiTop + "px","bottom":""});
    }else{
        $(popupName).css({"left": _posiLeft + "px","top":"5px","bottom":"5px","overflow":"auto"});
    };
};
function showDiv(popupName){
    $(popupName).fadeIn();
    $(".fade").fadeIn();
    popup(popupName);
    $(window).resize(function(){
        popup(popupName);
    });
};
popup('#login');
$(".alert-close").on("click",function(){
    $(".fade").fadeOut();
    $(this).parents(".alert").fadeOut();
});
$(".way-choice").on("click",function(){
    showDiv($("#rent-num"));
});
$(".sign-btn").on("click",function(){
    $("#register").hide();
    showDiv($("#sign-tip"));
});

$(".news-right a").on("click",function(){
    showDiv($("#notice1"));
    setTimeout(function(){
        $("#notice1,.fade").fadeOut();
    }, 1500);
});
$(".cancel-order").on("click",function(){
    showDiv($("#remove"));
});



//文本框提示
$(".default-input").focus(function(){
    $(this).siblings(".default-text").hide();
});
$(".default-text").on("click",function(){
    $(this).hide().siblings(".default-input").focus();
});
$(".default-input").blur(function(){
    var value=$(this).val();
    if(value==""){
        $(this).siblings(".default-text").show();
    }else{
        $(this).siblings(".default-text").hide();
    }
});

$(document).ready(function () {
    if($(".default-input").val()){
        $(".default-input").siblings(".default-text").show();
    } else {
        $(".default-input").siblings(".default-text").hide();
    }
})


