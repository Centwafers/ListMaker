$(document).ready(function(){
var serverAdress = 'https://52.37.194.80/';
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
