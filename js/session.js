$(document).ready(function(){
var storage = window.localStorage;
if(storage.getItem("connected")==1){
$("#footer").append('<a href="#" id="disconnect" class="ui-btn ui-corner-all ui-icon-power ui-btn-icon-notext ui-nodisc-icon ui-alt-icon">Se déconnecter</a>');
}

 $("#disconnect").click(function(){
storage.setItem("connected",0);
storage.setItem("session",0);
window.location.replace("connection.html");
});


});
