// JavaScript Document
$(document).ready(function($){
    var $showPic =$('#bannerList li');
    var $btonBox=$('#bannerBton');
    var _n=0;
    var _vt=3000;
    var _vf=1000;
    var timer;
    //鐢熸垚瑙掓爣
    for(i=1;i<=$showPic.length;i++){
        $btonBox.append('<li></li>');
    }
    var $btonList=$btonBox.children('li');
    //榧犳爣浜嬩欢
    $btonList.each(function(e){
        $(this).hover(function(){
            clearInterval(timer);
            showImg(e);
            _n=e;
        },function(){
            timer = setInterval(auto,_vt);
        });
    });
    //鍥剧墖杞崲
    var showImg= function(n){
        $showPic.stop(true,true).eq(n).fadeIn(_vf).siblings().fadeOut(_vf);
        $btonList.eq(n).addClass('up').siblings().removeClass('up');
    }
    //鑷姩鎾斁
    var auto=function(){
        showImg(_n);
        _n++
        if(_n == $showPic.length){_n=0;}
    }
    timer = setInterval(auto,_vt);
    showImg(_n);
    _n++;
});
