$(document).ready(function(){
	var site = 'http://listmaker-stkl.esy.es/';
    var dossier = 'productListTest.php';
	var storage = window.localStorage;
	var nom = storage.getItem("nom");
	//hashSession = storage.getItem("session");
	hashSession="03b7f2c1d27fc3f8d45864e272a1649d";
	jQuery.ajax(
	{
		url: site+dossier,
		data:'hashSession='+hashSession,
		datatype : 'json',
		type: "GET",
		success:function(data){
			var obj = $.parseJSON(data);
			console.log(obj)
			var productL;
			$.each(obj, function(i, item) {
				$("#listContent").append("<li><a href=\"#product-detail\" data-transition=\"pop\"><img src=\"./img/productPicture/bread.png\"><h2>"+item.nameProduct+"</h2><p>Ajouté par "+item.addedBy+"</p><span class=\"ui-li-count\">"+item.quantity+"</span></a><a href=\"#\" data-icon=\"star\">Ajouter aux favoris</a></li>").listview('refresh');
				});
		}
	});
	
	//$("#listContent").append('<li><a href="#product-detail" data-transition="pop"><img src="./img/productPicture/bread.png"><h2>Pain</h2><p>Ajouté par Bruce</p><span class="ui-li-count">2</span></a><a href="#" data-icon="star">Ajouter aux favoris</a></li>').listview('refresh');;
});
