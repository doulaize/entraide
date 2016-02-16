<?
	include('../action_bdd/action_bdd.php');
	include('../include/fonctions.php');
	$fichiers=select_all_file();
	$signataires = select_all_signataires_with_T();
	if(isset($_GET)){
		$id_utilisateur = $_GET["id_user"];
		$id_domicilie = $_GET["id"];
	}
	else{
		echo "Qu'est ce que vous faites ici ?! ";exit();
	}
	if(!isset($_GET["action"]) || $_GET["action"] ==""){?>
	<table>
		<tr>
			<td>Choisissez un fichier</td>
			<td>
				<select id="nom_fichier">
				<?while($valeur=mysql_fetch_array($fichiers,ENT_QUOTES)){?>
					<option value="<?echo $valeur["id"];?>"><?echo $valeur["nom_fichier"];?></option>
				<?}?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Choisissez un signataire</td>
			<td>
				<select id="signataire">
				<?while($valeur=mysql_fetch_array($signataires,ENT_QUOTES)){?>
					<option value="<?echo $valeur["id"];?>"><?echo $valeur["nom"]." ".$valeur["prenom"];?></option>
				<?}?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="button" onclick="window.open('./contenu/impression_sortie.php?action=sortir&nom_fichier='+document.getElementById('nom_fichier').value+'&id_user=<?echo $id_utilisateur;?>&id=<?echo $id_domicilie;?>&id_signataire='+document.getElementById('signataire').value);" value="Envoyer !">
			</td>
	</table>
	
	
<?
}
elseif($_GET["action"] == "sortir"){

	insert_stat_sortie($_GET["id"], $_GET["nom_fichier"], $_GET["id_user"], $_GET["id_signataire"]);
	$sign = mysql_fetch_array(select_signataire($_GET["id_signataire"]), ENT_QUOTES);
	$domicilie = select_domicilie($_GET["id"]);
	$infos = mysql_fetch_array($domicilie,ENT_QUOTES);
	$dates=select_date($infos["id"]);
	$infos_dates=mysql_fetch_array($dates,ENT_QUOTES);
	
$file = select_file($_GET["nom_fichier"]);
$file_name=mysql_fetch_array($file,ENT_QUOTES);

$CheminFichier = "/Users/Raf/Documents/Code/web/Php/entraide/SORTIES/".$file_name["nom_fichier"];
$nouveau_fichier = $CheminFichier."_temp.rtf";
touch($CheminFichier);
copy($CheminFichier, $nouveau_fichier);
/*
$fp=fopen($CheminFichier,"r"); // Ouverture du fichier avec le mode lecture

	$contenu="";
	while ( !feof ( $fp ) ){
      $contenu .= fgets ( $fp , 4096 ) ;
	  echo $contenu."<br>";
	}
	*/
	$contenu = file_get_contents($CheminFichier);

	$nom=" ";
	$prenom=" ";
	$id=" ";
	$nouveau_N=" ";
	$ancien_N=" ";
	$date_1_ere_inscription=" ";
	$date_certificat=" ";
	$radie=" ";
	$CIVILITE=" ";
	$NOM_MARITAL=" ";
	$date_naissance=" ";
	$lieu_naissance=" ";
	$pays=" ";
	$nationalite=" ";
	$nature_document_identite=" ";
	$numero_document_identite=" ";
	$contacts=" ";
	$nationalite_temp=" ";
	$pays_temp=" ";
	$motif_RAD_temp=" ";
	$date_radiation_temp=" ";
	$id_statut=" ";
	$vraie_date_naissance=" ";
	$vraie_date_certificat=" ";
	$vraie_date_1_ere_inscription=" ";
	$vraie_date_radiation=" ";
	//echo $infos["date_1_ere_inscription"] ;exit();
	if($infos["NOM"] != "")
		$nom = $infos["NOM"];
	if($infos["PRENOM"] != "")
		$prenom = $infos["PRENOM"];
	if($infos["id"] != "")
		$id = $infos["id"];
	if($infos["nouveau_N"] != "")
		$nouveau_N = $infos["nouveau_N"];
	if($infos["ancien_N"] != "")
		$ancien_N = $infos["ancien_N"];
	if($infos["date_1_ere_inscription"] != "")
		$date_1_ere_inscription = $infos["date_1_ere_inscription"];
	if($infos["date_certificat"] != "")
		$date_certificat = $infos["date_certificat"];
	if($infos["radie"] != "")
	{
		if($infos["radie"] == 0)
			$radie = "Non";
		if($infos["radie"] == 1)
			$radie = "Oui";
	}
	if($infos["CIVILITE"] != "")
		$CIVILITE = $infos["CIVILITE"];
	if($infos["NOM_MARITAL"] != "")
		$NOM_MARITAL = $infos["NOM_MARITAL"];
//echo $infos["date_naissance"];exit();
	if($infos["date_naissance"] != "")
		$date_naissance = $infos["date_naissance"];
	if($infos["lieu_naissance"] != "")
		$lieu_naissance = $infos["lieu_naissance"];
	if($infos["pays"] != ""){
		$infos_pays = mysql_fetch_array(select_pays($infos["pays"]),ENT_QUOTES);
		$pays = $infos_pays["nom_pays"];
	}
	if($infos["nationalite"] != ""){
		$infos_nationalite = mysql_fetch_array(select_nationalite($infos["nationalite"]),ENT_QUOTES);
		$nationalite = $infos_nationalite["nom_nationalite"];
	}
	if($infos["nature_document_identite"] != "")
		$nature_document_identite = $infos["nature_document_identite"];
	if($infos["numero_document_identite"] != "")
		$numero_document_identite = $infos["numero_document_identite"];
	if($infos["contacts"] != "")
		$contacts = $infos["contacts"];
	if($infos["nationalite_temp"] != "")
		$nationalite_temp = $infos["nationalite_temp"];
	if($infos["pays_temp"] != "")
		$pays_temp = $infos["pays_temp"];
	if($infos["motif_RAD_temp"] != "")
		$motif_RAD_temp = $infos["motif_RAD_temp"];
	if($infos["date_radiation_temp"] != "")
		$date_radiation_temp = $infos["date_radiation_temp"];
	if($infos["id_statut"] != ""){
		$infos_statut = mysql_fetch_array(select_statut($infos["id_statut"]),ENT_QUOTES);
		$id_statut = $infos_statut["libelle_statut"];
	}

	if($infos["date_id"] != ""){
		$vraie_date_naissance = $infos_dates["date_naissance"];
		$vraie_date_certificat = $infos_dates["date_certificat"];
		$vraie_date_1_ere_inscription = $infos_dates["date_1_ere_inscription"];
		$date_radiation = $infos_dates["date_radiation"];
	}
$contenu = str_replace("XXXNOMXXX", utf8_decode(affichage_csv(affichage($nom))), $contenu);
$contenu = str_replace("XXXPRENOMXXX", utf8_decode(affichage_csv(affichage($prenom))), $contenu);
$contenu = str_replace("XXXidXXX", $id, $contenu);
$contenu = str_replace("XXXnouveau_NXXX", $nouveau_N, $contenu);
$contenu = str_replace("XXXnouveau_N_courtXXX", substr($nouveau_N,8,5), $contenu);
$contenu = str_replace("XXXancien_NXXX", $ancien_N, $contenu);
$contenu = str_replace("XXXdate_1_ere_inscriptionXXX", $date_1_ere_inscription, $contenu);
//echo $contenu;exit();
$contenu = str_replace("XXXdate_certificatXXX", $date_certificat, $contenu);
$contenu = str_replace("XXXradieXXX", $radie, $contenu);
$contenu = str_replace("XXXCIVILITEXXX", $CIVILITE, $contenu);
$contenu = str_replace("XXXNOM_MARITALXXX", utf8_decode(affichage_csv(affichage($NOM_MARITAL))), $contenu);
$contenu = str_replace("XXXdate_naissanceXXX", $date_naissance, $contenu);
$contenu = str_replace("XXXlieu_naissanceXXX", utf8_decode(affichage_csv(affichage($lieu_naissance))), $contenu);
$contenu = str_replace("XXXpaysXXX", utf8_decode(affichage_csv(affichage($pays))), $contenu);//
//$contenu = str_replace("XXXdeptXXX", utf8_decode(affichage_csv(affichage($infos["dept"], $contenu));
$contenu = str_replace("XXXnationaliteXXX", utf8_decode(affichage_csv(affichage($nationalite))), $contenu);//
$contenu = str_replace("XXXnature_document_identiteXXX", utf8_decode(affichage_csv(affichage($nature_document_identite))), $contenu);
$contenu = str_replace("XXXnumero_document_identiteXXX", utf8_decode(affichage_csv(affichage($numero_document_identite))), $contenu);
$contenu = str_replace("XXXcontactsXXX", utf8_decode(affichage_csv(affichage($contacts))), $contenu);
$contenu = str_replace("XXXnationalite_tempXXX", utf8_decode(affichage_csv(affichage($nationalite_temp))), $contenu);
$contenu = str_replace("XXXpays_tempXXX", utf8_decode(affichage_csv(affichage($pays_temp))), $contenu);
$contenu = str_replace("XXXmotif_RADXXX", utf8_decode(affichage_csv(affichage($motif_RAD_temp))), $contenu);
$contenu = str_replace("XXXdate_radiation_tempXXX", $date_radiation_temp, $contenu);
$contenu = str_replace("XXXid_statutXXX", utf8_decode(affichage_csv(affichage($id_statut))), $contenu);//
//$contenu = str_replace("XXXdate_idXXX", $infos["date_id"], $contenu);//

$test =  substr($vraie_date_naissance,6,2)."/".substr($vraie_date_naissance,4,2)."/".substr($vraie_date_naissance,0,4);
//echo $test;exit();
$contenu = str_replace("XXXvraie_date_naissanceXXX", $test, $contenu);
$test2 =  substr($vraie_date_certificat,6,2)."/".substr($vraie_date_certificat,4,2)."/".substr($vraie_date_certificat,0,4);
$contenu = str_replace("XXXvraie_date_certificatXXX", $test2, $contenu);
$test3 =  substr($vraie_date_1_ere_inscription,6,2)."/".substr($vraie_date_1_ere_inscription,4,2)."/".substr($vraie_date_1_ere_inscription,0,4);
$contenu = str_replace("XXXvraie_date_1_ere_incriptionXXX", $test3, $contenu);
$test4 =  substr($vraie_date_radiation,6,2)."/".substr($vraie_date_radiation,4,2)."/".substr($vraie_date_radiation,0,4);
$contenu = str_replace("XXXvraie_date_radiationXXX", $test4, $contenu);
$signataire = $sign["nom"]." ".$sign["prenom"];
$contenu = str_replace("XXXdate_systemeXXX", date('d/m/Y'), $contenu);

$date_plus = date('d')."/".date('m')."/".(date('Y')+1);
//echo $date_plus;exit();
$contenu = str_replace("XXXdate_systeme_plus_unXXX", $date_plus, $contenu);
$date_plus_2 = date('d')."/".date('m')."/".(date('Y')+2);
$contenu = str_replace("XXXdate_systeme_plus_deuxXXX", $date_plus_2, $contenu);
$contenu = str_replace("XXXsignataireXXX", $signataire , $contenu);
fclose($fp);
$fp=fopen($nouveau_fichier,"w"); // Ouverture du fichier avec le mode ecriture

fwrite($fp,$contenu); // Ceci ajoutera ou crira le contenu "texte ..." dans le fichier "le_fichier.txt"
fclose($fp);
$lStr = strlen($contenu);
echo "<script type='text/javascript'>alert('nouveau fichier $nouveau_fichier len $lStr ');</script>";
//echo $contenu;

function NomFichierSeul($CheminFichier){
     if(!empty($CheminFichier)){
     $pos = strrpos($CheminFichier, "\\"); //donne position du dernier \
     return substr($CheminFichier,$pos+1); //coupe aprs cette position
}
}
 function TailleFichier($fichier) {
      $taillefichier = 0;
    
     if(file_exists($fichier)){
          $taillefichier = filesize($fichier)/1000;
     } else {
          $taillefichier = 0;
     }
     return $taillefichier;
}

function ExtensionFichier($fichier) {
	echo "<script type='text/javascript'>alert('extension $fichier');</script>";
	$extension = '';
	if(file_exists("/Users/Raf/Documents/Code/web/Php/entraide/SORTIES/".$fichier))
	{
		$pos = strrpos($fichier, "."); //donne position du dernier \
		$extension = substr($fichier,$pos+1);
	}
	else
	{
		$extension = "?";
	}
	return $extension;
}

$NomFichierSeul = NomFichierSeul($CheminFichier."_temp.rtf");
$extension = ExtensionFichier($NomFichierSeul);//echo $extension;exit();

switch($extension){//echo $extension;exit();
     case "rtf": $typefichier="application/rtf"; break;
     default: $typefichier="application/force-download"; break;
} 	

		
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: ".$typefichier);
$header="Content-Disposition: attachment; filename=".$NomFichierSeul.";";
header($header );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($CheminFichier."_temp.rtf"));
@readfile($CheminFichier."_temp.rtf");
unlink($CheminFichier."_temp.rtf"); // Ceci supprimera le fichier
exit;
}
?>