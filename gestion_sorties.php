<?
	include('./action_bdd/action_bdd.php');
	include('./include/fonctions.php');
	include('./include/entete.php');

if(isset($_GET["del"])){
	$SQL="delete from fichiers where id =".$_GET["id"];
	if(unlink("C:/sorties/".$_GET["name"]) && mysql_query($SQL))
		echo "suppression effectuée";
}
	
if(isset($_FILES['sortie']))
{ 
     $dossier = 'C:/sorties/';
     $fichier = basename($_FILES['sortie']['name']);
     if(move_uploaded_file($_FILES['sortie']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que a a fonctionn...
     {
          echo 'Upload effectué avec succès !';
		  $SQL = "insert into fichiers (nom_fichier) values ('".$fichier."')";
		  mysql_query($SQL);
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}
?>
<a href="#" onclick="window.close();">fermer la page</a><br><br>
<form method="POST" action="./gestion_sorties.php" enctype="multipart/form-data">
     <!-- On limite le fichier  100Ko -->
     Fichier : <input type="file" name="sortie" id="sortie">
	<input type="submit" value="envoyer">
</form>
<br><br>

<?
	$nb_sql= "select count(*) as nb from fichiers";
	$row = mysql_fetch_array(mysql_query($nb_sql),ENT_QUOTES);
	$nb=$row["nb"];
	$SQL = "select * from fichiers";?>
		<table><tr><td>nom fichier : </td><td>&nbsp;</td></tr>
	<? $data_file = mysql_query($SQL);
	for($i=0;$i<$nb;$i++){
		$row = mysql_fetch_array($data_file ,ENT_QUOTES);
		echo "<tr><td>".$row["nom_fichier"]."</td><td><a href=\"gestion_sorties.php?del=true&id=".$row["id"]."&name=".$row["nom_fichier"]."\">supprimer</a></td></tr>";
	}
?>
</table>
<?include('./include/pied.php');?>