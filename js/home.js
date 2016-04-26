$(document).ready(function(){
	var site = 'http://listmaker-stkl.esy.es/';
    var dossier = 'productList.php';
	var storage = window.localStorage;
	var nom = storage.getItem("nom");
	//hashSession = storage.getItem("session");
	hashSession="03b7f2c1d27fc3f8d45864e272a1649d";
	jQuery.ajax(
	{
		url: site+dossier,
		data:'hashSession='+hashSession,
		type: "GET",
		success:function(data){
			console.log(data);
			var results = jQuery.parseJSON(data);
			/*	$(results).each(function(key, value) {
					console.log(value.idProduct +' '+value.nameProduct);
				})*/
			
		}
	});
	
	//$("#listContent").append('<li><a href="#product-detail" data-transition="pop"><img src="./img/productPicture/bread.png"><h2>Pain</h2><p>Ajouté par Bruce</p><span class="ui-li-count">2</span></a><a href="#" data-icon="star">Ajouter aux favoris</a></li>').listview('refresh');;
});
