document.getElementById("connexion_form").onclick = function blockForm(){
    
    var username = document.getElementById("username").value;
    var listName = document.getElementById("listName").value;
    var password = document.getElementById("password").value;
    
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

            success : function(code_html,statut)
            {	
            	console.log(code_html);
                if(code_html == get_success)
		{
                    document.location.href="home.html";
                }
                else 
		{
                    alert('La connexion a échoué, veuillez réessayer');
                }
            },
            error : function(resultat, statut, erreur)
            {
                alert(erreur);
            }
        });
    }
}
