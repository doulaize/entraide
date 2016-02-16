<?
include('../action_bdd/action_bdd.php');
include('../include/fonctions.php');

?>
<b>Chercher par :</b><br>
<table>
	<tr>
		<td>Num&eacute;ro : </td>
		<td>
			<input type="text" id="num" name="num">
		</td>
	</tr>
	<tr>
		<td>civilit&eacute; : </td>
		<select id="civilite" name="civilite">
			<option value="" selected>Choisir ...</option>
			<option value="MR">Monsieur</option>
			<option value="MME">Madame</option>
			<option value="MLLE">Mademoiselle</option>
		</select>
	</tr>
	<tr>
		<td>Nom : </td>
		<td>
			<input type="text" id="nom" name="nom">
		</td>
	</tr>
	<tr>
		<td>Pr&eacute;nom : </td>
		<td>
			<input type="text" id="prenom" name="prenom">
		</td>
	</tr>
	<tr>
		<td>Ann&eacute;e de naissance : (saisir l'ann&eacute;e)</td>
		<td>
			<input type="text" id="date_naissance" name="date_naissance">
		</td>
	</tr>
	<tr>
		<td>Lieu de naissance : </td>
		<td>
			<input type="text" id="lieu_naissance" name="lieu_naissance">
		</td>
	</tr>
	<tr>
		<td>Pays de naissance <br>(attention! les domicili&eacute;s dont le pays n'est pas &agrave; jour, ne seront pas affich&eacute;s) : </td>
		<td>
			<select id="pays_naissance" name="pays_naissance">
				<option value="" selected>Choisir un pays...</option>
			<?$resultat = select_all_pays();
				while($valeur = mysql_fetch_array($resultat,MYSQL_ASSOC)){
					?>
						<option value="<?echo $valeur["id"];?>"><?echo affichage($valeur["nom_pays"]);?></option>
					<?
				}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td>nationalit&eacute; : </td>
		<td>
			<select id="nationalite" name="nationalite">
				<option value="" selected>Choisir une nationalit&eacute;...</option>
			<?$resultat = select_all_nationalite();
				while($valeur = mysql_fetch_array($resultat,MYSQL_ASSOC)){
					?>
						<option value="<?echo $valeur["id"];?>"><?echo affichage($valeur["nom_nationalite"]);?></option>
					<?
				}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td><b>P&eacute;riode : </b></td>
	</tr>
	<tr>
		<td><input type="radio" onclick="document.getElementById('non').checked = false;document.getElementById('tous').checked = false; document.getElementById('radie').value = this.value;" value="1" id="oui" name="oui">radi&eacute; <input type="radio" onclick="document.getElementById('oui').checked = false;document.getElementById('tous').checked = false;document.getElementById('radie').value = this.value;"  id="non" name="non" value="0">inscrits <input type="radio" onclick="document.getElementById('non').checked = false;document.getElementById('oui').checked = false;document.getElementById('radie').value = this.value;" id="tous" name="tous" value="tous" checked>tous : (format : AAAAMMJJ) </td>
		<td>
			du : <input type="text" id="date_debut_radie" name="date_debut_radie"> au <input type="text" name="date_fin_radie" id="date_fin_radie">
		</td>
	</tr>
	<tr><td>inclure les immeubles : <input type="checkbox" id="immeuble" checked></td></tr>
	<tr>
		<td>
		<input type="hidden" id="radie" name="radie" value="tous">
			<center><input type="button" value="chercher" onclick="if(document.getElementById('immeuble').checked == true){var imm = 'vrai';}else{var imm = 'faux';}if(isNaN(document.getElementById('num').value)){alert('Il faut un chiffre pour le champ  numéro');return 0;}
			if(document.getElementById('date_naissance').value != ''){
			if(isNaN(document.getElementById('date_naissance').value) || document.getElementById('date_naissance').value.length != 4){alert('Mettez seulement l\'ann&eacute;e de naissance');return 0;}
			}
			document.getElementById('alert').innerHTML = '';writediv(file('./contenu/search_dom.php?id_user=<?echo $_GET["id_user"];?>&immeuble='+imm+'&droits=<?echo $_GET["droits"];?>&num='+document.getElementById('num').value+'&civilite='+document.getElementById('civilite').value+'&nom='+document.getElementById('nom').value+'&prenom='+document.getElementById('prenom').value+'&date_naissance='+document.getElementById('date_naissance').value+'&lieu_naissance='+document.getElementById('lieu_naissance').value+'&pays_naissance='+document.getElementById('pays_naissance').value+'&nationalite='+document.getElementById('nationalite').value+'&radie='+document.getElementById('radie').value+'&date_debut_radie='+document.getElementById('date_debut_radie').value+'&date_fin_radie='+document.getElementById('date_fin_radie').value));"></center>
		</td>
	</tr>
</table>