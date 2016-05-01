document.getElementById("creationBtn").onclick = function blockForm() {
    console.log("mmm");
    var listName = document.getElementById("listNameCreation").value;
    var password = document.getElementById('passwordCreation').value; // à sécuriser : voir si on fait HTTPS ou Sécurité côté client.
    var password2 = document.getElementById('password2Creation').value;

    var serverAdress = 'http://listmaker-stkl.esy.es/';
    var file = 'creationList.php';

    if (listName.length === 0) {
        creationErrorAnimation("Champ vide");
        // return alert("Veuillez entrer le nom de votre liste");
    } else if (listName.length < 3) {
        creationErrorAnimation("Nom trop court");
        // return alert("Le nom de la liste doit comporter au moins 3 caractères");
    } else if (password.length === 0) {
        creationErrorAnimation("Champ vide");
        // return alert("Veuillez entrer votre mot de passe");
    } else if (password.length < 3) {
        creationErrorAnimation("Mot de passe trop court");
        // return alert("Votre mot de passe est beaucoup trop court"); // à modifier si MD5 côté client
    } else if (!(password == password2)) {
        creationErrorAnimation("Mots de passe différents");
        // return alert("Les deux mots de passes ne correspondent pas");
    } else {

        var get_success = 'success';

        $.ajax({
            url: serverAdress + file,
            type: 'POST',
            data: "listName=" + listName + "&password=" + password + "&password2=" + password2,
            dataType: 'HTML', // text ou JSON, à voir
            success: function(resultat, statut) {
                if (resultat == get_success) {
                    creationSuccessAnimation();
                    // alert("Votre liste a bien été enregistrée");
                    document.location.href = "connection.html";
                } else {
                    creationErrorAnimation("Cette liste existe déjà");
                    //alert(resultat);
                }
            },
            error: function(resultat, statut, erreur) {
                creationErrorAnimation("Une erreur est survenue");
                error();
                //alert(erreur);
            }
        });
    }
}

function error() {
    alert("Probleme de connexion veuillez relancer l'application");
    storage.setItem("connected", 0);
    storage.setItem("session", 0);
    navigator.app.exitApp();
}

function creationErrorAnimation(msg) {
    $("#errorCreationMsg").text(msg);
    $("#errorCreationMsg").css("visibility", "visible");

    var btn = $("#creationBtn");
    var icon = $("#creationBtnText");
    var blue = "#5CBCF6";
    var red = "#FF3333";

    btn.animate({
        backgroundColor: red,
        borderColor: red
    }, 250);

    for (i = 0; i < 3; i++) {
        btn.animate({
            left: '-5%'
        }, 50);
        btn.animate({
            left: '5%'
        }, 50);
    }

    btn.animate({
        left: '0%'
    }, 25);
    btn.animate({
        backgroundColor: blue,
        borderColor: blue
    }, 250);

    window.setTimeout(hideCreationErrorMsg, 2500);
}

function creationSuccessAnimation() {
    var btn = $("#creationBtn");
    var icon = $("#creationBtnText");
    var green = "#47d147";

    icon.text("");
    icon.addClass("fa fa-check");

    btn.animate({
        backgroundColor: green,
        borderColor: green
    }, 250);
}

function hideCreationErrorMsg() {
    $("#errorCreationMsg").css("visibility", "hidden");
}