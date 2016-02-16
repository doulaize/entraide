<?
	include('../action_bdd/action_bdd.php');
	include('../include/fonctions.php');
?>
<u><b>Nombre de sorties dans le mois</b></u><br>
veuillez choisir le mois et l'ann&eacute;e(format YYYYMM): <br><br>
<input type="text" size="5" maxlength="4" id="annee" value="<?if(isset($_GET["annee"])){echo $_GET["annee"];}?>"> <select id="mois">
	<?for($i=1;$i<=12;$i++){?>
	<option value="<?echo $i;?>" <?if(isset($_GET["mois"]) && $_GET["mois"] == $i) echo "selected";?>><?echo $i;?></option>
	<?}?>
</select>
<a href="#" onclick="writediv(file('./contenu/stats_user.php?annee='+document.getElementById('annee').value+'&mois='+document.getElementById('mois').value));">valider</a>
<?if(isset($_GET["annee"]) && isset($_GET["mois"])){
	$stat = mysql_fetch_array(stat_sorties_nb_mois($_GET["mois"],$_GET["annee"]),ENT_QUOTES);
	echo "<br><b>il y a eu ".$stat["nb"]." sorties en ".$_GET["annee"]." ".$_GET["mois"]."</b>";
}?>

<br>
<br>
<u><b>Sorties par utilisateur : </b></u><br>
<?
$traitement = select_all_users();
?>
Veuillez Choisir l&#039;utilisateur concern&eacute; : <input type="hidden" id="users"> <select onchange="document.getElementById('users').value = this.value;" id="les_users"><option value="">-</option><?
while($users = mysql_fetch_array($traitement,ENT_QUOTES)){
	?>
	<option <?if(isset($_GET["users"]) && $_GET["users"] == $users["id"]) echo "selected";?> value="<?echo $users["id"];?>"><?echo $users["nom"]." ".$users["prenom"];?></option>
	<?
}
?>
</select> <a href = "#" onclick="if(document.getElementById('users').value != '' && document.getElementById('users').value != 'undefined'){writediv(file('./contenu/stats_user.php?users='+document.getElementById('users').value));}">valider</a>
<?if(isset($_GET["users"]) && $_GET["users"] !=""){
	$stat_per_user = select_stat_per_user($_GET["users"]);
	?>
	<table><tr><td>id</td><td>date</td><td>nom domicili&eacute;</td><td>nom utilisateur</td><td>nom fichier</td></tr>
	<?
	while($donnees_par_user = mysql_fetch_array($stat_per_user,ENT_QUOTES)){
		echo "<tr><td>".$donnees_par_user["id"]."</td><td>".$donnees_par_user["ladate"]."</td><td>".$donnees_par_user["NOM"]." ".$donnees_par_user["PRENOM"]."</td><td>".$donnees_par_user["nom"]."</td><td>".$donnees_par_user["nom_fichier"]."</td></tr>";
	}
	?></table><?
}
?>
<br><br>
Signatures par utilisateur : <br>