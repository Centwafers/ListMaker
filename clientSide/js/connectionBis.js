
document.addEventListener("deviceready", onDeviceReady, false);
function onDeviceReady(){
    document.addEventListener("backbutton", function(e){
       if($.mobile.activePage.is('connection.html') || $.mobile.activePage.is('#connection')){
           e.preventDefault();
           navigator.app.exitApp();
       }
       else {
           window.location.replace("home.html");
       }
    }, false);
}
$(document).ready(function(){

var storage = window.localStorage;

if(storage.getItem("connected")==1 && (storage.getItem("session")!=undefined && storage.getItem("session")!=0)){
  window.location.replace("home.html");
}
else
{
	$("#connectionBtn").click(function(){
	var serverAdress = 'http://listmaker-stkl.esy.es/';
    var file = 'connection.php';

    var username = $("#username").val();
    var listName = $("#listName").val();
    var password = $.md5($("#password").val());

    if((username.length===0)||(listName.length===0)){
      ConnectionErrorAnimation();
    }
    else{
      var get_fail = 'fail';

      $.post(serverAdress+file,
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
		  storage = window.localStorage;
          storage.setItem("connected", 1);
	      storage.setItem("session", data);
		  storage.setItem("name", username);
		  
          window.location.replace("home.html");
        }
      });
      return false; //pour que le formulaire ne se recharge pas !
    }
});
}

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
