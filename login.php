<? 	
if(isset($_POST['login']) && isset($_POST['mdp'])){//si on a passe en parametre les login et mdp
	if($_POST['login'] == "" || $_POST['mdp'] == "")
		echo '<meta http-equiv="refresh" content="0;url=./index.php?error=1">';
	//$link = @mysql_connect("sql.free.fr", "xavierrocher", "09071984") //connection du user   //preprod
	//$link = @mysql_connect("localhost", "xavEntraide", "nmSFBd3fk") //connection du user
	include("./action_bdd/connexion.php");
	
	$query = " SELECT * FROM utilisateurs WHERE login='".htmlentities($_POST['login'],ENT_QUOTES)."' and mdp ='".htmlentities($_POST['mdp'],ENT_QUOTES)."'"; //récupération des droits
	$res = mysql_query($query);
	$row = mysql_fetch_array($res);
		
	session_start();
	$_SESSION = array();
	$_SESSION['id'] = $row['id'];
	$_SESSION['droits'] = $row['droits'];
	$_SESSION['nom'] = $row['nom'];
	$_SESSION['prenom'] = $row['prenom'];
	$_SESSION['link'] = $link;
	$_SESSION['connected'] = true;

	header("Location: ./index.php?success");
}
?>