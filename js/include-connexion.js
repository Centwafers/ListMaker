document.getElementById("connexion_form").onclick = function blockForm(){
    
    var username = document.getElementById("username").value;
    var listName = document.getElementById("listName").value;
    var password = window.md5(document.getElementById('password').value); //le mdp ne doit jamais passer en clair sur le réseau
    
    if(username.length===0)
    {
        return alert("Veuillez entrer un nom d'utilisateur");
    }
    else if (listName.length===0)
    {
        return alert("Veuillez entrer le nom de votre liste");
    }
    else if (password.length===0)
    {
        return alert("Veuillez entrer votre mot de passe");
    }
    else
    {
	var get_success = 'success';

        $.ajax({
            url : 'connexion.php', 
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
                    alert('Nom d\'utilisateur ou mot de pas incorrect.');
                }
            },
            error : function(resultat, statut, erreur)
            {
                alert(erreur);
            }
        });
    }
}
