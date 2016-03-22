
function test_saisie_modif_data()
{
	if(document.getElementById(‘mdp’).value != document.getElementById(‘confirm_mdp’).value)
	{
		alert(‘vous avez mal retapé votre mot de passe !’);
		return 0;
	}
	if(document.getElementById(‘nom’).value == ““)
	{
		alert(‘votre nom est vide !’);
		return 0;
	}
	if(document.getElementById(‘prenom’).value == ““)
	{
		alert(‘votre prénom est vide !’);
		return 0;
	}
	if(document.getElementById(‘login’).value == ““)
	{
		alert(‘votre login est vide !’);
		return 0;
	}
	return 1;
}

if (window.attachEvent) window.attachEvent(“onload”, sfHover);
if (window.attachEvent) window.attachEvent(“onload”, sfHover2);

function writediv(texte)
{
	document.getElementById(‘contenu’).innerHTML = texte;
}

function file(fichier)
{
    if(window.XMLHttpRequest) // FIREFOX
        xhr_object = new XMLHttpRequest(); 
    else if(window.ActiveXObject) // IE
        xhr_object = new ActiveXObject(“Microsoft.XMLHTTP”); 
    else 
        return(false); 
    xhr_object.open(“GET”, fichier, false); 
    xhr_object.send(null); 
    if(xhr_object.readyState == 4) return(xhr_object.responseText);
    else return(false);
}
