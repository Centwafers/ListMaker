var site = 'http://listmaker-stkl.esy.es/';

var storage = window.localStorage;
var name = storage.getItem("name");
var hashSession = storage.getItem("session");
$(document).on("pagecreate", "#home", function(event) {
    //hashSession = "03b7f2c1d27fc3f8d45864e272a1649d";
  
	loadList();

});
function loadList(){
	$("#listContent").empty();
	var dossier = 'productList.php';
	jQuery.ajax({
        url: site + dossier,
        data: 'hashSession=' + hashSession,
        datatype: 'json',
        async: false,
        type: "GET",
        error: function(xhr, statusText) {
            alert("Error: " + statusText);
        },
        success: function(data) {
            var obj = $.parseJSON(data);
            $.each(obj, function(i, item) {
                $("#listContent").append("<li id=\"" + item.idProduct + "\" ><a class=\"detail\" href=\"#\" data-transition=\"pop\" ><img src=\"" + site + "/img/productPicture/" + item.image + "\"><h2 class=\"topic\">" + item.nameProduct + "</h2><p>Ajouté par " + item.addedBy + "</p><span class=\"ui-li-count\">" + item.quantity + "</span></a><a href=\"#\" data-icon=\"delete\">Supprimer</a></li>");
                $('#listContent li:last a:first').bind("click", function(event, ui) {
                    loadDetails(item.idProduct);
                });
				$('#listContent a:last').bind("click", function(event, ui) {
                    deleteProduct(item.idProduct);
                });
                $("#listContent").listview('refresh');
            });
        }
    });
}
function loadDetails(id) {
	    var dossier = 'productDetail.php';
			jQuery.ajax({
	        url: site+dossier,
	        data: 'idProduct='+id,
	        datatype: 'jsonp',
	        type: "GET",
	        success: function(data) {
	            var obj = $.parseJSON(data);
				$("#productDetail #idProduct").html(obj.idProduct);
	            $("#productDetail #nameProductDetail").html(obj.nameProduct);
				if(obj.addedBy!=undefined){   $("#productDetail #addedByProductDetail").text("Ajouté par "+obj.addedBy);}
	         
	            $("#productDetail #imageProductDetail").attr("src", site + "/img/productPicture/" + obj.image).attr("width", 100).attr("height", 100);
	        }
	    });
		$.mobile.changePage( "#productDetail", { transition: "slideup", changeHash: false });
	}
function deleteProduct(id) {
	    var dossier = 'deleteProduct.php';
			jQuery.ajax({
	        url: site+dossier,
	        data: 'hashSession='+hashSession+'&idProduct='+id,
	        datatype: 'jsonp',
	        type: "GET",
	        success: function(data) {	
				loadList();
	        }
	    });
		
	}
$(document).on("pagecreate", "#productDetail", function(event) {
	$("#productDetail #idProduct").hide();
    $("#valid").bind("click", function(event, ui) {
        var dossier = 'addProduct.php';
        jQuery.ajax({
            url: site + dossier,
            data: 'idProduct=' + $("#productDetail #idProduct").text() + "&hashSession=" + hashSession + "&quantity=" + $("#quantityProductDetail").val() + "&addedBy=" + name,
            datatype: 'text',
            type: "GET",
            success: function(data) {
				loadList();
               $.mobile.changePage("#home", {
                        transition: "slidedown",
                        changeHash: false
                    });
					
            }
        });
    });
});

$(document).on("pagecreate", "#barCodeScan", function(event) {
    $('#btnValidScan').hide();
    $("#scan").bind("click", function(event, ui) {
        cordova.plugins.barcodeScanner.scan(
            function(result) {
                if (!result.cancelled) {
                    alert(result);
                    loadDetails(10);
                    $.mobile.changePage("#productDetail", {
                        transition: "fade",
                        changeHash: false
                    });
                } else {
                    alert("Le scan a été annulé");
                }
            },
            function(error) {
                alert("Le scan a échoué: " + error);
            }
        );
    });
});