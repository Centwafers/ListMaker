var serverAdress = 'http://listmaker-stkl.esy.es/';
document.addEventListener("deviceready", onDeviceReady, false);

function onDeviceReady() {
    document.addEventListener("backbutton", function(e) {
        if ($.mobile.activePage.is('#home') || $.mobile.activePage.is('#connection')) {
            e.preventDefault();
            navigator.app.exitApp();
        } else {
            window.location.replace("home.html");
        }
    }, false);
}

var storage = window.localStorage;
if (storage.getItem("connected") == 1 && (storage.getItem("session") != undefined && storage.getItem("session") != 0)) {
    var name = storage.getItem("name");
    var hashSession = storage.getItem("session");
    $(document).ajaxStart(function() {
        $.mobile.loading('show');
    });

    $(document).ajaxStop(function() {
        $.mobile.loading('hide');
    });
    $(document).on("pagebeforeshow", "#home", function(event) {
        //hashSession = "03b7f2c1d27fc3f8d45864e272a1649d";
        loadList();
    });

    function error() {
        alert("Probleme de connexion veuillez relancer l'application");
        storage.setItem("connected", 0);
        storage.setItem("session", 0);
        navigator.app.exitApp();
    }

    function loadList() {
        $('input[data-type="search"]').val("");
        $('input[data-type="search"]').trigger("keyup");
        $("#listContent").empty();
        var file = 'productList.php';
        jQuery.ajax({
            url: serverAdress + file,
            data: 'hashSession=' + hashSession,
            datatype: 'json',
            async: false,
            type: "GET",
            error: function(xhr, statusText) {
                error();
            },
            success: function(data) {
                var obj = $.parseJSON(data);
                $.each(obj, function(i, item) {
                    $("#listContent").append("<li id=\"" + item.idProduct + "\" ><a class=\"detail\" href=\"#\" data-transition=\"pop\" ><img src=\"" + serverAdress + "img/productPicture/" + item.image + "\"><h2 class=\"topic\">" + item.nameProduct + "</h2><p>Ajouté par " + item.addedBy + "</p><span class=\"ui-li-count\">" + item.quantity + "</span></a><a href=\"#\" data-icon=\"delete\">Supprimer</a></li>");
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
        var file = 'productDetail.php';
        jQuery.ajax({
            url: serverAdress + file,
            data: 'idProduct=' + id,
            datatype: 'jsonp',
            type: "GET",
            error: function(xhr, statusText) {
                error();
            },
            success: function(data) {
				if (data.length == 0 ) {
					alert("Ce produit n'existe pas");
					$.mobile.changePage("#home", {
                    transition: "slideup",
                    changeHash: false
                });
				}else{
					var obj = $.parseJSON(data);
                $("#productDetail #idProduct").html(obj.idProduct);
                $("#productDetail #nameProductDetail").html(obj.nameProduct);
                if (obj.addedBy != undefined) {
                    $("#productDetail #addedByProductDetail").text("Ajouté par " + obj.addedBy);
                }
                $("#productDetail #imageProductDetail").attr("src", serverAdress + "/img/productPicture/" + obj.image).attr("width", 100).attr("height", 100);
                $.mobile.changePage("#productDetail", {
                    transition: "slideup",
                    changeHash: false
                });
				}
                
            }
        });


    }

    function deleteProduct(id) {
        var file = 'deleteProduct.php';
        jQuery.ajax({
            url: serverAdress + file,
            data: 'hashSession=' + hashSession + '&idProduct=' + id,
            datatype: 'jsonp',
            type: "GET",
            error: function(xhr, statusText) {
                error();
            },
            success: function(data) {
                loadList();
            }
        });

    }
    $(document).on("pagecreate", "#productDetail", function(event) {
        $("#productDetail #idProduct").hide();
        $("#valid").bind("click", function(event, ui) {
            var file = 'addProduct.php';
            jQuery.ajax({
                url: serverAdress + file,
                data: 'idProduct=' + $("#productDetail #idProduct").text() + "&hashSession=" + hashSession + "&quantity=" + $("#quantityProductDetail").val() + "&addedBy=" + name,
                datatype: 'text',
                type: "GET",
                error: function(xhr, statusText) {
                    error();
                },
                success: function(data) {
                    loadList();
                    $.mobile.changePage("#home", {
                        transition: "none",
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
                        loadDetails(result.text);
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
};
