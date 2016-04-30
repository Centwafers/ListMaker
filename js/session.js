$(document).ready(function(){
var storage = window.localStorage;
if(storage.getItem("connected")==1 && (storage.getItem("session")!=undefined && storage.getItem("session")!=0)){
$("#footer").append('<a href="#" id="disconnect" class="ui-btn ui-corner-all ui-icon-power ui-btn-icon-notext ui-nodisc-icon ui-alt-icon">Se déconnecter</a>');
}else{
	window.location.replace("connection.html");
}

 $("#disconnect").click(function(){
storage.setItem("connected",0);
storage.setItem("session",0);
window.location.replace("connection.html");
});


});
