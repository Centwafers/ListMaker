$(document).ready(function(){
var site = 'http://listmaker-stkl.esy.es/';
var dossier = 'productDetail.php';
var storage = window.localStorage;
jQuery.ajax(
	{
		url: site+dossier,
		data:'idProduct='+storage.getItem("idProduct"),
		datatype : 'json',
		type: "GET",
		success:function(data){
			var obj = $.parseJSON(data);
			$.each(obj, function(i, item) {
				$("#addedBy").append(item.idProduct).listview('refresh');
				});
		}
	});
});
