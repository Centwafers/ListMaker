$(document).ready(function(){
var serverAdress = 'http://listmaker-stkl.esy.es/';
var file = 'productDetail.php';
var storage = window.localStorage;
jQuery.ajax(
	{
		url: serverAdress+file,
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
