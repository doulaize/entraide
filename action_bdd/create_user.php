<?
include("connexion.php");
//modification des donnees personnelew
if(isset($_POST))
{
	$SQL = "INSERT INTO utilisateurs(nom,prenom,login,mdp,droits";
	if($_POST['droits'] == "T")
		$SQL .= ",signature";
	$SQL .= ") VALUES('".htmlentities($_POST['nom'],ENT_QUOTES)."','".htmlentities($_POST['prenom'],ENT_QUOTES)."','".htmlentities($_POST['login'],ENT_QUOTES)."','".htmlentities($_POST['mdp'],ENT_QUOTES)."','".htmlentities($_POST['droits'],ENT_QUOTES)."'";
	if($_POST['droits'] == "T")
		$SQL .= ", ".$_POST['droit_signature'];
	$SQL .= ")";
	$test = mysql_query($SQL);
	session_start();
	if($test == true)
		$_SESSION['message'] = "<font color='#00FF00'>L'utilisateur a bien &eacute;t&eacute; cr&eacute;&eacute;</font>";
	else
		$_SESSION['message'] = "<font color='#0000FF'>Probl&egrave;me &agrave; la cr&eacute;ation !!</font>";
	header('Location:../index.php');
}
?>