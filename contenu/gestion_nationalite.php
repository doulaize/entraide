<?
include('../action_bdd/action_bdd.php');
include('../include/fonctions.php');



if(isset($_GET["ajout"]) && $_GET["ajout"] == "true"){
	if($_GET["nom_nationalite"] != ""){
		$resultat = add_nationalite($_GET["nom_nationalite"]);
	}
	else{
		echo "<font color='#FF0000'>Veuillez remplir le nom de la nationalite !!</font><br>";
	}
}

if(isset($_GET["suppression"]) && $_GET["suppression"] == "true"){
	if($_GET["id_nationalite"] != ""){
		$resultat = del_nationalite($_GET["id_nationalite"]);
	}
	else{
		echo "<font color='#FF0000'>Probl&egrave;me !!</font><br>";
	}
}
if(isset($_GET["modif"]) && $_GET["modif"] == "true"){
	if($_GET["id_nationalite"] != ""){
		$resultat = modif_nationalite($_GET["id_nationalite"],$_GET["nom_nationalite"]);
	}
	else{
		echo "<font color='#FF0000'>Probl&egrave;me !!</font><br>";
	}
}

if(isset($_GET["modification"]) && $_GET["modification"] == "true"){
?>
<table>
	<tr>
		<td colspan="2">Modification d'une nationalit&eacute; : </td>
	<tr>
	<tr>
		<td>nom de la nationalit&eacute; : </td>
		<td><input id="nom_nationalite" type="text" maxlength="100" size="30" value="<? echo affichage_input(affichage($_GET["nom_nationalite"]));?>"></td>
	<tr>
	<tr>
		<td>valider : </td>
		<td><input type="button" value="modifier" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_nationalite.php?modif=true&id_nationalite=<?echo $_GET["id_nationalite"];?>&nom_nationalite='+document.getElementById('nom_nationalite').value));"></td>
	<tr>
</table>
<?}else{
$resultat = select_all_nationalite();?>
<table>
	<tr>
		<td colspan="2">Cr&eacute;ation d'une nationalit&eacute; : </td>
	<tr>
	<tr>
		<td>nom de la nationalit&eacute; : </td>
		<td><input id="nom_nationalite" type="text" maxlength="100" size="30"></td>
	<tr>
	<tr>
		<td>valider : </td>
		<td><input type="button" value="ajouter" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_nationalite.php?ajout=true&nom_nationalite='+document.getElementById('nom_nationalite').value));"></td>
	<tr>
</table>
<br>
<table>
	<?
	$i=0;
	//if(mysql_fetch_array($resultat,MYSQL_ASSOC) != NULL){
	while($valeur = mysql_fetch_array($resultat,MYSQL_ASSOC)){
	$i=$i+1;
	?>
	<tr>
		<td>Nom nationalit&eacute;</td>
		<td><input type="hidden" id="id_nationalite<?echo $i;?>" value="<?echo $valeur["id"];?>"><?echo affichage($valeur["nom_nationalite"]);?></td>
		<td>
			<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_nationalite.php?modification=true&nom_nationalite=<?echo urlencode($valeur["nom_nationalite"]);?>&id_nationalite='+document.getElementById('id_nationalite<?echo $i;?>').value));">Modifier</a>
		</td>
		<td>
			<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_nationalite.php?suppression=true&id_nationalite='+document.getElementById('id_nationalite<?echo $i;?>').value));">Supprimer</a>
		</td>
	</tr>
	<?}?>
</table>
<?}?>