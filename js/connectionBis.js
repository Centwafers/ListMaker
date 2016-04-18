$(document).ready(function(){

  $("#connectionBtn").click(function(){
    var site = 'http://listmaker-stkl.esy.es/';
    var dossier = 'connection.php';

    var username = $("#username").val();
    var listName = $("#listName").val();
    var password = $.md5($("#password").val()); //le mdp ne doit jamais passer en clair sur le réseau

    if((username.length===0)||(listName.length===0)){
        errorAnimation("#connectionBtn");
    }else{
      var get_fail = 'fail';

      $.post(site+dossier,
      {
          listName: listName,
          password: password
      },
      function(data, status){
          if(data == get_fail){
           errorAnimation("#connectionBtn");
          }else{
            successAnimation("#connectionBtn");
            var storage = window.localStorage;
		      	storage.setItem("Session", data);
            document.location.href="home.html";
          }
      });
      return false; //pour que le formulaire ne se recharge pas !
    }
  });

});
