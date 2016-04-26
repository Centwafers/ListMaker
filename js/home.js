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
		dataType: 'json',
		type: "GET",
		success:function(data){
			console.log(data);
			var productL;
			 for (var i = 0; i < data.length; i++) {
					productL = $('<li><a href="#product-detail" data-transition="pop"><img src="./img/productPicture/bread.png">');
					productL.append("<h2>"+data[i].nameProduct+"</h2>");
					productL.append("<p>"+data[i].addedBy+"</p>");
					productL.append('<span class="ui-li-count">2</span></a><a href="#" data-icon="star">Ajouter aux favoris</a></li>');
					$('#listContent').append(productL);
		    }
				$('#listContent').listview('refresh');
		}
	});
	
	//$("#listContent").append('<li><a href="#product-detail" data-transition="pop"><img src="./img/productPicture/bread.png"><h2>Pain</h2><p>Ajouté par Bruce</p><span class="ui-li-count">2</span></a><a href="#" data-icon="star">Ajouter aux favoris</a></li>').listview('refresh');;
});
