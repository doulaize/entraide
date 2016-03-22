<?
$link = @mysql_connect("localhost", "toto", "") //connection à la bdd
	or die ('<meta http-equiv="refresh" content="0;url=./index.php?error=2">');//gestion de ma mauvaise connection	
mysql_select_db("entraide");//accès à la database
//modification des donnees personnelew
if(isset($_POST['id']) && $_POST['id'] != "")
{
	$SQL = "UPDATE utilisateurs SET nom='".htmlentities($_POST['nom'],ENT_QUOTES)."', prenom='".htmlentities($_POST['prenom'],ENT_QUOTES)."',login='".htmlentities($_POST['login'],ENT_QUOTES)."',mdp='".htmlentities($_POST['mdp'],ENT_QUOTES)."', droits='".htmlentities($_POST['droits'],ENT_QUOTES)."' WHERE id=".htmlentities($_POST['id'],ENT_QUOTES);
	mysql_query($SQL);
	session_start();
	$_SESSION['message'] = "<font color='#00FF00'>Vos donn&eacute;s personnelles on bien &eacute;t&eacute; modifi&eacute;es.</font>";
	header('Location:../index.php');
}
?>