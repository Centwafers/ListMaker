$(document).ready(function(){

  $("#connectionBtn").click(function(){
    var site = 'http://listmaker-stkl.esy.es/';
    var dossier = 'connection.php';

    var username = $("#username").val();
    var listName = $("#listName").val();
    var password = $.md5($("#password").val());

    if((username.length===0)||(listName.length===0)){
      ConnectionErrorAnimation();
    }
    else{
      var get_fail = 'fail';

      $.post(site+dossier,
      {
        listName: listName,
        password: password
      },
      function(data, status){
        if(data == get_fail){
         ConnectionErrorAnimation();
        }
        else{
          ConnectionSuccessAnimation();
          var storage = window.localStorage;
	      	storage.setItem("Session", data);
          document.location.href="home.html";
        }
      });
      return false; //pour que le formulaire ne se recharge pas !
    }
  });

  function ConnectionErrorAnimation(btnID){
    var btn = $("#connectionBtn");
    var blue = "#5CBCF6";
    var red = "#FF3333";

    btn.animate({backgroundColor: red, borderColor: red}, 250);

    for (i = 0; i < 3; i++) {
      btn.animate({left: '-5%'}, 50);
      btn.animate({left: '5%'}, 50);
    }

    btn.animate({left: '0%'}, 25);
    btn.animate({backgroundColor: blue, borderColor: blue}, 250);
  }

  function ConnectionSuccessAnimation(btnID){
    var btn = $("#connectionBtn");
    var icon = $("#connectionBtnText");
    var green = "#47d147";

    btn.animate({backgroundColor: green, borderColor: green}, 250);
    icon.text("");
    icon.addClass("fa fa-shopping-cart");
  }

});
