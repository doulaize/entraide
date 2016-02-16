<?
//fonction de remplacement des caractères spéciaux d'une chaine de caractères
function affichage($texte){

//é
$texte = str_replace("é", "&eacute;", $texte);
//ä
$texte = str_replace("ä", "&auml;", $texte);
//ë
$texte = str_replace("ë", "&euml;", $texte);
//ï
$texte = str_replace("ï", "&iuml;", $texte);
//ö
$texte = str_replace("ö", "&ouml;", $texte);
//ü	
$texte = str_replace("ü", "&uuml;", $texte);
//ÿ
$texte = str_replace("ÿ", "&yuml;", $texte);
//ä
$texte = str_replace("Ä", "&Auml;", $texte);
//ë
$texte = str_replace("Ë", "&Euml;", $texte);
//ï
$texte = str_replace("Ï", "&Iuml;", $texte);
//ö
$texte = str_replace("Ö", "&Ouml;", $texte);
//ü	
$texte = str_replace("Ü", "&Uuml;", $texte);
	//è
	$texte = str_replace("è", "&egrave;", $texte);
	//ê
	$texte = str_replace("ê", "&ecirc;", $texte);
	//â
	$texte = str_replace("â", "&acirc;", $texte);
	//à
	$texte = str_replace("à", "&agrave;", $texte);
	//î
	$texte = str_replace("î", "&icirc;", $texte);
	//ô
	$texte = str_replace("ô", "&ocirc;", $texte);
	//û
	$texte = str_replace("û", "&ucirc;", $texte);
	//ç
	$texte = str_replace("ç", "&ccedil;", $texte);
	
	return $texte;
}

function affichage_csv($texte){

	//é
	$texte = str_replace("&eacute;", "é", $texte);
	//è
	$texte = str_replace("&egrave;", "è", $texte);
	//ê
	$texte = str_replace("&ecirc;", "ê", $texte);
	//â
	$texte = str_replace("&acirc;", "â", $texte);
	//à
	$texte = str_replace("&agrave;", "à", $texte);
	//î
	$texte = str_replace("&icirc;", "î", $texte);
	//ô
	$texte = str_replace("&ocirc;", "ô", $texte);
	//û
	$texte = str_replace("&ucirc;", "û", $texte);
	//ç
	$texte = str_replace("&ccedil;", "ç", $texte);
	//"
	$texte = str_replace("&quot;", "\"", $texte);
	$texte = str_replace("&#039;", "'", $texte);
	$texte = str_replace("&#034;", "\"", $texte);

//ä
$texte = str_replace("&auml;", "ä", $texte);
//ë
$texte = str_replace("&euml;", "ë", $texte);
//ï
$texte = str_replace("&iuml;", "ï", $texte);
//ö
$texte = str_replace("&ouml;", "ö", $texte);
//ü	
$texte = str_replace("&uuml;", "ü", $texte);
//ÿ
$texte = str_replace("&eacute;", "ÿ", $texte);
//ä
$texte = str_replace("&Auml;", "Ä", $texte);
//ë
$texte = str_replace("&Euml;", "Ë", $texte);
//ï
$texte = str_replace("&Iuml;", "Ï", $texte);
//ö
$texte = str_replace("&Ouml;", "Ö", $texte);
//ü	
$texte = str_replace("&Uuml;", "Ü", $texte);
	return $texte;
}

function affichage_input($texte){

	//"
	$texte = str_replace("\"", "&#034;", $texte);
	return $texte;
}

function simple_quote_js($texte){
	//'
	$texte = str_replace("&#039;", "\&#039;", $texte);
	return $texte;
}

function insertion($texte){

	//"
	$texte = str_replace("&#034;", "\"", $texte);
	//'
	$texte = str_replace("&#039;", "'", $texte);
	return $texte;
}
?>