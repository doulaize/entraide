<?
include('../action_bdd/action_bdd.php');
include('../include/fonctions.php');

if(isset($_GET["maj"]) && $_GET["maj"] == "yes"){
	if(isset($_GET["id"]) && $_GET["id"] != "" && $_GET["id"] != "0"){
		$res = maj_pays($_GET["id"],$_GET["id_pays"]);
		?>
			Vous avez bien modifi&eacute; le pays ...
		<?
	}
}
else{
	if(isset($_GET["id"]) && $_GET["id"] != "" && $_GET["id"] != "0"){?>
	<select id="pays_naissance" name="pays_naissance">
		<option value="" selected>Choisir un pays...</option>
		<?$resultat = select_all_pays();
			while($valeur = mysql_fetch_array($resultat,MYSQL_ASSOC)){?>
				<option value="<?echo $valeur["id"];?>"><?echo affichage($valeur["nom_pays"]);?></option>
			<?}?>
	</select>
	<input type="button" value="Valider" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/maj_pays.php?id=<?echo $_GET["id"];?>&id_pays='+document.getElementById('pays_naissance').value+'&maj=yes'));">
	<?}
	else{
		echo 'ici on recherche les domiciliés, et on propose de cocher (attention, ajax sur le pays)';
	}
}
?>