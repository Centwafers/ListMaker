var MIN_LENGTH = 2;
var site = 'http://listmaker-stkl.esy.es/';
$(document).on("pageinit", "#home", function() {
            $("#autocomplete").on("filterablebeforefilter", function(e, data) {
                var $ul = $(this),
                    $input = $(data.input),
                    value = $input.val(),
                    html = "";
                $ul.html("");
                if (value && value.length > 2) {
                    $ul.html("<li><div class='ui-loader'><span class='ui-icon ui-icon-loading'></span></div></li>");
                    $ul.listview("refresh");
                    $.ajax({
                            url: site + "autocomplete.php",
                            dataType: "json",
                            crossDomain: true,
                            data: {
                                keyword: $input.val()
                            }
                        })
                        .then(function(response) {
                            $.each(response, function(i, val) {
                                console.log(val);
                                html += "<li><a class=\"detail\" href=\"#\" data-transition=\"pop\" rel=\"external\" onclick=\"loadDetails(" + val.idProduct + ");\">" + val.nameProduct + "</a></li>";
                            });
                            $ul.html(html);
                            $ul.listview("refresh");
                            $ul.trigger("updatelayout");
                        });
                }
            });
            
});
