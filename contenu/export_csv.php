<?
	include('../action_bdd/action_bdd.php');
	include('../include/fonctions.php');
	
$search_num=$_GET["search_num"];
$search_nom=$_GET["search_nom"];
$search_prenom=$_GET["search_prenom"];
$search_civilite=$_GET["search_civilite"];
$search_date_naissance=$_GET["search_date_naissance"];
$search_lieu_naissance=$_GET["search_lieu_naissance"];
$search_pays_naissance=$_GET["search_pays_naissance"];
$search_nationalite=$_GET["search_nationalite"];
$search_radie=$_GET["search_radie"];
$search_date_debut_radie=$_GET["search_date_debut_radie"];
$search_date_fin_radie=$_GET["search_date_fin_radie"];
$lst_ch=$_GET["lst_ch"];
//$search_immeuble = false;
	if(isset($_GET["immeuble"])){
		if($_GET["immeuble"] == "vrai"){
			$search_immeuble = true;}
		else{
			$search_immeuble = false;}
	}
	else{
		$search_immeuble = true;
	}
//fonction de récup des données
$data = select_domicilies_no_limit($search_immeuble,$search_num,$search_nom,$search_prenom,$search_civilite,$search_date_naissance,$search_lieu_naissance,$search_pays_naissance,$search_nationalite,$search_radie,$search_date_debut_radie,$search_date_fin_radie,$lst_ch);
$entete="";
$tab = split(',',$lst_ch);

foreach($tab as $key => $value){
	if($value == "1")
		$entete .= "ID;";
	if($value == "2")
		$entete .= "Nouveau numéro;";
	if($value == "3")
		$entete .= "Ancien numéro;";
	if($value == "4")
		$entete .= "date d'entrée;";
	if($value == "5")
		$entete .= "date dernier certificat;";
	if($value == "6")
		$entete .= "radie?;";
	if($value == "7")
		$entete .= "Civilité;";
	if($value == "8")
		$entete .= "Nom;";
	if($value == "9")
		$entete .= "statut;";
	if($value == "10")
		$entete .= "Prénom;";
	if($value == "11")
		$entete .= "date de naissance;";
	if($value == "12")
		$entete .= "lieu de naissance;";
	if($value == "13")
		$entete .= "pays;";
	if($value == "14")
		$entete .= "departement;";
	if($value == "15")
		$entete .= "nationalite;";
	if($value == "16")
		$entete .= "nature document identite;";
	if($value == "17")
		$entete .= "numero document identite;";
	if($value == "18")
		$entete .= "contact;";
	if($value == "19")
		$entete .= "ancienne nationalité;";
	if($value == "20")
		$entete .= "ancien pays;";
	if($value == "21")
		$entete .= "motif de radiation;";
	if($value == "22")
		$entete .= "ancienne date de radiation;";
	if($value == "23")
		$entete .= "type de statut;";
	if($value == "24")
	{
		$birth_date = true;
		$entete .= "date de naissance;";
	}
	if($value == "25"){
		$certif_date = true;
		$entete .= "date de certificat;";
	}
	if($value == "26"){
		$first_date = true;
		$entete .= "date de 1ere inscription;";
	}
	if($value == "27"){
		$actual_date = true;
		$entete .= "date de radiation;";
	}
}

//echo $entete;exit();
$ContenuFichier = $entete."\n";
$SQL_STATUTS = select_all_statut();
$SQL_DATE = select_all_date();
$toutes_dates ="";
$i=0;
while($dates = mysql_fetch_array($SQL_DATE,ENT_QUOTES)){
	$j=0;
	$k=0;
	foreach($dates as $key => $value){
		if($j == 0 || $j == 2 || $j == 4 || $j == 6 || $j == 8 || $j == 10)
		{
			$toutes_dates[$i][$k] = $value;
			$k=$k+1;
		}
			$j=$j+1;
	}
	$i=$i+1;
}
$total_dates = $i-1;
//print_r($toutes_dates);exit();

while($dom = mysql_fetch_array($data,ENT_QUOTES)){
$i = 1;
	foreach($dom as $key => $value){
	if($i%2==0){
		if($i/2==13){
		$SQL_PAYS = select_all_pays();
			while($tab_pays = mysql_fetch_array($SQL_PAYS,ENT_QUOTES)){
				if($tab_pays["id"] == $value)
				$ContenuFichier .= utf8_decode(affichage_csv(affichage($tab_pays["nom_pays"])))." ;";
			}
		}
		elseif($i/2==15){
$SQL_NATIONALITE = select_all_nationalite();
			while($tab_nat= mysql_fetch_array($SQL_NATIONALITE,ENT_QUOTES)){
				if($tab_nat["id"] == $value)
				$ContenuFichier .= utf8_decode(affichage_csv(affichage($tab_nat["nom_nationalite"])))." ;";
			}
		}
		elseif($i/2== 23){
			while($tab_statut= mysql_fetch_array($SQL_STATUTS,ENT_QUOTES)){
				if($tab_statut["id"] == $value)
				$ContenuFichier .= utf8_decode(affichage_csv(affichage($tab_statut["libelle_statut"])));
			}
			$ContenuFichier .= " ;";
		}
		elseif($i/2== 24){
			if($birth_date == true || $certif_date == true || $first_date == true || $actual_date == true){
			$l=0;
				for($l=0;$l<=$total_dates;$l++){
					if($toutes_dates[$l][0] == $value){
							$test =  substr($toutes_dates[$l][2],6,2)."/".substr($toutes_dates[$l][2],4,2)."/".substr($toutes_dates[$l][2],0,4);
$test2 =  substr($toutes_dates[$l][3],6,2)."/".substr($toutes_dates[$l][3],4,2)."/".substr($toutes_dates[$l][3],0,4);
$test3 =  substr($toutes_dates[$l][4],6,2)."/".substr($toutes_dates[$l][4],4,2)."/".substr($toutes_dates[$l][4],0,4);
$test4 =  substr($toutes_dates[$l][5],6,2)."/".substr($toutes_dates[$l][5],4,2)."/".substr($toutes_dates[$l][5],0,4);
						if($birth_date == true)
							$ContenuFichier .= utf8_decode(affichage_csv(affichage($test)))." ;";
						if($certif_date == true) 
							$ContenuFichier .= utf8_decode(affichage_csv(affichage($test2)))." ;";
						if($first_date == true) 
							$ContenuFichier .= utf8_decode(affichage_csv(affichage($test3)))." ;";
						if($actual_date == true)
							$ContenuFichier .= utf8_decode(affichage_csv(affichage($test4)))." ;";
					}
				}
				$toutes_dates;
			}
		}
		else {
			$ContenuFichier .= utf8_decode(affichage_csv(affichage($value)))." ;";
		}
	}
	$i = $i+1;
	}
	$ContenuFichier .= "\n";
}

$CheminFichier = "../export/export.csv";
touch($CheminFichier);
$fp=fopen($CheminFichier,"w"); // Ouverture du fichier avec le mode écriture
fwrite($fp,$ContenuFichier); // Ceci ajoutera ou crira le contenu "texte ..." dans le fichier "le_fichier.txt"
fclose($fp);

$NomFichierSeul = basename($CheminFichier);
$extension = pathinfo($CheminFichier, PATHINFO_EXTENSION);

switch($extension){
     case "csv": $typefichier="application/csv"; break;
     default: $typefichier="application/force-download"; break;
} 
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: application/csv");
$header="Content-Disposition: attachment; filename=".$NomFichierSeul.";";
header($header );
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($CheminFichier));
@readfile($CheminFichier);
unlink($CheminFichier); // Ceci supprimera le fichier texte nom_du_fichier.txt
exit;
?>