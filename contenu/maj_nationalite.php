<?
include('../action_bdd/action_bdd.php');
include('../include/fonctions.php');

if(isset($_GET["maj"]) && $_GET["maj"] == "yes"){
	if(isset($_GET["id"]) && $_GET["id"] != "" && $_GET["id"] != "0"){
		$res = maj_nationalite($_GET["id"],$_GET["id_nationalite"]);
		?>
			Vous avez bien modifi&eacute; la nationalite ...
		<?
	}
}
else{
	if(isset($_GET["id"]) && $_GET["id"] != "" && $_GET["id"] != "0"){?>
			<select id="nationalite" name="nationalite">
				<option value="" selected>Choisir une nationalit&eacute;...</option>
			<?$resultat = select_all_nationalite();
				while($valeur = mysql_fetch_array($resultat,MYSQL_ASSOC)){
					?>
						<option value="<?echo $valeur["id"];?>"><?echo affichage($valeur["nom_nationalite"]);?>	
						</option>
					<?
				}
			?>
			</select>
	<input type="button" value="Valider" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/maj_nationalite.php?id=<?echo $_GET["id"];?>&id_nationalite='+document.getElementById('nationalite').value+'&maj=yes'));">
	<?}
	else{
		echo 'ici on recherche les domiciliés, et on propose de cocher (attention, ajax sur la nationalite)';
	}
}
?>