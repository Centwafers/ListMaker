$(document).ready(function(){

  $("#connexion-btn").click(function(){
    var site = 'http://listmaker-stkl.esy.es/';
    var dossier = 'connexion.php';

    var username = $("#username").val();
    var listName = $("#list-name").val();
    var password = $.md5($("#password").val()); //le mdp ne doit jamais passer en clair sur le réseau

    if((username.length===0)||(listName.length===0)){
        errorAnimation("#connexion-btn");
    }else{
      var get_success = 'success';

      $.post(site+dossier,
      {
          listName: listName,
          password: password
      },
      function(data, status){
          if(data == get_success){
            document.location.href="home.html";
          }else{
            errorAnimation("#connexion-btn");
          }
      });
      return false; //pour que le formulaire ne se recharge pas !
    }
  });

  function errorAnimation(elemID){
      var elem = $(elemID);

      for (i = 0; i < 3; i++) {
          elem.animate({left: '-5%'}, 50);
          elem.animate({left: '5%'}, 50);
      }

      elem.animate({left: '0%'}, 25);
  }

});
