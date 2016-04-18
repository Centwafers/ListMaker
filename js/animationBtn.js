function errorAnimation(elemID){
  var elem = $(elemID);
  var blue = "#5CBCF6";
  var red = "#FF3333"

  elem.animate({backgroundColor: red, borderColor: red}, 250);

  for (i = 0; i < 3; i++) {
      elem.animate({left: '-5%'}, 50);
      elem.animate({left: '5%'}, 50);
  }

  elem.animate({left: '0%'}, 25);
  elem.animate({backgroundColor: blue, borderColor: blue}, 250);
}

function successAnimation(elemID){
  var elem = $(elemID);
  var green = "#47d147"

  elem.animate({backgroundColor: green, borderColor: green}, 250);
  elem.find("span").text("");
  elem.find("span").addClass("fa fa-shopping-cart");
}
