$(function(){
	$("#creation").load("creation.html"); 
});

document.getElementById("creationForm").onclick = function blockForm(){
    console.log("mmm");
    var listName = document.getElementById("listName").value;
    var password = document.getElementById('password').value; // à sécuriser : voir si on fait HTTPS ou Sécurité côté client.
	var password2 = document.getElementById('password2').value;

	var site = 'http://listmaker-stkl.esy.es/';
    var dossier = 'creation.php';
	
    if (listName.length===0)
    {
        return alert("Veuillez entrer le nom de votre liste");
    }
	else if (listName.length<3)
	{
		return alert("Le nom de la liste doit comporter au moins 3 caractères");
	}
    else if (password.length===0)
    {
        return alert("Veuillez entrer votre mot de passe");
    }
	else if (password.length<3)
	{
		return alert("Votre mot de passe est beaucoup trop court"); // à modifier si MD5 côté client
	}
	else if (!(password==password2))
	{
		return alert("Les deux mots de passes ne correspondent pas");
	}
    else
    {
	
	var get_success = 'success';
	
        $.ajax({
            url : site+dossier, 
            type : 'POST',
            data : "listName="+listName+"&password="+password+"&password2="+password2,
            dataType : 'HTML', // text ou JSON, à voir
            success : function(resultat,statut)
            {	
                if(resultat == get_success)
				{
					alert("Votre liste a bien été enregistrée"); // Afficher un message temporaire pour ensuite rediriger
					document.location.href="connexion.html";
                }
				else 
				{
					alert(resultat);
				}
            },
            error : function(resultat, statut, erreur)
            {
                alert(erreur);
            }
        });
    }
}
