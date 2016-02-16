<?
include('../action_bdd/action_bdd.php');
include('../include/fonctions.php');

if(isset($_GET["ajout"]) && $_GET["ajout"] == "true"){
	if($_GET["nom_pays"] != ""){
		$resultat = add_pays($_GET["nom_pays"]);
	}
	else{
		echo "<font color='#FF0000'>Veuillez remplir le nom du pays !!</font><br>";
	}
}

if(isset($_GET["suppression"]) && $_GET["suppression"] == "true"){
	if($_GET["id_pays"] != ""){
		$resultat = del_pays($_GET["id_pays"]);
	}
	else{
		echo "<font color='#FF0000'>Probl&egrave;me !!</font><br>";
	}
}
if(isset($_GET["modif"]) && $_GET["modif"] == "true"){
	if($_GET["id_pays"] != ""){
		$resultat = modif_pays($_GET["id_pays"],$_GET["nom_pays"]);
	}
	else{
		echo "<font color='#FF0000'>Probl&egrave;me !!</font><br>";
	}
}

if(isset($_GET["modification"]) && $_GET["modification"] == "true"){
?>
<table>
	<tr>
		<td colspan="2">Modification d'un pays : </td>
	<tr>
	<tr>
		<td>nom du pays : </td>
		<td><input id="nom_pays" type="text" maxlength="100" size="30" value="<? echo affichage_input(affichage($_GET["nom_pays"]));?>"></td>
	<tr>
	<tr>
		<td>valider : </td>
		<td><input type="button" value="modifier" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_pays.php?modif=true&id_pays=<?echo $_GET["id_pays"];?>&nom_pays='+document.getElementById('nom_pays').value));"></td>
	<tr>
</table>
<?}else{
$resultat = select_all_pays();?>
<table>
	<tr>
		<td colspan="2">Cr&eacute;ation d'un pays : </td>
	<tr>
	<tr>
		<td>nom du pays : </td>
		<td><input id="nom_pays" type="text" maxlength="100" size="30"></td>
	<tr>
	<tr>
		<td>valider : </td>
		<td><input type="button" value="ajouter" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_pays.php?ajout=true&nom_pays='+document.getElementById('nom_pays').value));"></td>
	<tr>
</table>
<br>
<table>
	<?
	$i=0;
	while($valeur = mysql_fetch_array($resultat,MYSQL_ASSOC)){
	$i=$i+1;
	?>
	<tr>
		<td>Nom pays</td>
		<td><input type="hidden" id="id_pays<?echo $i;?>" value="<?echo $valeur["id"];?>"><?echo affichage($valeur["nom_pays"]);?></td>
		<td>
			<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_pays.php?modification=true&nom_pays=<?echo urlencode($valeur["nom_pays"]);?>&id_pays='+document.getElementById('id_pays<?echo $i;?>').value));">Modifier</a>
		</td>
		<td>
			<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_pays.php?suppression=true&id_pays='+document.getElementById('id_pays<?echo $i;?>').value));">Supprimer</a>
		</td>
	</tr>
	<?}?>
</table>
<?}?>