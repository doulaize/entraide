function file(fichier)
{
    if(window.XMLHttpRequest) // FIREFOX
        xhr_object = new XMLHttpRequest();
    else if(window.ActiveXObject) // IE
        xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
    else
        return(false);
    xhr_object.open("GET", fichier, false);
    xhr_object.send(null);
    if(xhr_object.readyState == 4) return(xhr_object.responseText);
    else return(false);
}
// retourne l'affichage sur la div 
function writediv(texte)
{
	document.getElementById('search').innerHTML = texte;
}
 function writedivssmenu(texte)
{
	document.getElementById('sous_menu').innerHTML = texte;
}
// vérifie le type de recherche souhaité
function verifInput(type_recherche)
{
    if(type_recherche == "1")
	{
		writediv('<?echo $NOM;?>');
	}
	else if(type_recherche == "2")
	{
		writediv('<?echo $NUM;?>');
	}	
}
