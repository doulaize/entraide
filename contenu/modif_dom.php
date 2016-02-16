<?

include('../action_bdd/action_bdd.php');
include('../include/fonctions.php');

if(isset($_GET["id"]) && $_GET["id"] != "" && $_GET["id"] != 0){
	if(isset($_GET["modification"]) && $_GET["modification"] == "true"){
		 modif_dom($_GET['id'],$_GET['ancien_N'],$_GET['CIVILITE'],$_GET['NOM'],$_GET['PRENOM'],$_GET['id_statut'],$_GET['NOM_MARITAL'],$_GET['annee_naissance'],$_GET['mois_naissance'],$_GET['jour_naissance'],$_GET['pays'],$_GET['ville_naissance'],$_GET['nationalite2'],$_GET['contacts'],$_GET['nature_document_identite'],$_GET['numero_document_identite'],$_GET['radie2'],$_GET['motif_RAD_temp'],$_GET['annee_radiation'],$_GET['mois_radiation'],$_GET['jour_radiation'],$_GET['annee_1_ere_inscription'],$_GET['mois_1_ere_inscription'],$_GET['jour_1_ere_inscription'],$_GET['annee_certificat'],$_GET['mois_certificat'],$_GET['jour_certificat']);
	echo "<div style='color:red;'>la modification a bien &eacute;t&eacute; effectu&eacute;e</div>";
	}

$vraies_dates = false;
$domicilie = select_domicilie($_GET["id"]);
$date = select_date($_GET["id"]);
if(mysql_fetch_array($date,ENT_QUOTES) != NULL){
	$date = select_date($_GET["id"]);
	if($date_dom = mysql_fetch_array($date,ENT_QUOTES)){
			$vraies_dates_certificat = true;
			$vraies_dates_radiation = true;
			$vraies_dates_naissance = true;
			$vraies_dates_1_ere_inscription = true;
		if($date_dom["date_certificat"] == "0000"){
			$vraies_dates_certificat = false;
		}
		if($date_dom["date_1_ere_inscription"] == "0000"){
			$vraies_dates_1_ere_inscription = false;
		}
		if($date_dom["date_radiation"] == "0000"){
			$vraies_dates_radiation = false;
		}
		if($date_dom["date_naissance"] == "0000"){
			$vraies_dates_naissance = false;
		}
		$vraies_dates = true;
	}
	else{
		$vraies_dates = false;
	}
} 
	while($valeur = mysql_fetch_array($domicilie,ENT_QUOTES)){
?>

<a href="#" onclick="writediv(file('./contenu/search_dom.php?id_user=<?echo $_GET["id_user"];?>&droits=<?echo $_GET['droits']?>&id=<?echo $valeur["id"];?><?if(isset($_GET)){if(isset($_GET["immeuble"])){?>&immeuble=<?echo $_GET["immeuble"];}if(isset($_GET["num"])){?>&num=<?echo $_GET["num"];}if(isset($_GET["civilite"])){?>&civilite=<?echo $_GET["civilite"];}if(isset($_GET["nom"])){?>&nom=<?echo $_GET["nom"];}if(isset($_GET["prenom"])){?>&prenom=<?echo $_GET["prenom"];}if(isset($_GET["date_naissance"])){?>&date_naissance=<?echo $_GET["date_naissance"];}if(isset($_GET["lieu_naissance"])){?>&lieu_naissance=<?echo $_GET["lieu_naissance"];}if(isset($_GET["pays_naissance"])){?>&pays_naissance=<?echo $_GET["pays_naissance"];}if(isset($_GET["nationalite"])){?>&nationalite=<?echo $_GET["nationalite"];}if(isset($_GET["radie"])){?>&radie=<?echo $_GET["radie"];}if(isset($_GET["date_debut_radie"])){?>&date_debut_radie=<?echo $_GET["date_debut_radie"];}if(isset($_GET["date_fin_radie"])){?>&date_fin_radie=<?echo $_GET["date_fin_radie"];}if(isset($_GET["limit"])){?>&limit=<?echo $_GET["limit"];}if(isset($_GET["limit_2"])){?>&limit_2=<?echo $_GET["limit_2"];}?><?}?>'))"">retour</a>

<a href="#" onclick="writediv(file('./contenu/impression_sortie.php?id_user=<?echo $_GET["id_user"];?>&id=<?echo $_GET["id"];?>'));">impression</a>
			<!--<a href="#" onclick="writediv(file('./contenu/modif_dom.php?id=<?echo $_GET["id"]-1;?>&<?foreach($_GET as $key => $value){if($key != "id"){echo "&".$key."=".$value;}}?>'))">num&eacute;ro pr&eacute;c&eacute;dent</a> <a href="#" onclick="writediv(file('./contenu/modif_dom.php?id=<?echo $_GET["id"]+1;?>&<?foreach($_GET as $key => $value){if($key != "id"){echo "&".$key."=".$value;}}?>'))">num&eacute;ro suivant</a>
-->
<table>
	<tr>
		<td>
			Num&eacute;ro : 
		</td>
		<td>
			<?echo $valeur["nouveau_N"];?>
		</td>
	</tr>
	<tr>
		<td>
			Ancien num&eacute;ro (inutilis&eacute;) : 
		</td>
		<td>
			<input type="text" id="ancien_N" name="ancien_N" value="<?echo affichage_input(affichage($valeur["ancien_N"]));?>">
		</td>
	</tr>
	<tr>
		<td>
			Civilit&eacute; : 
		</td>
		<td>
			<select id="CIVILITE" name="CIVILITE">
				<option value="" <?if($valeur["CIVILITE"] == ""){echo "selected";}?>>-</option>
				<option value="MR" <?if($valeur["CIVILITE"] == "MR"){echo "selected";}?>>Monsieur</option>
				<option value="MME" <?if($valeur["CIVILITE"] == "MME"){echo "selected";}?>>Madame</option>
				<option value="MLLE" <?if($valeur["CIVILITE"] == "MLLE"){echo "selected";}?>>Mademoiselle</option>
		
		</td>
	</tr>
	<tr>
		<td>
			Nom :
		</td>
		<td>
			<input type="text" name="NOM" id="NOM" value="<?echo affichage_input(affichage($valeur["NOM"]));?>">
		</td>
	</tr>
	<tr>
		<td>
			Pr&eacute;nom :
		</td>
		<td>
			<input type="text" name="PRENOM" id="PRENOM" value="<?echo affichage_input(affichage($valeur["PRENOM"]));?>">
		</td>
	</tr>
	<tr>
		<td>
			Statut :
		</td>
		<td>
			<select name="id_statut" id="id_statut">
				<option value="0" <?if($valeur["id_statut"] == "0"){echo "selected";}?>>-</option>
			<?
				$status = select_all_statut();
				while($res = mysql_fetch_array($status,MYSQL_ASSOC)){
					?><option value="<?echo $res["id"];?>" <?if($valeur["id_statut"] == $res["id"]){echo "selected";}?>><?echo $res["libelle_statut"];?></option><?
				}?>
			<input type="text" name="NOM_MARITAL" id="NOM_MARITAL" value="<?echo affichage_input(affichage($valeur["NOM_MARITAL"]));?>">
		</td>
	</tr>
	<tr>
		<td>
			Date de Naissance :
		</td>
		<td>
		<?	
		if(!$vraies_dates || $vraies_dates_naissance != true){
			echo "<font color='#FF0000'>Mettre &agrave; jour la date</font><br>";
			echo affichage($valeur["date_naissance"])."<br>";
		}?>
		ann&eacute;e/mois/jour : <input maxlength="4" type="text" size="10" name="annee_naissance" id="annee_naissance" value="<?if($vraies_dates){if(substr($date_dom["date_naissance"],0,4)=="0000"){echo "";}else{ echo substr($date_dom["date_naissance"],0,4);} }?>">
								&nbsp;<select name="mois_naissance" id="mois_naissance">
										<option value="00" <?if($vraies_dates && substr($date_dom["date_naissance"],4,2) == "00"){echo "SELECTED";}?>>-</option>
										<option value="01" <?if($vraies_dates && substr($date_dom["date_naissance"],4,2) == "01"){echo "SELECTED";}?>>Janvier</option>
										<option value="02" <?if($vraies_dates && substr($date_dom["date_naissance"],4,2) == "02"){echo "SELECTED";}?>>F&eacute;vrier</option>
										<option value="03" <?if($vraies_dates && substr($date_dom["date_naissance"],4,2) == "03"){echo "SELECTED";}?>>Mars</option>
										<option value="04" <?if($vraies_dates && substr($date_dom["date_naissance"],4,2) == "04"){echo "SELECTED";}?>>Avril</option>
										<option value="05" <?if($vraies_dates && substr($date_dom["date_naissance"],4,2) == "05"){echo "SELECTED";}?>>Mai</option>
										<option value="06" <?if($vraies_dates && substr($date_dom["date_naissance"],4,2) == "06"){echo "SELECTED";}?>>Juin</option>
										<option value="07" <?if($vraies_dates && substr($date_dom["date_naissance"],4,2) == "07"){echo "SELECTED";}?>>Juillet</option>
										<option value="08" <?if($vraies_dates && substr($date_dom["date_naissance"],4,2) == "08"){echo "SELECTED";}?>>Aout</option>
										<option value="09" <?if($vraies_dates && substr($date_dom["date_naissance"],4,2) == "09"){echo "SELECTED";}?>>Septembre</option>
										<option value="10" <?if($vraies_dates && substr($date_dom["date_naissance"],4,2) == "10"){echo "SELECTED";}?>>Octobre</option>
										<option value="11" <?if($vraies_dates && substr($date_dom["date_naissance"],4,2) == "11"){echo "SELECTED";}?>>Novembre</option>
										<option value="12" <?if($vraies_dates && substr($date_dom["date_naissance"],4,2) == "12"){echo "SELECTED";}?>>D&eacute;cembre</option>
									  </select>
								&nbsp;<select name="jour_naissance" id="jour_naissance" >
										<option value="00"
										<?if($vraies_dates 
											&& substr($date_dom["date_naissance"],6,2) == "00"){
												echo "SELECTED";
										}?>>-</option>
										<?for($jour=1;$jour<=31;$jour++){?>
											<option value="<?if($jour < 10){echo "0";}echo $jour;?>"
											<?if($vraies_dates 
											&& (substr($date_dom["date_naissance"],6,2) == "0".$jour 
											|| substr($date_dom["date_naissance"],6,2) == $jour)){
												echo "SELECTED";
											}?>>
												<?if($jour < 10){echo "0";}echo $jour;?>
											</option>
										<?}?>
									   </select>
		</td>
	</tr>
	<tr>
		<td>
			Pays de Naissance :
		</td>
		<td>
			<?if($valeur["pays"] == "0"){
				echo "<font color=\"#FF0000\">le pays n'est pas &agrave; jour, veuillez choisir un pays dans la liste</font><br>";
				echo affichage($valeur["pays_temp"])."<br>";
			}
			$pays = select_all_pays();
			?>
			<select name="pays" id="pays">
				<option value="0" <?if($valeur["pays"] == "0"){echo "selected";}?>>-</option>
			<?
				while($res_pays = mysql_fetch_array($pays,MYSQL_ASSOC)){
					?><option value="<?echo $res_pays["id"];?>" <?if($valeur["pays"] == $res_pays["id"]){echo "selected";}?>><?echo affichage_input(affichage($res_pays["nom_pays"]));?></option><?
			}?>
			</select>
			
		</td>
	</tr>
	<tr>
		<td>
			Ville de Naissance :
		</td>
		<td>
			<input type="text" name="ville_naissance" id="ville_naissance" value="<?echo affichage_input(affichage($valeur["lieu_naissance"]));?>">
		</td>
	</tr>
	<tr>
		<td>
			Nationalit&eacute; :
		</td>
		<td>
		<?if($valeur["nationalite"] == "0"){
				echo "<font color=\"#FF0000\">la nationalit&eacute; n'est pas &agrave; jour, veuillez en choisir une dans la liste</font><br>";
			echo affichage($valeur["nationalite_temp"])."<br>";
			}
			$nationalite = select_all_nationalite();
			?>
			<select name="nationalite" id="nationalite">
				<option value="0" <?if($valeur["nationalite"] == "0"){echo "selected";}?>>-</option>
			<?
				while($res_nationalite = mysql_fetch_array($nationalite,MYSQL_ASSOC)){
					?><option value="<?echo $res_nationalite["id"];?>" <?if($valeur["nationalite"] == $res_nationalite["id"]){echo "selected";}?>><?echo affichage($res_nationalite["nom_nationalite"]);?></option><?
			}?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Contact :
		</td>
		<td>
			<input type="text" name="contacts" id="contacts" value="<?echo affichage_input(affichage($valeur["contacts"]));?>">
		</td>
	</tr>
	<tr>
		<td>
			Nature Document Identit&eacute; :
		</td>
		<td>
			<input type="text" name="nature_document_identite" id="nature_document_identite" value="<?echo affichage_input(affichage($valeur["nature_document_identite"]));?>">
		</td>
	</tr>
	<tr>
		<td>
			Numero Document Identit&eacute; :
		</td>
		<td>
			<input type="text" name="numero_document_identite" id="numero_document_identite" value="<?echo affichage_input(affichage($valeur["numero_document_identite"]));?>">
		</td>
	</tr>
	<tr>
		<td>
			Radi&eacute; :
		</td>
		<td>
			<select name="radie" id="radie">
				<option value="0" <?if($valeur["radie"] == "0"){echo "selected";}?>>Non</option>
				<option value="1" <?if($valeur["radie"] == "1"){echo "selected";}?>>Oui</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Motif radiation :
		</td>
		<td>
			<input type="text" name="motif_RAD_temp" id="motif_RAD_temp" value="<?echo affichage_input(affichage($valeur["motif_RAD_temp"]));?>">
		</td>
	</tr>
	<tr>
		<td>
			Date radiation :
		</td>
		<td>		
		<?if($valeur["radie"] != "0"){
		if(!$vraies_dates || $vraies_dates_radiation != true){
			echo "<font color='#FF0000'>Mettre &agrave; jour la date</font><br>";
			echo affichage($valeur["date_radiation_temp"])."<br>";
		}}?>
		ann&eacute;e/mois/jour : <input maxlength="4" type="text" size="10" name="annee_radiation" id="annee_radiation" value="<?if($vraies_dates){if(substr($date_dom["date_radiation"],0,4) == "0000"){echo "";}else{echo substr($date_dom["date_radiation"],0,4);}}?>">
								&nbsp;<select name="mois_radiation" id="mois_radiation">
										<option value="00" <?if($vraies_dates && substr($date_dom["date_radiation"],4,2) == "00"){echo "SELECTED";}?>>-</option>
										<option value="01" <?if($vraies_dates && substr($date_dom["date_radiation"],4,2) == "01"){echo "SELECTED";}?>>Janvier</option>
										<option value="02" <?if($vraies_dates && substr($date_dom["date_radiation"],4,2) == "02"){echo "SELECTED";}?>>F&eacute;vrier</option>
										<option value="03" <?if($vraies_dates && substr($date_dom["date_radiation"],4,2) == "03"){echo "SELECTED";}?>>Mars</option>
										<option value="04" <?if($vraies_dates && substr($date_dom["date_radiation"],4,2) == "04"){echo "SELECTED";}?>>Avril</option>
										<option value="05" <?if($vraies_dates && substr($date_dom["date_radiation"],4,2) == "05"){echo "SELECTED";}?>>Mai</option>
										<option value="06" <?if($vraies_dates && substr($date_dom["date_radiation"],4,2) == "06"){echo "SELECTED";}?>>Juin</option>
										<option value="07" <?if($vraies_dates && substr($date_dom["date_radiation"],4,2) == "07"){echo "SELECTED";}?>>Juillet</option>
										<option value="08" <?if($vraies_dates && substr($date_dom["date_radiation"],4,2) == "08"){echo "SELECTED";}?>>Aout</option>
										<option value="09" <?if($vraies_dates && substr($date_dom["date_radiation"],4,2) == "09"){echo "SELECTED";}?>>Septembre</option>
										<option value="10" <?if($vraies_dates && substr($date_dom["date_radiation"],4,2) == "10"){echo "SELECTED";}?>>Octobre</option>
										<option value="11" <?if($vraies_dates && substr($date_dom["date_radiation"],4,2) == "11"){echo "SELECTED";}?>>Novembre</option>
										<option value="12" <?if($vraies_dates && substr($date_dom["date_radiation"],4,2) == "12"){echo "SELECTED";}?>>D&eacute;cembre</option>
									  </select>
								&nbsp;<select name="jour_radiation" id="jour_radiation" >
										<option value="00"
										<?if($vraies_dates 
											&& substr($date_dom["date_radiation"],6,2) == "00"){
												echo "SELECTED";
										}?>>-</option>
										<?for($jour=1;$jour<=31;$jour++){?>
											<option value="<?if($jour < 10){echo "0";}echo $jour;?>"
											<?if($vraies_dates 
											&& (substr($date_dom["date_radiation"],6,2) == "0".$jour 
											|| substr($date_dom["date_radiation"],6,2) == $jour)){
												echo "SELECTED";
											}?>>
												<?if($jour < 10){echo "0";}echo $jour;?>
											</option>
										<?}?>
									   </select>
		</td>
	</tr>
	<tr>
		<td>
			Date de la premi&egrave;re incription :
		</td>
		<td>
		<?
		if(!$vraies_dates || $vraies_dates_1_ere_inscription != true){
			echo "<font color='#FF0000'>Mettre &agrave; jour la date</font><br>";
			echo affichage($valeur["date_1_ere_inscription"])."<br>";
		}?>
		ann&eacute;e/mois/jour : <input maxlength="4" type="text" size="10" name="annee_1_ere_inscription" id="annee_1_ere_inscription" value="<?if($vraies_dates){if(substr($date_dom["date_1_ere_inscription"],0,4) == "0000"){}else{echo substr($date_dom["date_1_ere_inscription"],0,4);}}?>">
								&nbsp;<select name="mois_1_ere_inscription" id="mois_1_ere_inscription">
										<option value="00" <?if($vraies_dates && substr($date_dom["date_1_ere_inscription"],4,2) == "00"){echo "SELECTED";}?>>-</option>
										<option value="01" <?if($vraies_dates && substr($date_dom["date_1_ere_inscription"],4,2) == "01"){echo "SELECTED";}?>>Janvier</option>
										<option value="02" <?if($vraies_dates && substr($date_dom["date_1_ere_inscription"],4,2) == "02"){echo "SELECTED";}?>>F&eacute;vrier</option>
										<option value="03" <?if($vraies_dates && substr($date_dom["date_1_ere_inscription"],4,2) == "03"){echo "SELECTED";}?>>Mars</option>
										<option value="04" <?if($vraies_dates && substr($date_dom["date_1_ere_inscription"],4,2) == "04"){echo "SELECTED";}?>>Avril</option>
										<option value="05" <?if($vraies_dates && substr($date_dom["date_1_ere_inscription"],4,2) == "05"){echo "SELECTED";}?>>Mai</option>
										<option value="06" <?if($vraies_dates && substr($date_dom["date_1_ere_inscription"],4,2) == "06"){echo "SELECTED";}?>>Juin</option>
										<option value="07" <?if($vraies_dates && substr($date_dom["date_1_ere_inscription"],4,2) == "07"){echo "SELECTED";}?>>Juillet</option>
										<option value="08" <?if($vraies_dates && substr($date_dom["date_1_ere_inscription"],4,2) == "08"){echo "SELECTED";}?>>Aout</option>
										<option value="09" <?if($vraies_dates && substr($date_dom["date_1_ere_inscription"],4,2) == "09"){echo "SELECTED";}?>>Septembre</option>
										<option value="10" <?if($vraies_dates && substr($date_dom["date_1_ere_inscription"],4,2) == "10"){echo "SELECTED";}?>>Octobre</option>
										<option value="11" <?if($vraies_dates && substr($date_dom["date_1_ere_inscription"],4,2) == "11"){echo "SELECTED";}?>>Novembre</option>
										<option value="12" <?if($vraies_dates && substr($date_dom["date_1_ere_inscription"],4,2) == "12"){echo "SELECTED";}?>>D&eacute;cembre</option>
									  </select>
								&nbsp;<select name="jour_1_ere_inscription" id="jour_1_ere_inscription" >
										<option value="00"
										<?if($vraies_dates 
											&& substr($date_dom["date_1_ere_inscription"],6,2) == "00"){
												echo "SELECTED";
										}?>>-</option>
										<?for($jour=1;$jour<=31;$jour++){?>
											<option value="<?if($jour < 10){echo "0";}echo $jour;?>"
											<?if($vraies_dates 
											&& (substr($date_dom["date_1_ere_inscription"],6,2) == "0".$jour 
											|| substr($date_dom["date_1_ere_inscription"],6,2) == $jour)){
												echo "SELECTED";
											}?>>
												<?if($jour < 10){echo "0";}echo $jour;?>
											</option>
										<?}?>
									   </select>
		</td>
	</tr>
	<tr>
		<td>
			Date dernier certificat :
		</td>
		<td>
				<?
		if(!$vraies_dates || $vraies_dates_certificat != true){
			echo "<font color='#FF0000'>Mettre &agrave; jour la date</font><br>";
			echo affichage($valeur["date_certificat"])."<br>";
		}?>
		ann&eacute;e/mois/jour : <input maxlength="4" type="text" size="10" name="annee_certificat" id="annee_certificat" value="<?if($vraies_dates){if(substr($date_dom["date_certificat"],0,4) == "0000"){echo "";}else{echo substr($date_dom["date_certificat"],0,4);}}?>">
								&nbsp;<select name="mois_certificat" id="mois_certificat">
										<option value="00" <?if($vraies_dates && substr($date_dom["date_certificat"],4,2) == "00"){echo "SELECTED";}?>>-</option>
										<option value="01" <?if($vraies_dates && substr($date_dom["date_certificat"],4,2) == "01"){echo "SELECTED";}?>>Janvier</option>
										<option value="02" <?if($vraies_dates && substr($date_dom["date_certificat"],4,2) == "02"){echo "SELECTED";}?>>F&eacute;vrier</option>
										<option value="03" <?if($vraies_dates && substr($date_dom["date_certificat"],4,2) == "03"){echo "SELECTED";}?>>Mars</option>
										<option value="04" <?if($vraies_dates && substr($date_dom["date_certificat"],4,2) == "04"){echo "SELECTED";}?>>Avril</option>
										<option value="05" <?if($vraies_dates && substr($date_dom["date_certificat"],4,2) == "05"){echo "SELECTED";}?>>Mai</option>
										<option value="06" <?if($vraies_dates && substr($date_dom["date_certificat"],4,2) == "06"){echo "SELECTED";}?>>Juin</option>
										<option value="07" <?if($vraies_dates && substr($date_dom["date_certificat"],4,2) == "07"){echo "SELECTED";}?>>Juillet</option>
										<option value="08" <?if($vraies_dates && substr($date_dom["date_certificat"],4,2) == "08"){echo "SELECTED";}?>>Aout</option>
										<option value="09" <?if($vraies_dates && substr($date_dom["date_certificat"],4,2) == "09"){echo "SELECTED";}?>>Septembre</option>
										<option value="10" <?if($vraies_dates && substr($date_dom["date_certificat"],4,2) == "10"){echo "SELECTED";}?>>Octobre</option>
										<option value="11" <?if($vraies_dates && substr($date_dom["date_certificat"],4,2) == "11"){echo "SELECTED";}?>>Novembre</option>
										<option value="12" <?if($vraies_dates && substr($date_dom["date_certificat"],4,2) == "12"){echo "SELECTED";}?>>D&eacute;cembre</option>
									  </select>
								&nbsp;<select name="jour_certificat" id="jour_certificat" >
										<option value="00"
										<?if($vraies_dates 
											&& substr($date_dom["date_certificat"],6,2) == "00"){
												echo "SELECTED";
										}?>>-</option>
										<?for($jour=1;$jour<=31;$jour++){?>
											<option value="<?if($jour < 10){echo "0";}echo $jour;?>"
											<?if($vraies_dates 
											&& (substr($date_dom["date_certificat"],6,2) == "0".$jour 
											|| substr($date_dom["date_certificat"],6,2) == $jour)){
												echo "SELECTED";
											}?>>
												<?if($jour < 10){echo "0";}echo $jour;?>
											</option>
										<?}?>
									   </select>
		</td>
	</tr>
 
	<?if(isset($_GET['droits']) && $_GET['droits'] != "I" && $_GET['droits'] != "C" && $_GET['droits'] != ""){?>
	<tr>
		<td colspan="2" align="center">
			<input type="button" value="Modifier" onclick="
if(!isNaN(document.getElementById('annee_naissance').value) && !isNaN(document.getElementById('annee_radiation').value) && !isNaN(document.getElementById('annee_1_ere_inscription').value) && !isNaN(document.getElementById('annee_certificat').value)){
document.getElementById('alert').innerHTML='';writediv(file('./contenu/modif_dom.php?modification=true&droits=<?echo $_GET['droits']?>&id_user=<?echo $_GET["id_user"];?>&id=<?echo urlencode($_GET["id"]);?>&ancien_N='+document.getElementById('ancien_N').value+'&CIVILITE='+document.getElementById('CIVILITE').value+'&NOM='+document.getElementById('NOM').value+'&PRENOM='+document.getElementById('PRENOM').value+'&id_statut='+document.getElementById('id_statut').value+'&NOM_MARITAL='+document.getElementById('NOM_MARITAL').value+'&annee_naissance='+document.getElementById('annee_naissance').value+'&mois_naissance='+document.getElementById('mois_naissance').value+'&jour_naissance='+document.getElementById('jour_naissance').value+'&pays='+document.getElementById('pays').value+'&ville_naissance='+document.getElementById('ville_naissance').value+'&nationalite2='+document.getElementById('nationalite').value+'&contacts='+document.getElementById('contacts').value+'&nature_document_identite='+document.getElementById('nature_document_identite').value+'&numero_document_identite='+document.getElementById('numero_document_identite').value+'&radie2='+document.getElementById('radie').value+'&motif_RAD_temp='+document.getElementById('motif_RAD_temp').value+'&annee_radiation='+document.getElementById('annee_radiation').value+'&mois_radiation='+document.getElementById('mois_radiation').value+'&jour_radiation='+document.getElementById('jour_radiation').value+'&annee_1_ere_inscription='+document.getElementById('annee_1_ere_inscription').value+'&mois_1_ere_inscription='+document.getElementById('mois_1_ere_inscription').value+'&jour_1_ere_inscription='+document.getElementById('jour_1_ere_inscription').value+'&annee_certificat='+document.getElementById('annee_certificat').value+'&mois_certificat='+document.getElementById('mois_certificat').value+'&jour_certificat='+document.getElementById('jour_certificat').value+'<?if(isset($_GET)){if(isset($_GET["immeuble"])){?>&immeuble=<?echo $_GET["immeuble"];}if(isset($_GET["num"])){?>&num=<?echo $_GET["num"];}if(isset($_GET["civilite"])){?>&civilite=<?echo $_GET["civilite"];}if(isset($_GET["nom"])){?>&nom=<?echo $_GET["nom"];}if(isset($_GET["prenom"])){?>&prenom=<?echo $_GET["prenom"];}if(isset($_GET["date_naissance"])){?>&date_naissance=<?echo $_GET["date_naissance"];}if(isset($_GET["lieu_naissance"])){?>&lieu_naissance=<?echo $_GET["lieu_naissance"];}if(isset($_GET["pays_naissance"])){?>&pays_naissance=<?echo $_GET["pays_naissance"];}if(isset($_GET["nationalite"])){?>&nationalite=<?echo $_GET["nationalite"];}if(isset($_GET["radie"])){?>&radie=<?echo $_GET["radie"];}if(isset($_GET["date_debut_radie"])){?>&date_debut_radie=<?echo $_GET["date_debut_radie"];}if(isset($_GET["date_fin_radie"])){?>&date_fin_radie=<?echo $_GET["date_fin_radie"];?><?}if(isset($_GET["limit"])){?>&limit=<?echo $_GET["limit"];}if(isset($_GET["limit_2"])){?>&limit_2=<?echo $_GET["limit_2"];}}?>'))}else{alert('Une ann&eacute;e que vous avez saisi est mal form&eacute;e. V&eacute;rifiez votre saisie');}">
		</td>
	</tr>
	<?}?>
</table>
<?}
}?>