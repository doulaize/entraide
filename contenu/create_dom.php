<?
include('../action_bdd/action_bdd.php');
include('../include/fonctions.php');

if(isset($_GET["creation"]) && $_GET["creation"] == "true"){
		 $nouveau_N = create_dom($_GET['ancien_N'],$_GET['CIVILITE'],$_GET['NOM'],$_GET['PRENOM'],$_GET['id_statut'],$_GET['NOM_MARITAL'],$_GET['annee_naissance'],$_GET['mois_naissance'],$_GET['jour_naissance'],$_GET['pays'],$_GET['ville_naissance'],$_GET['nationalite'],$_GET['contacts'],$_GET['nature_document_identite'],$_GET['numero_document_identite'],$_GET['radie'],$_GET['motif_RAD_temp'],$_GET['annee_radiation'],$_GET['mois_radiation'],$_GET['jour_radiation'],$_GET['annee_1_ere_inscription'],$_GET['mois_1_ere_inscription'],$_GET['jour_1_ere_inscription'],$_GET['annee_certificat'],$_GET['mois_certificat'],$_GET['jour_certificat'],$_GET['ancien_N']);
$message="<font color='#00FF00'>Vous avez bien cr&eacute;&eacute; le domicili&eacute;, son num&eacute;ro est : ".$nouveau_N."<br> pour le visualiser, veuillez effectuer une recherche.</font>";
echo $message;
}
?>
<table>
	<input type="hidden" id="ancien_N" name="ancien_N" value="">
<tr>
		<td>
			Ancien num&eacute;ro : 
		</td>
		<td>
			<input type="text" name="ancien_N" id="ancien_N">
		</td>
	</tr>	
	<tr>
		<td>
			Civilit&eacute; : 
		</td>
		<td>
			<select id="CIVILITE" name="CIVILITE">
				<option value="">-</option>
				<option value="MR">Monsieur</option>
				<option value="MME">Madame</option>
				<option value="MLLE">Mademoiselle</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Nom :
		</td>
		<td>
			<input type="text" name="NOM" id="NOM" value="">
		</td>
	</tr>
	<tr>
		<td>
			Pr&eacute;nom :
		</td>
		<td>
			<input type="text" name="PRENOM" id="PRENOM" value="">
		</td>
	</tr>
	<tr>
		<td>
			Statut :
		</td>
		<td>
			<select name="id_statut" id="id_statut">
				<option value="0">-</option>
			<?
				$status = select_all_statut();
				while($res = mysql_fetch_array($status,MYSQL_ASSOC)){
					?><option value="<?echo $res["id"];?>"><?echo $res["libelle_statut"];?></option><?
				}?>
			<input type="text" name="NOM_MARITAL" id="NOM_MARITAL" value="">
		</td>
	</tr>
	<tr>
		<td>
			Date de Naissance :
		</td>
		<td>
		ann&eacute;e/mois/jour : <input maxlength="4" type="text" size="10" name="annee_naissance" id="annee_naissance" value="">
								&nbsp;<select name="mois_naissance" id="mois_naissance">
										<option value="00">-</option>
										<option value="01">Janvier</option>
										<option value="02">F&eacute;vrier</option>
										<option value="03">Mars</option>
										<option value="04">Avril</option>
										<option value="05">Mai</option>
										<option value="06">Juin</option>
										<option value="07">Juillet</option>
										<option value="08">Aout</option>
										<option value="09">Septembre</option>
										<option value="10">Octobre</option>
										<option value="11">Novembre</option>
										<option value="12">D&eacute;cembre</option>
									  </select>
								&nbsp;<select name="jour_naissance" id="jour_naissance" >
										<option value="00">-</option>
										<?for($jour=1;$jour<=31;$jour++){?>
											<option value="<?if($jour < 10){echo "0";}echo $jour;?>">
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
			<?$pays = select_all_pays();?>
			<select name="pays" id="pays">
				<option value="0">-</option>
			<?while($res_pays = mysql_fetch_array($pays,MYSQL_ASSOC)){?><option value="<?echo $res_pays["id"];?>"><?echo $res_pays["nom_pays"];?></option><?}?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Ville de Naissance :
		</td>
		<td>
			<input type="text" name="ville_naissance" id="ville_naissance" value="">
		</td>
	</tr>
	<tr>
		<td>
			Nationalit&eacute; :
		</td>
		<td>
		<?$nationalite = select_all_nationalite();?>
			<select name="nationalite" id="nationalite">
				<option value="0">-</option>
			<?while($res_nationalite = mysql_fetch_array($nationalite,MYSQL_ASSOC)){?><option value="<?echo $res_nationalite["id"];?>"><?echo affichage($res_nationalite["nom_nationalite"]);?></option><?}?>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Contact :
		</td>
		<td>
			<input type="text" name="contacts" id="contacts" value="">
		</td>
	</tr>
	<tr>
		<td>
			Nature Document Identit&eacute; :
		</td>
		<td>
			<input type="text" name="nature_document_identite" id="nature_document_identite" value="">
		</td>
	</tr>
	<tr>
		<td>
			Numero Document Identit&eacute; :
		</td>
		<td>
			<input type="text" name="numero_document_identite" id="numero_document_identite" value="">
		</td>
	</tr>
	<tr>
		<td>
			Radi&eacute; :
		</td>
		<td>
			<select name="radie" id="radie">
				<option value="0">Non</option>
				<option value="1">Oui</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Motif radiation :
		</td>
		<td>
			<input type="text" name="motif_RAD_temp" id="motif_RAD_temp" value="">
		</td>
	</tr>
	<tr>
		<td>
			Date radiation :
		</td>
		<td>		
		ann&eacute;e/mois/jour : <input maxlength="4" type="text" size="10" name="annee_radiation" id="annee_radiation" value="">
								&nbsp;<select name="mois_radiation" id="mois_radiation">
										<option value="00">-</option>
										<option value="01">Janvier</option>
										<option value="02">F&eacute;vrier</option>
										<option value="03">Mars</option>
										<option value="04">Avril</option>
										<option value="05">Mai</option>
										<option value="06">Juin</option>
										<option value="07">Juillet</option>
										<option value="08">Aout</option>
										<option value="09">Septembre</option>
										<option value="10">Octobre</option>
										<option value="11">Novembre</option>
										<option value="12">D&eacute;cembre</option>
									  </select>
								&nbsp;<select name="jour_radiation" id="jour_radiation" >
										<option value="00">-</option>
										<?for($jour=1;$jour<=31;$jour++){?>
											<option value="<?if($jour < 10){echo "0";}echo $jour;?>">
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
		ann&eacute;e/mois/jour : <input maxlength="4" type="text" size="10" name="annee_1_ere_inscription" id="annee_1_ere_inscription" value="<?echo date('Y');?>">
								&nbsp;<select name="mois_1_ere_inscription" id="mois_1_ere_inscription">
										<option value="00">-</option>
										<option value="01"<?if(date('m') == "01") echo " selected";?>>Janvier</option>
										<option value="02"<?if(date('m') == "02") echo " selected";?>>F&eacute;vrier</option>
										<option value="03"<?if(date('m') == "03") echo " selected";?>>Mars</option>
										<option value="04"<?if(date('m') == "04") echo " selected";?>>Avril</option>
										<option value="05"<?if(date('m') == "05") echo " selected";?>>Mai</option>
										<option value="06"<?if(date('m') == "06") echo " selected";?>>Juin</option>
										<option value="07"<?if(date('m') == "07") echo " selected";?>>Juillet</option>
										<option value="08"<?if(date('m') == "08") echo " selected";?>>Aout</option>
										<option value="09"<?if(date('m') == "09") echo " selected";?>>Septembre</option>
										<option value="10"<?if(date('m') == "10") echo " selected";?>>Octobre</option>
										<option value="11"<?if(date('m') == "11") echo " selected";?>>Novembre</option>
										<option value="12"<?if(date('m') == "12") echo " selected";?>>D&eacute;cembre</option>
									  </select>
								&nbsp;<select name="jour_1_ere_inscription" id="jour_1_ere_inscription" >
										<option value="00">-</option>
										<?for($jour=1;$jour<=31;$jour++){?>
											<option value="<?if($jour < 10){echo "0".$jour."\"";if(date('d') == "0".$jour) echo " selected";}else{echo $jour."\"";if(date('d') == $jour) echo " selected";}?>>
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
		ann&eacute;e/mois/jour : <input maxlength="4" type="text" size="10" name="annee_certificat" id="annee_certificat" value="<?echo date('Y');?>">
								&nbsp;<select name="mois_certificat" id="mois_certificat">
										<option value="00">-</option>
										<option value="01"<?if(date('m') == "01") echo " selected";?>>Janvier</option>
										<option value="02"<?if(date('m') == "02") echo " selected";?>>F&eacute;vrier</option>
										<option value="03"<?if(date('m') == "03") echo " selected";?>>Mars</option>
										<option value="04"<?if(date('m') == "04") echo " selected";?>>Avril</option>
										<option value="05"<?if(date('m') == "05") echo " selected";?>>Mai</option>
										<option value="06"<?if(date('m') == "06") echo " selected";?>>Juin</option>
										<option value="07"<?if(date('m') == "07") echo " selected";?>>Juillet</option>
										<option value="08"<?if(date('m') == "08") echo " selected";?>>Aout</option>
										<option value="09"<?if(date('m') == "09") echo " selected";?>>Septembre</option>
										<option value="10"<?if(date('m') == "10") echo " selected";?>>Octobre</option>
										<option value="11"<?if(date('m') == "11") echo " selected";?>>Novembre</option>
										<option value="12"<?if(date('m') == "12") echo " selected";?>>D&eacute;cembre</option>
									  </select>
								&nbsp;<select name="jour_certificat" id="jour_certificat" >
										<option value="00">-</option>
										<?for($jour=1;$jour<=31;$jour++){?>
											<option value="<?if($jour < 10){echo "0".$jour."\"";if(date('d') == "0".$jour) echo " selected";}else{echo $jour."\"";if(date('d') == $jour) echo " selected";}?>>
												<?if($jour < 10){echo "0";}echo $jour;?>
											</option>
										<?}?>
									   </select>
		</td>
	</tr>
	<?if(isset($_GET['droits']) && $_GET['droits'] != "I" && $_GET['droits'] != ""){?>
	<tr>
		<td colspan="2" align="center">
			<input type="button" value="Cr&eacute;er" onclick="
if(document.getElementById('NOM').value != ''){if(!isNaN(document.getElementById('annee_naissance').value) && !isNaN(document.getElementById('annee_radiation').value) && !isNaN(document.getElementById('annee_1_ere_inscription').value) && !isNaN(document.getElementById('annee_certificat').value)){
document.getElementById('alert').innerHTML='';writediv(file('./contenu/create_dom.php?creation=true&droits=<?echo $_GET['droits']?>&ancien_N='+document.getElementById('ancien_N').value+'&CIVILITE='+document.getElementById('CIVILITE').value+'&NOM='+document.getElementById('NOM').value+'&PRENOM='+document.getElementById('PRENOM').value+'&id_statut='+document.getElementById('id_statut').value+'&NOM_MARITAL='+document.getElementById('NOM_MARITAL').value+'&annee_naissance='+document.getElementById('annee_naissance').value+'&mois_naissance='+document.getElementById('mois_naissance').value+'&jour_naissance='+document.getElementById('jour_naissance').value+'&pays='+document.getElementById('pays').value+'&ville_naissance='+document.getElementById('ville_naissance').value+'&nationalite='+document.getElementById('nationalite').value+'&contacts='+document.getElementById('contacts').value+'&nature_document_identite='+document.getElementById('nature_document_identite').value+'&numero_document_identite='+document.getElementById('numero_document_identite').value+'&radie='+document.getElementById('radie').value+'&motif_RAD_temp='+document.getElementById('motif_RAD_temp').value+'&annee_radiation='+document.getElementById('annee_radiation').value+'&mois_radiation='+document.getElementById('mois_radiation').value+'&jour_radiation='+document.getElementById('jour_radiation').value+'&annee_1_ere_inscription='+document.getElementById('annee_1_ere_inscription').value+'&mois_1_ere_inscription='+document.getElementById('mois_1_ere_inscription').value+'&jour_1_ere_inscription='+document.getElementById('jour_1_ere_inscription').value+'&annee_certificat='+document.getElementById('annee_certificat').value+'&mois_certificat='+document.getElementById('mois_certificat').value+'&jour_certificat='+document.getElementById('jour_certificat').value)+'&ancien_N='+document.getElementById('ancien_N').value)}else{alert('Une ann&eacute;e que vous avez saisi est mal form&eacute;e. V&eacute;rifiez votre saisie');}}else {alert('Veuillez renseigner le nom');}">
		</td>
	</tr>
	<?}?>
</table>