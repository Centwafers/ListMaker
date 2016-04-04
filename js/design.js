$(function(){

    $("#connexion-btn").click(function(){
        //errorAnimation("#connexion-btn");
        //successAnimation("#connexion-text");
    });

    function errorAnimation(elemID){
        var elem = $(elemID);

        for (i = 0; i < 3; i++) {
            elem.animate({left: '-5%'}, 50);
            elem.animate({left: '5%'}, 50);
        }

        elem.animate({left: '0%'}, 25);
    }

    function successAnimation(elemID){
        var elem = $(elemID);
        elem.text("");
        elem.addClass("fa fa-shopping-cart");
    }
});
