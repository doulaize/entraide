<?
include('../action_bdd/action_bdd.php');
include('../include/fonctions.php');

if(isset($_GET["ajout"]) && $_GET["ajout"] == "true"){
	if($_GET["nom_statut"] != ""){
		$resultat = add_statut($_GET["nom_statut"]);
	}
	else{
		echo "<font color='#FF0000'>Veuillez remplir le libell&eacute; du statut !!</font><br>";
	}
}

if(isset($_GET["suppression"]) && $_GET["suppression"] == "true"){
	if($_GET["id_statut"] != ""){
		$resultat = del_statut($_GET["id_statut"]);
	}
	else{
		echo "<font color='#FF0000'>Probl&egrave;me !!</font><br>";
	}
}
if(isset($_GET["modif"]) && $_GET["modif"] == "true"){
	if($_GET["id_statut"] != ""){
		$resultat = modif_statut($_GET["id_statut"],$_GET["nom_statut"]);
	}
	else{
		echo "<font color='#FF0000'>Probl&egrave;me !!</font><br>";
	}
}

if(isset($_GET["modification"]) && $_GET["modification"] == "true"){
?>
<table>
	<tr>
		<td colspan="2">Modification d'un statut : </td>
	<tr>
	<tr>
		<td>nom du statut : </td>
		<td><input id="nom_statut" type="text" maxlength="100" size="30" value="<? echo affichage_input(affichage($_GET["nom_statut"]));?>"></td>
	<tr>
	<tr>
		<td>valider : </td>
		<td><input type="button" value="modifier" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_statut.php?modif=true&id_statut=<?echo $_GET["id_statut"];?>&nom_statut='+document.getElementById('nom_statut').value));"></td>
	<tr>
</table>
<?}else{
$resultat = select_all_statut();?>
<table>
	<tr>
		<td colspan="2">Cr&eacute;ation d'un statut : </td>
	<tr>
	<tr>
		<td>nom du statut : </td>
		<td><input id="nom_statut" type="text" maxlength="100" size="30"></td>
	<tr>
	<tr>
		<td>valider : </td>
		<td><input type="button" value="ajouter" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_statut.php?ajout=true&nom_statut='+document.getElementById('nom_statut').value));"></td>
	<tr>
</table>
<br>
<table>
	<?
	while($valeur = mysql_fetch_array($resultat,MYSQL_ASSOC)){
	?>
	<tr>
		<td>Libell&eacute; statut</td>
		<td><input type="hidden" id="id_statut<?echo $valeur["id"];?>" value="<?echo $valeur["id"];?>"><?echo affichage($valeur["libelle_statut"]);?></td>
		<td>
			<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_statut.php?modification=true&nom_statut=<?echo urlencode($valeur["libelle_statut"]);?>&id_statut='+document.getElementById('id_statut<?echo $valeur["id"];?>').value));">Modifier</a>
		</td>
		<?if($valeur["id"] != 1){?>
		<td>
			<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_statut.php?suppression=true&id_statut='+document.getElementById('id_statut<?echo $valeur["id"];?>').value));">Supprimer</a>
		</td>
		<?}?>
	</tr>
	<?}?>
</table>
<?}?>