<? 	
if(isset($_POST['login']) && isset($_POST['mdp'])){//si on a passé en parametre les login et mdp
	if($_POST['login'] == "" || $_POST['mdp'] == "")
		echo '<meta http-equiv="refresh" content="0;url=./index.php?error=1">';
	//$link = @mysql_connect("sql.free.fr", "xavierrocher", "09071984") //connection du user   //preprod
	//$link = @mysql_connect("localhost", "xavEntraide", "nmSFBd3fk") //connection du user
	include("./action_bdd/connexion.php");
	
	$query = " select * from utilisateurs where login='".htmlentities($_POST['login'],ENT_QUOTES)."' and mdp ='".htmlentities($_POST['mdp'],ENT_QUOTES)."'"; //récupération des droits
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
	
	//if(!$link = mysql_connect("localhost", $_POST['login'], $_POST['mdp'])){
	//echo "pas connecté";exit();

	/*}
	else{
		echo "pas connecté";exit();
		header("Location: ./index.php?success");}*/
}
else
	header("Location: ./index.php?error=alert"); //alerte hacking!

 //  mysql_select_db("entraide");

/*if(isset($_POST['login']) && isset($_POST['mdp'])){
	if($_POST['login'] == "" || $_POST['mdp'] == ""){
		header("Location: ./index.php?error=1");//login et mdp vides
	}
	else
	{
		$query = " select * from utilisateurs where login='".$_POST['login']."' and mdp ='".$_POST['mdp']."'"; 
		$res = mysql_query($query);
		$row = mysql_fetch_array($res);
		if(!$row['id']){
			header("Location: ./index.php?error=2");//login incorrect
		}
		else{
			session_start();
			$_SESSION = array();
			$_SESSION['id'] = $row['id'];
			$_SESSION['droits'] = $row['droits'];
			$_SESSION['nom'] = $row['nom'];
			$_SESSION['prenom'] = $row['prenom'];
			header("Location: ./index.php?success");//passé
		}
	}
}
else{
	header("Location: ./index.php?error=alert"); //alerte hacking!
}*/
?>