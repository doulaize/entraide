<?
include("connexion.php");

function select_stat_per_user($id){
	$SQL = "select sorties.id as id ,sorties.date as ladate, fichiers.nom_fichier as nom_fichier, domiciliation.NOM as NOM, domiciliation.PRENOM as PRENOM, utilisateurs.nom from sorties,fichiers, domiciliation, utilisateurs where sorties.id_utilisateur=".$id." AND sorties.type = fichiers.id AND domiciliation.id = sorties.id_domicilie AND utilisateurs.id=sorties.id_utilisateur"; 
	$resultat = mysql_query($SQL);
	return $resultat;
}
function stat_sorties_nb_mois($mois,$annee){
	$SQL = "select count(*) as nb from sorties where date >'".$annee.$mois."00' AND date <='".$annee.$mois."31'";
	$resultat = mysql_query($SQL);
	return $resultat;
}
//insertion d'une stat de sortie
function insert_stat_sortie($id_domicilie, $nom_fichier, $id_utilisateur, $id_signataire){
	$SQL = "insert into sorties (id_domicilie,type,date,id_utilisateur,id_signataire) values(".$id_domicilie.",'".$nom_fichier."','".date('Ymd')."',".$id_utilisateur.",".$id_signataire.")";
	$resultat = mysql_query($SQL);
}

//récup de tous les utilisateurs sans les admins
function select_all_signataires(){
	$SQL="select * from utilisateurs where droits <> 'T'";
	$resultat = mysql_query($SQL);
	return $resultat;
}
function select_all_signataires_with_T(){
	$SQL="select * from utilisateurs where signature = 1";
	$resultat = mysql_query($SQL);
	return $resultat;
}
function select_signataire($id){
	$SQL="select * from utilisateurs where id = ".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}
function select_file($id){
	$SQL="select * from fichiers where id=".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}
function select_all_file(){
	$SQL="select * from fichiers";
	$resultat = mysql_query($SQL);
	return $resultat;
}
function delete_all_signataires(){
	$SQL="UPDATE utilisateurs set signature = 0 where droits <> 'T'";
	$resultat = mysql_query($SQL);
}
function set_signature($id){
	$SQL = "UPDATE utilisateurs set signature = 1 WHERE id=".$id;
	$resultat = mysql_query($SQL);
}
function select_nb_signataires(){
	$SQL="select count(*) as nb from utilisateurs where droits <> 'T'";
	$resultat = mysql_query($SQL);
	return $resultat;
}

//listing des données personnelles
function select_modif_data($id)
{
	$SQL = "SELECT * FROM utilisateurs WHERE id=".$id;
	$traitement = mysql_query($SQL);
	$resultat = mysql_fetch_array($traitement);
	return $resultat;
}
//retourne la liste des droits gérables par l'utilisateur connecté
function select_liste_droits($droits)
{
//ICMT
if($droits == "I")
	return "<select id=\"droits\" name=\"droits\"><option value='I'>Invit&eacute;</option></select>";
elseif($droits == "C")
	return "<select id=\"droits\" name=\"droits\"><option value='I'>Invit&eacute;</option><option value='C'>Cr&eacute;ation</option></select>";
elseif($droits == "M")
	return "<select id=\"droits\" name=\"droits\"><option value='I'>Invit&eacute;</option><option value='C'>Cr&eacute;ation</option><option value='M'>Modification</option></select>";
elseif($droits == "T")
	return "<select id=\"droits\" name=\"droits\"><option value='I'>Invit&eacute;</option><option value='C'>Cr&eacute;ation</option><option value='M'>Modification</option><option value='T'>Tous les droits</option></select>";
}
//récupération SQL des utilisateurs
function select_users($droits)
{
if($droits == "I")
	return NULL;
elseif($droits == "C")
	$SQL = "select * from utilisateurs where droits='I'";
elseif($droits == "M")
	$SQL = "select * from utilisateurs where droits='I' or droits='C'";
elseif($droits == "T")
	$SQL = "select * from utilisateurs where droits='I' or droits='C' or droits='M'";
	
	$traitement = mysql_query($SQL);
	return $traitement;
}
function select_all_users(){
	$SQL = "select * from utilisateurs";
	$traitement = mysql_query($SQL);
	return $traitement;
}
//récup SQL d'un domicililié
function select_domicilie($id){
	$SQL = "select * from domiciliation where id=".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}

//fonction de récupération des droits de signature sur les sorties
function select_droits_signature(){
	$SQL = "select * from utilisateurs where signature=1";
	$resultat = mysql_query($SQL);
	return $resultat;
}

//fonction de recherche des domiciliés avec filtres
function select_domicilies($search_immeuble,$limit,$search_num,$search_nom,$search_prenom,$search_civilite,$search_date_naissance,$search_lieu_naissance,$search_pays_naissance,$search_nationalite,$search_radie,$search_date_debut_radie,$search_date_fin_radie){
	$SQL = "SELECT domiciliation.* FROM domiciliation ";
	if($search_date_debut_radie != "" || $search_date_fin_radie != ""){
		$SQL .= ",date_dom ";
	}
	$SQL .= " WHERE ";
	if($search_date_debut_radie != "" || $search_date_fin_radie != ""){
		$SQL .= " domiciliation.date_id = date_dom.id ";
	}

	elseif($search_date_debut_radie == "" && $search_date_fin_radie == ""){
		$SQL .= "1 = 1";
	}
	
	if($search_immeuble == false)
		$SQL .= " AND id not in (select id from domiciliation where id_statut = 1)";
	if($search_num != "")
		$SQL .= " AND nouveau_N LIKE('%".$search_num."%')";
	if($search_nom != "")
		$SQL .= " AND (NOM LIKE('%".$search_nom."%') OR NOM_MARITAL LIKE('%".$search_nom."%'))";
	if($search_prenom != "")
		$SQL .= " AND PRENOM LIKE('%".$search_prenom."%')";
	if($search_civilite != "")
		$SQL .= " AND CIVILITE ='".$search_civilite."'";
	if($search_date_naissance != "")
		$SQL .= " AND date_naissance LIKE('%".$search_date_naissance."%')";
	if($search_lieu_naissance != "")
		$SQL .= " AND lieu_naissance LIKE('%".$search_lieu_naissance."%')";
	if($search_pays_naissance != "")
		$SQL .= " AND pays =".$search_pays_naissance;
	if($search_nationalite != "")
		$SQL .= " AND nationalite =".$search_nationalite;
	if($search_radie != "tous" && $search_radie != "")
		$SQL .= " AND radie =".$search_radie;
	if($search_date_debut_radie != ""){
		if($search_radie == "tous" || $search_radie == "")
			$SQL .= " AND date_dom.date_certificat >='".$search_date_debut_radie."'";
		if($search_radie == "0")
			$SQL .= " AND date_dom.date_certificat >='".$search_date_debut_radie."'";
		if($search_radie == "1")
			$SQL .= " AND date_dom.date_radiation >='".$search_date_debut_radie."'";
	}
	if($search_date_fin_radie != ""){
		if($search_radie == "tous")
			$SQL .= " AND date_dom.date_certificat <='".$search_date_fin_radie."'";
		if($search_radie == "0")
			$SQL .= " AND date_dom.date_certificat <='".$search_date_fin_radie."'";
		if($search_radie == "1")
			$SQL .= " AND date_dom.date_radiation <='".$search_date_fin_radie."'";
	}
	$SQL .= " ORDER BY id ";
	$SQL .= " LIMIT ".$limit.",20";
	$resultat = mysql_query($SQL);
	return $resultat;
}
/********************************************************************************************************************************************************
			RECUPERATION DES DONNEES QUI ON ETE RECHERCHEES PAR UN UTILISATEUR AU LISTING DES DOMICILIES
********************************************************************************************************************************************************/
function select_domicilies_no_limit($search_immeuble,$search_num,$search_nom,$search_prenom,$search_civilite,$search_date_naissance,$search_lieu_naissance,$search_pays_naissance,$search_nationalite,$search_radie,$search_date_debut_radie,$search_date_fin_radie,$liste_champs){
	//DECLARATION DES VARIABLES LOCALES
		//Déclaration des booleens d'affichage des champs dans le fichier csv
		$id=false;
		$nouveau_N=false;
		$ancien_N=false;
		$date_1_ere_inscription=false;
		$date_certificat=false;
		$radie=false;
		$CIVILITE=false;
		$NOM=false;
		$NOM_MARITAL=false;
		$PRENOM=false;
		$date_naissance=false;
		$lieu_naissance=false;
		$pays=false;
		$dept=false;
		$nationalite=false;
		$nature_document_identite=false;
		$numero_document_identite=false;
		$contacts=false;
		$nationalite_temp=false;
		$pays_temp=false;
		$motif_RAD_temp=false;
		$date_radiation_temp=false;
		$id_statut=false;
		$date_id=false;
		//FIN  DE : Déclaration des booleens d'affichage des champs dans le fichier csv
		//Déclaration du tableau contenant la liste des numéros de champs utilisés à l'export
		$tab = split(',',$liste_champs);
		//FIN DE : Déclaration du tableau contenant la liste des numéros de champs utilisés à l'export
	//FIN DE : DECLARATION DES VARIABLES LOCALES
	//LANCEMENT DU PROCESS DE RECUPERATION DES DOMICILIES
		//Pour chaque champ utilisé, on récupere son numéro
		foreach($tab as $key => $value){
			//Si le numéro est 1 on passe le champ id à VRAI
			if($value == "1"){$id = true;}
			//Si le numéro est 2 on passe le champ nouveau_N à VRAI
			if($value == "2"){$nouveau_N = true;}
			//Si le numéro est 3 on passe le champ ancien_N à VRAI
			if($value == "3"){$ancien_N = true;}
			//Si le numéro est 4 on passe le champ date_1_ere_inscription à VRAI
			if($value == "4"){$date_1_ere_inscription = true;}
			//Si le numéro est 5 on passe le champ date_certificat à VRAI
			if($value == "5"){$date_certificat = true;}
			//Si le numéro est 6 on passe le champ radie à VRAI
			if($value == "6"){$radie = true;}
			//Si le numéro est 7 on passe le champ CIVILITE à VRAI
			if($value == "7"){$CIVILITE = true;}
			//Si le numéro est 8 on passe le champ NOM à VRAI
			if($value == "8"){$NOM = true;}
			//Si le numéro est 9 on passe le champ NOM_MARITAL à VRAI
			if($value == "9"){$NOM_MARITAL = true;}
			//Si le numéro est 10 on passe le champ PRENOM à VRAI
			if($value == "10"){$PRENOM = true;}
			//Si le numéro est 11 on passe le champ date_naissance à VRAI
			if($value == "11"){$date_naissance = true;}
			//Si le numéro est 12 on passe le champ lieu_naissance à VRAI
			if($value == "12"){$lieu_naissance = true;}
			//Si le numéro est 13 on passe le champ pays à VRAI
			if($value == "13"){$pays = true;}
			//Si le numéro est 14 on passe le champ dept à VRAI
			if($value == "14"){$dept = true;}
			//Si le numéro est 15 on passe le champ nationalite à VRAI
			if($value == "15"){$nationalite = true;}
			//Si le numéro est 16 on passe le champ nature_document_identite à VRAI
			if($value == "16"){$nature_document_identite = true;}
			//Si le numéro est 17 on passe le champ numero_document_identite à VRAI
			if($value == "17"){$numero_document_identite = true;}
			//Si le numéro est 18 on passe le champ  à VRAI
			if($value == "18"){$contacts = true;}
			//Si le numéro est 19 on passe le champ nationalite_temp à VRAI
			if($value == "19"){$nationalite_temp = true;}
			//Si le numéro est 20 on passe le champ pays_temp à VRAI
			if($value == "20"){$pays_temp = true;}
			//Si le numéro est 21 on passe le champ motif_RAD_temp à VRAI
			if($value == "21"){$motif_RAD_temp = true;}
			//Si le numéro est 22 on passe le champ date_radiation_temp à VRAI
			if($value == "22"){$date_radiation_temp = true;}
			//Si le numéro est 23 on passe le champ id_statut à VRAI
			if($value == "23"){$id_statut = true;}
			//Si le numéro est 24 on passe le champ date_id à VRAI
			if($value == "24"||$value == "25"||$value == "25"||$value == "26"||$value == "27"){$date_id = true;}
		}
		//FIN DE : Pour chaque champ utilisé, on récupere son numéro
		//Construction de la requête SQL de récupération des domiciliations
		$SQL = "SELECT ";
			//permet de savoir si c'est la premiere fois que l'on passe ou non, afin de ne pas mettre de virgule en début de liste
			$bool=false;
			//si tel ou tel champ est utilisé, on le met dans la requête
			if($id == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.id ";$bool = true;}
			if($nouveau_N == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.nouveau_N ";$bool = true;}
			if($ancien_N == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.ancien_N ";$bool = true;}
			if($date_1_ere_inscription == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.date_1_ere_inscription ";$bool = true;}
			if($date_certificat == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.date_certificat ";$bool = true;}
			if($radie == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.radie ";$bool = true;}
			if($CIVILITE == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.CIVILITE ";$bool = true;}
			if($NOM == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.NOM ";$bool = true;}
			if($NOM_MARITAL == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.NOM_MARITAL ";$bool = true;}
			if($PRENOM == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.PRENOM ";$bool = true;}
			if($date_naissance == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.date_naissance ";$bool = true;}
			if($lieu_naissance == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.lieu_naissance ";$bool = true;}
			if($pays == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.pays ";$bool = true;}
			if($dept == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.dept ";$bool = true;}
			if($nationalite == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.nationalite ";$bool = true;}
			if($nature_document_identite == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.nature_document_identite ";$bool = true;}
			if($numero_document_identite == true){if($bool == true){$SQL .= ",";}$SQL .= "numero_document_identite ";$bool = true;}
			if($contacts == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.contacts ";$bool = true;}
			if($nationalite_temp == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.nationalite_temp ";$bool = true;}
			if($pays_temp == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.pays_temp ";$bool = true;}
			if($motif_RAD_temp == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.motif_RAD_temp ";$bool = true;}
			if($date_radiation_temp == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.date_radiation_temp ";$bool = true;}
			if($id_statut == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.id_statut ";$bool = true;}
			if($date_id == true){if($bool == true){$SQL .= ",";}$SQL .= "domiciliation.date_id ";$bool = true;}
			//FIN DE : si te ou tel champ est utilisé, on le met dans la requête
			$SQL .= " FROM domiciliation ";
	if($search_date_debut_radie != "" || $search_date_fin_radie != ""){
		$SQL .= ",date_dom ";
	}
	$SQL .= " WHERE ";
	if($search_date_debut_radie != "" || $search_date_fin_radie != ""){
		$SQL .= "domiciliation.date_id = date_dom.id";
	}
	elseif($search_date_debut_radie == "" && $search_date_fin_radie == ""){
		$SQL .= "1 = 1";
	}
			//Filtrage des données
			if($search_immeuble == false)
				$SQL .= " AND id_statut <> 1";
			if($search_num != "")
				$SQL .= " AND nouveau_N LIKE('%".$search_num."%')";
			if($search_nom != "")
				$SQL .= " AND (NOM LIKE('%".$search_nom."%') OR NOM_MARITAL LIKE('%".$search_nom."%'))";
			if($search_prenom != "")
				$SQL .= " AND PRENOM LIKE('%".$search_prenom."%')";
			if($search_civilite != "")
				$SQL .= " AND CIVILITE ='".$search_civilite."'";
			if($search_date_naissance != "")
				$SQL .= " AND date_naissance LIKE('%".$search_date_naissance."%')";
			if($search_lieu_naissance != "")
				$SQL .= " AND lieu_naissance LIKE('%".$search_lieu_naissance."%')";
			if($search_pays_naissance != "")
				$SQL .= " AND pays =".$search_pays_naissance;
			if($search_nationalite != "")
				$SQL .= " AND nationalite =".$search_nationalite;
			if($search_radie != "tous" && $search_radie != "")
				$SQL .= " AND radie =".$search_radie;
	if($search_date_debut_radie != ""){
		if($search_radie == "tous" || $search_radie == "")
			$SQL .= " AND date_dom.date_certificat >='".$search_date_debut_radie."'";
		if($search_radie == "0")
			$SQL .= " AND date_dom.date_certificat >='".$search_date_debut_radie."'";
		if($search_radie == "1")
			$SQL .= " AND date_dom.date_radiation >='".$search_date_debut_radie."'";
	}
	if($search_date_fin_radie != ""){
		if($search_radie == "tous")
			$SQL .= " AND date_dom.date_certificat <='".$search_date_fin_radie."'";
		if($search_radie == "0")
			$SQL .= " AND date_dom.date_certificat <='".$search_date_fin_radie."'";
		if($search_radie == "1")
			$SQL .= " AND date_dom.date_radiation <='".$search_date_fin_radie."'";
	}
			//FIN DE : Filtrage des données
		//FIN DE : Construction de la requête SQL de récupération des domiciliations
		//Exécution de la requête
		$resultat = mysql_query($SQL);
		//On retourne le tableau de données
		return $resultat;
	//FIN DE : LANCEMENT DU PROCESS DE RECUPERATION DES DOMICILIES
}

//lors d'une recherche, récupération du nombre de rows retournées
function select_nb_domicilies($search_immeuble,$search_num,$search_nom,$search_prenom,$search_civilite,$search_date_naissance,$search_lieu_naissance,$search_pays_naissance,$search_nationalite,$search_radie,$search_date_debut_radie,$search_date_fin_radie){
$SQL = "SELECT count(*) as nb FROM domiciliation ";
	if($search_date_debut_radie != "" || $search_date_fin_radie != ""){
		$SQL .= ",date_dom ";
	}
	$SQL .= " WHERE ";
	
	if($search_date_debut_radie != "" || $search_date_fin_radie != ""){
		$SQL .= "domiciliation.date_id = date_dom.id";
	}
	elseif($search_date_debut_radie == "" && $search_date_fin_radie == ""){
		$SQL .= "1 = 1";
	}
	//$SQL = "SELECT count(*) as nb FROM domiciliation,date_dom WHERE domiciliation.date_id = date_dom.id";
	if($search_immeuble == false)
		$SQL .= " AND id not in (select id from domiciliation where id_statut = 1)";
	if($search_num != "")
		$SQL .= " AND nouveau_N LIKE('%".$search_num."%')";
	if($search_nom != "")
		$SQL .= " AND (NOM LIKE('%".$search_nom."%') OR NOM_MARITAL LIKE('%".$search_nom."%'))";
	if($search_prenom != "")
		$SQL .= " AND PRENOM LIKE('%".$search_prenom."%')";
	if($search_civilite != "")
		$SQL .= " AND CIVILITE ='".$search_civilite."'";
	if($search_date_naissance != "")
		$SQL .= " AND date_naissance LIKE('%".$search_date_naissance."%')";
	if($search_lieu_naissance != "")
		$SQL .= " AND lieu_naissance LIKE('%".$search_lieu_naissance."%')";
	if($search_pays_naissance != "")
		$SQL .= " AND pays =".$search_pays_naissance;
	if($search_nationalite != "")
		$SQL .= " AND nationalite =".$search_nationalite;
	if($search_radie != "tous" && $search_radie != "")
		$SQL .= " AND radie =".$search_radie;
	if($search_date_debut_radie != ""){
		if($search_radie == "tous" || $search_radie == "")
			$SQL .= " AND date_dom.date_certificat >='".$search_date_debut_radie."'";
		if($search_radie == "0")
			$SQL .= " AND date_dom.date_certificat >='".$search_date_debut_radie."'";
		if($search_radie == "1")
			$SQL .= " AND date_dom.date_radiation >='".$search_date_debut_radie."'";
	}
	if($search_date_fin_radie != ""){
		if($search_radie == "tous")
			$SQL .= " AND date_dom.date_certificat <='".$search_date_fin_radie."'";
		if($search_radie == "0")
			$SQL .= " AND date_dom.date_certificat <='".$search_date_fin_radie."'";
		if($search_radie == "1")
			$SQL .= " AND date_dom.date_radiation <='".$search_date_fin_radie."'";
	}
	$resultat = mysql_query($SQL);
	return $resultat;
}
//récup SQL de tous les pays
function select_all_pays(){
	$SQL = "SELECT * FROM pays ORDER BY nom_pays";
	$resultat = mysql_query($SQL);
	return $resultat;
}
//récup SQL de tous les statuts
function select_all_statut(){
	$SQL = "SELECT * FROM statut ORDER BY id";
	$resultat = mysql_query($SQL);
	return $resultat;
}
//récup SQL du nombre de statuts
function select_nb_statut(){
	$SQL = "SELECT count(*) as nb_statut FROM statut ORDER BY libelle_statut";
	$resultat = mysql_query($SQL);
	return $resultat;
}

//récup des dates d'un domicilié
function select_all_date(){
	$SQL = "SELECT * FROM date_dom";
	$resultat = mysql_query($SQL);
	return $resultat;
}

//récup des dates d'un domicilié
function select_date($id){
	$SQL = "SELECT * FROM date_dom WHERE id_domiciliation = ".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}
//récup SQL de toutes les nationalités
function select_all_nationalite(){
	$SQL = "SELECT * FROM nationalite ORDER BY nom_nationalite";
	$resultat = mysql_query($SQL);
	return $resultat;
}
//récup du pays d'un domicilié
function select_pays($id){
	$SQL = "SELECT nom_pays FROM pays WHERE id=".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}
//récup du statut d'un domicilié
function select_statut($id){
	$SQL = "SELECT libelle_statut FROM statut WHERE id=".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}
//récup de la nationalité d'un domicilié
function select_nationalite($id){
	$SQL = "SELECT nom_nationalite FROM nationalite WHERE id=".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}
//ajout d'un pays
function add_pays($nom){
	$SQL = "INSERT INTO pays (nom_pays) VALUES ('".htmlspecialchars($nom,ENT_QUOTES)."') ";
	$resultat = mysql_query($SQL);
	return $resultat;
}
//ajout d'un statut
function add_statut($nom){
	$SQL = "INSERT INTO statut (libelle_statut) VALUES ('".htmlspecialchars($nom,ENT_QUOTES)."') ";
	$resultat = mysql_query($SQL);
	return $resultat;
}
//ajout d'une nationalité
function add_nationalite($nom){
	$SQL = "INSERT INTO nationalite (nom_nationalite) VALUES ('".htmlspecialchars($nom,ENT_QUOTES)."') ";
	$resultat = mysql_query($SQL);
	return $resultat;
}
//modification d'un pays
function modif_pays($id,$nom){
	$SQL = "UPDATE pays SET nom_pays='".htmlspecialchars($nom,ENT_QUOTES)."' WHERE id=".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}
//modification d'un statut
function modif_statut($id,$nom){
	$SQL = "UPDATE statut SET libelle_statut='".htmlspecialchars($nom,ENT_QUOTES)."' WHERE id=".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}
//modification d'une nationalité
function modif_nationalite($id,$nom){
	$SQL = "UPDATE nationalite SET nom_nationalite='".htmlspecialchars($nom,ENT_QUOTES)."' WHERE id=".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}
//modification d'un domicilié
function modif_dom($id,$ancien_N,$CIVILITE,$NOM,$PRENOM,$id_statut,$NOM_MARITAL,$annee_naissance,$mois_naissance,$jour_naissance,$pays,$ville_naissance,$nationalite,$contacts,$nature_document_identite,$numero_document_identite,$radie,$motif_RAD_temp,$annee_radiation,$mois_radiation,$jour_radiation,$annee_1_ere_inscription,$mois_1_ere_inscription,$jour_1_ere_inscription,$annee_certificat,$mois_certificat,$jour_certificat){


$date_naissance = $annee_naissance.$mois_naissance.$jour_naissance;
$date_radiation = $annee_radiation.$mois_radiation.$jour_radiation;
$date_1_ere_inscription = $annee_1_ere_inscription.$mois_1_ere_inscription.$jour_1_ere_inscription;
$date_certificat = $annee_certificat.$mois_certificat.$jour_certificat;

$SQL_DATE = mysql_query("Select id from date_dom where id_domiciliation = ".$id);

if(mysql_fetch_array($SQL_DATE) == NULL){
	$SQL="INSERT INTO date_dom(id_domiciliation,date_certificat,date_1_ere_inscription, date_naissance, date_radiation) VALUES(".$id.",'".$date_certificat."','".$date_1_ere_inscription."','".$date_naissance."','".$date_radiation."')";
	mysql_query($SQL);
}
else{
$SQL_DATE = mysql_query("Select id from date_dom where id_domiciliation = ".$id);
while($dates = mysql_fetch_array($SQL_DATE)){
	$SQL="UPDATE date_dom SET id_domiciliation=".$id.",date_certificat='".$date_certificat."',date_1_ere_inscription='".$date_1_ere_inscription."',date_naissance='".$date_naissance."', date_radiation='".$date_radiation."' WHERE id=".$dates["id"];
		mysql_query($SQL);
	}
}

$SQL_DATE = mysql_query("Select id from date_dom where id_domiciliation = ".$id);
while($dates = mysql_fetch_array($SQL_DATE)){
	$date_id = $dates["id"];
}

	$SQL="UPDATE domiciliation SET lieu_naissance='".htmlspecialchars($ville_naissance,ENT_QUOTES)."', ancien_N='".htmlspecialchars($ancien_N,ENT_QUOTES)."', CIVILITE='".htmlspecialchars($CIVILITE,ENT_QUOTES)."', NOM='".htmlspecialchars($NOM,ENT_QUOTES)."', PRENOM='".htmlspecialchars($PRENOM,ENT_QUOTES)."', id_statut=".htmlspecialchars($id_statut,ENT_QUOTES)." ,NOM_MARITAL='".htmlspecialchars($NOM_MARITAL,ENT_QUOTES)."' ,pays=".htmlspecialchars($pays,ENT_QUOTES)." ,nationalite=".htmlspecialchars($nationalite,ENT_QUOTES)." ,contacts='".htmlspecialchars($contacts,ENT_QUOTES)."' ,nature_document_identite='".htmlspecialchars($nature_document_identite,ENT_QUOTES)."' ,numero_document_identite='".htmlspecialchars($numero_document_identite,ENT_QUOTES)."' ,radie='".htmlspecialchars($radie,ENT_QUOTES)."' ,motif_RAD_temp='".htmlspecialchars($motif_RAD_temp,ENT_QUOTES)."',date_id=".$date_id." WHERE id=".$id;
	mysql_query($SQL);
}

//création d'un domicilié
function create_dom($ancien_N,$CIVILITE,$NOM,$PRENOM,$id_statut,$NOM_MARITAL,$annee_naissance,$mois_naissance,$jour_naissance,$pays,$ville_naissance,$nationalite,$contacts,$nature_document_identite,$numero_document_identite,$radie,$motif_RAD_temp,$annee_radiation,$mois_radiation,$jour_radiation,$annee_1_ere_inscription,$mois_1_ere_inscription,$jour_1_ere_inscription,$annee_certificat,$mois_certificat,$jour_certificat,$ancien_N){

//calcul des dates
$date_naissance = $annee_naissance.$mois_naissance.$jour_naissance;
$date_radiation = $annee_radiation.$mois_radiation.$jour_radiation;
$date_1_ere_inscription = $annee_1_ere_inscription.$mois_1_ere_inscription.$jour_1_ere_inscription;
$date_certificat = $annee_certificat.$mois_certificat.$jour_certificat;

//récupération du nouveau numéro
$dernier_id = mysql_fetch_array(mysql_query("SELECT MAX(id) as id FROM domiciliation"),ENT_QUOTES);
$dernier_nouveau_N = mysql_fetch_array(mysql_query("SELECT nouveau_N FROM domiciliation WHERE id=".$dernier_id["id"]),ENT_QUOTES);
$nouveau_N = date('Y')."-".date('m')."-";
if((substr($dernier_nouveau_N["nouveau_N"],8,strlen($dernier_nouveau_N["nouveau_N"])-8)+1) < 10000)
$nouveau_N.="0";
$nouveau_N.=substr($dernier_nouveau_N["nouveau_N"],8,strlen($dernier_nouveau_N["nouveau_N"])-8)+1;

//insertion sans date
$SQL = "INSERT INTO domiciliation (nouveau_N,lieu_naissance,CIVILITE,NOM,PRENOM,id_statut,NOM_MARITAL,pays,nationalite,contacts,nature_document_identite,numero_document_identite,radie,motif_RAD_temp,ancien_N) VALUES('".$nouveau_N."','".htmlspecialchars($ville_naissance,ENT_QUOTES)."','".htmlspecialchars($CIVILITE,ENT_QUOTES)."','".htmlspecialchars($NOM,ENT_QUOTES)."','".htmlspecialchars($PRENOM,ENT_QUOTES)."',".htmlspecialchars($id_statut,ENT_QUOTES)." ,'".htmlspecialchars($NOM_MARITAL,ENT_QUOTES)."',".htmlspecialchars($pays,ENT_QUOTES)." ,".htmlspecialchars($nationalite,ENT_QUOTES)." ,'".htmlspecialchars($contacts,ENT_QUOTES)."' ,'".htmlspecialchars($nature_document_identite,ENT_QUOTES)."','".htmlspecialchars($numero_document_identite,ENT_QUOTES)."',".htmlspecialchars($radie,ENT_QUOTES).",'".htmlspecialchars($motif_RAD_temp,ENT_QUOTES)."','".htmlspecialchars($ancien_N,ENT_QUOTES)."')";

	mysql_query($SQL);
//récup de l'id
$mon_id = mysql_fetch_array(mysql_query("SELECT MAX(id) as id FROM domiciliation"),ENT_QUOTES);
//insertion dates
$SQL="INSERT INTO date_dom(id_domiciliation,date_certificat,date_1_ere_inscription, date_naissance, date_radiation) VALUES(".$mon_id["id"].",'".$date_certificat."','".$date_1_ere_inscription."','".$date_naissance."','".$date_radiation."')";
mysql_query($SQL);
//récup de l'id des dates 
$date_id = mysql_fetch_array(mysql_query("select id from date_dom where id_domiciliation = ".$mon_id["id"]),ENT_QUOTES);
//ajout dates au domicilié
$SQL = mysql_query("UPDATE domiciliation SET date_id=".$date_id["id"]." WHERE id=".$mon_id["id"]);
	return $nouveau_N;
}

//changement du pays d'un domicilié
function maj_pays($id,$id_pays){
	$SQL = "UPDATE domiciliation SET pays=".$id_pays." WHERE id=".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}
//changement de la nationalité d'un domicilié
function maj_nationalite($id,$id_nationalite){
	$SQL = "UPDATE domiciliation SET nationalite=".$id_nationalite." WHERE id=".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}
//suppression d'un pays
function del_pays($id){
	$SQL = "DELETE FROM pays WHERE id=".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}
//suppression d'un statut
function del_statut($id){
	$SQL = "DELETE FROM statut WHERE id=".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}
//suppression d'une nationalité
function del_nationalite($id){
	$SQL = "DELETE FROM nationalite WHERE id=".$id;
	$resultat = mysql_query($SQL);
	return $resultat;
}

function show_tables(){
    $SQL = "SHOW TABLES";
    $resultat = mysql_query($SQL);
    return $resultat;
}

function desc_table($table){
    $SQL = "DESC ".$table;
    $resultat = mysql_query($SQL);
    return $resultat;
}
?>