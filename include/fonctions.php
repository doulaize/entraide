<?
//fonction de remplacement des caract�res sp�ciaux d'une chaine de caract�res
function affichage($texte){

//�
$texte = str_replace("�", "&eacute;", $texte);
//�
$texte = str_replace("�", "&auml;", $texte);
//�
$texte = str_replace("�", "&euml;", $texte);
//�
$texte = str_replace("�", "&iuml;", $texte);
//�
$texte = str_replace("�", "&ouml;", $texte);
//�	
$texte = str_replace("�", "&uuml;", $texte);
//�
$texte = str_replace("�", "&yuml;", $texte);
//�
$texte = str_replace("�", "&Auml;", $texte);
//�
$texte = str_replace("�", "&Euml;", $texte);
//�
$texte = str_replace("�", "&Iuml;", $texte);
//�
$texte = str_replace("�", "&Ouml;", $texte);
//�	
$texte = str_replace("�", "&Uuml;", $texte);
	//�
	$texte = str_replace("�", "&egrave;", $texte);
	//�
	$texte = str_replace("�", "&ecirc;", $texte);
	//�
	$texte = str_replace("�", "&acirc;", $texte);
	//�
	$texte = str_replace("�", "&agrave;", $texte);
	//�
	$texte = str_replace("�", "&icirc;", $texte);
	//�
	$texte = str_replace("�", "&ocirc;", $texte);
	//�
	$texte = str_replace("�", "&ucirc;", $texte);
	//�
	$texte = str_replace("�", "&ccedil;", $texte);
	
	return $texte;
}

function affichage_csv($texte){

	//�
	$texte = str_replace("&eacute;", "�", $texte);
	//�
	$texte = str_replace("&egrave;", "�", $texte);
	//�
	$texte = str_replace("&ecirc;", "�", $texte);
	//�
	$texte = str_replace("&acirc;", "�", $texte);
	//�
	$texte = str_replace("&agrave;", "�", $texte);
	//�
	$texte = str_replace("&icirc;", "�", $texte);
	//�
	$texte = str_replace("&ocirc;", "�", $texte);
	//�
	$texte = str_replace("&ucirc;", "�", $texte);
	//�
	$texte = str_replace("&ccedil;", "�", $texte);
	//"
	$texte = str_replace("&quot;", "\"", $texte);
	$texte = str_replace("&#039;", "'", $texte);
	$texte = str_replace("&#034;", "\"", $texte);

//�
$texte = str_replace("&auml;", "�", $texte);
//�
$texte = str_replace("&euml;", "�", $texte);
//�
$texte = str_replace("&iuml;", "�", $texte);
//�
$texte = str_replace("&ouml;", "�", $texte);
//�	
$texte = str_replace("&uuml;", "�", $texte);
//�
$texte = str_replace("&eacute;", "�", $texte);
//�
$texte = str_replace("&Auml;", "�", $texte);
//�
$texte = str_replace("&Euml;", "�", $texte);
//�
$texte = str_replace("&Iuml;", "�", $texte);
//�
$texte = str_replace("&Ouml;", "�", $texte);
//�	
$texte = str_replace("&Uuml;", "�", $texte);
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