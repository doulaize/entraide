<?
include("connexion.php");
//modification des donnees personnelew
if(isset($_POST))
{
	$SQL = "DELETE FROM utilisateurs WHERE id=".$_GET['id_user'];
	$test = mysql_query($SQL);
	session_start();
	if($test == true)
		$_SESSION['message'] = "<font color='#00FF00'>L'utilisateur a bien &eacute;t&eacute; supprim&eacute;</font>";
	else
		$_SESSION['message'] = "<font color='#0000FF'>Probl&egrave;me &agrave; la suppression !!</font>";
	header('Location:../index.php');
}
?>