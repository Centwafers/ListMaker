
document.getElementById("connexion-btn").onclick = function blockForm(){

    var username = document.getElementById("username").value;
    var listName = document.getElementById("listName").value;
    var password = window.md5(document.getElementById('password').value); //le mdp ne doit jamais passer en clair sur le réseau

    var serverAdress = 'https://52.37.194.80/';
    var file = 'connexion.php';

    if(username.length===0)
    {
        return alert("Veuillez entrer un nom d'utilisateur");
    }
    else if (listName.length===0)
    {
        return alert("Veuillez entrer le nom de votre liste");
    }
    else if (password.length===0) //inutile: le md5 d'une chaine vide n'est jamais vide
    {
        return alert("Veuillez entrer votre mot de passe");
    }
    else
    {
        var get_success = 'success';

        $.ajax(
        {
            url : serverAdress+file,
            type : 'POST',
            data : "listName="+listName+"&password="+password,
            dataType : 'HTML', // text ou JSON, à voir
            success : function(resultat,statut)
            {
                if(resultat == get_success)
                {
                    document.location.href="home.html";
                }
                else
                {
                    alert('Nom de liste ou mot de pas incorrect.');

                }
            },
            error : function(resultat, statut, erreur)
            {
                alert(erreur);
            }
        });
    }
}
