<?
	include('../action_bdd/action_bdd.php');
	include('../include/fonctions.php');
	$table_statut = NULL;
	$recup_statut = select_all_statut();
	$recup_nb_statut = select_nb_statut();
	$nb_statut = mysql_fetch_array($recup_nb_statut, ENT_QUOTES);
	$cpt = 0;
	while($row = mysql_fetch_array($recup_statut, ENT_QUOTES)){
		$table_statut[$cpt][0] = $row["id"];
		$table_statut[$cpt][1] = $row["libelle_statut"];
		$cpt = $cpt + 1;
	}
	$search_num = "";
	$search_nom = "";
	$search_prenom = "";
	$search_civilite = "";
	$search_date_naissance = "";
	$search_lieu_naissance = "";
	$search_pays_naissance = "";
	$search_nationalite = "";
	$search_radie = "";
	$search_date_debut_radie = "";
	$search_date_fin_radie = "";
if(isset($_GET)){
	if(isset($_GET["num"]) && $_GET["num"] != ""){
		$search_num = $_GET["num"];
	}
	if(isset($_GET["nom"]) && $_GET["nom"] != ""){
		$search_nom = $_GET["nom"];
	}
	if(isset($_GET["prenom"]) && $_GET["prenom"] != ""){
		$search_prenom = $_GET["prenom"];
	}
	if(isset($_GET["civilite"]) && $_GET["civilite"] != ""){
		$search_civilite = $_GET["civilite"];
	}
	if(isset($_GET["date_naissance"]) && $_GET["date_naissance"] != ""){
		$search_date_naissance = $_GET["date_naissance"];
	}
	if(isset($_GET["lieu_naissance"]) && $_GET["lieu_naissance"] != ""){
		$search_lieu_naissance = $_GET["lieu_naissance"];
	}
	if(isset($_GET["pays_naissance"]) && $_GET["pays_naissance"] != ""){
		$search_pays_naissance = $_GET["pays_naissance"];
	}
	if(isset($_GET["nationalite"]) && $_GET["nationalite"] != ""){
		$search_nationalite = $_GET["nationalite"];
	}
	if(isset($_GET["radie"]) && $_GET["radie"] != ""){
		$search_radie = $_GET["radie"];
	}
	if(isset($_GET["date_debut_radie"]) && $_GET["date_debut_radie"] != ""){
		$search_date_debut_radie = $_GET["date_debut_radie"];
	}
	if(isset($_GET["date_fin_radie"]) && $_GET["date_fin_radie"] != ""){
		$search_date_fin_radie = $_GET["date_fin_radie"];
	}
	if(isset($_GET["immeuble"])){
		if($_GET["immeuble"] == "vrai"){
			$search_immeuble = true;}
		else{
			$search_immeuble = false;}
	}
	else{
		$search_immeuble = true;
	}
}
	if(isset($_GET["limit"])){
		$limit = $_GET["limit"];
	}
	else{
		if(isset($_GET["limit_2"]) && $_GET["limit_2"] != ""){
			$limit = ($_GET["limit_2"]-1)*20;
		}
		else{
			$limit=0;
		}
	}
	
	$search_nom = htmlentities($search_nom,ENT_QUOTES);//str_replace("&#039;", "\"", $search_nom);
	//echo htmlentities($search_nom,ENT_QUOTES);
	$resultat = select_domicilies($search_immeuble,$limit,$search_num,$search_nom,$search_prenom,$search_civilite,$search_date_naissance,$search_lieu_naissance,$search_pays_naissance,$search_nationalite,$search_radie,$search_date_debut_radie,$search_date_fin_radie);
	
	$resultat_nb = select_nb_domicilies($search_immeuble,$search_num,$search_nom,$search_prenom,$search_civilite,$search_date_naissance,$search_lieu_naissance,$search_pays_naissance,$search_nationalite,$search_radie,$search_date_debut_radie,$search_date_fin_radie);
	//echo $resultat_nb; search_nom;
?>
<table>
	<tr>
		<td width="300">
			<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/searching_module.php?droits=<?echo $_GET["droits"];?>&id_user=<?echo $_GET["id_user"];?>'));">affiner mes recherches</a>
			<br>
			<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/export.php?search_immeuble=<?echo $search_immeuble;?>&search_num=<?echo $search_num;?>&search_nom=<? echo $search_nom;?>&search_prenom=<? echo $search_prenom;?>&search_civilite=<? echo $search_civilite;?>&search_date_naissance=<? echo $search_date_naissance;?>&search_lieu_naissance=<? echo $search_lieu_naissance;?>&search_pays_naissance=<? echo $search_pays_naissance;?>&search_nationalite=<? echo $search_nationalite;?>&search_radie=<? echo $search_radie;?>&search_date_debut_radie=<? echo $search_date_debut_radie;?>&search_date_fin_radie=<? echo $search_date_fin_radie?>'));">exporter la liste enti&egrave;re sous excel</a>
			<br><br>
			<?while($valeur_nb = mysql_fetch_array($resultat_nb,MYSQL_ASSOC)){
				$nb = $valeur_nb["nb"];
				echo "votre recherche a trouv&eacute; ".$valeur_nb["nb"]." domicili&eacute;(s)";
			}?>
		</td>
		<td width="70">
		<?
		if($limit > 0){
		?>
			<a href="#" onclick="writediv(file('./contenu/search_dom.php?limit=<?echo $limit-20;?>&<?foreach($_GET as $key => $value){if($key != "limit" && $key != "limit_2" ){echo "&".$key."=".$value;}}?>'))">pr&eacute;c&eacute;dent</a>
		<?}?>
		</td>
		<td width="70" nowrap>
			page <?echo $limit/20 + 1;?> sur <?if($nb%20 == 0){echo ($nb/20);}else{echo ($nb/20) - (($nb%20)/20)+ 1;}?>
			<br><input type="text" id="num_page" size="5" maxlength="<?echo strlen($nb/20);?>"> 
			<INPUT type="button" onclick="if(!isNaN(document.getElementById('num_page').value)){
if(document.getElementById('num_page').value > 0 && document.getElementById('num_page').value <= <?if($nb%20 == 0){echo ($nb/20);}else{echo ($nb/20) - (($nb%20)/20)+ 1;}?>){writediv(file('./contenu/search_dom.php?limit_2='+document.getElementById('num_page').value+'&<?foreach($_GET as $key => $value){if($key != "limit" && $key != "limit_2" ){echo "&".$key."=".$value;}}?>'));}else{alert(document.getElementById('num_page').value+' n\'est pas un num&eacute;ro valide');return 0;}}else{alert(document.getElementById('num_page').value+' n\'est pas un num&eacute;ro');return 0;}" value="Go">
		
		</td>
		<td width="70">&nbsp;
		<?if($nb%20 == 0){$nb2 = ($nb/20);}else{$nb2 = ($nb/20) - (($nb%20)/20)+ 1;}
		if($limit+20 <= $nb){?>
			<a href="#" onclick="writediv(file('./contenu/search_dom.php?limit=<?echo $limit+20;?>&<?foreach($_GET as $key => $value){if($key != "limit" && $key != "limit_2" ){echo "&".$key."=".$value;}}?>'))">suivant</a>
		<?}?>
		</td>
	</tr>
<?if($search_num != ""){?>
	<tr>
		<td>
			<a href="#" onclick="writediv(file('./contenu/search_dom.php?num=<?if($search_num < 9999)echo "0";echo $search_num-1;?>&<?foreach($_GET as $key => $value){if($key != "num"){echo "&".$key."=".$value;}}?>'))">num&eacute;ro pr&eacute;c&eacute;dent</a> <a href="#" onclick="writediv(file('./contenu/search_dom.php?num=<?if($search_num < 9999)echo "0";echo $search_num+1;?>&<?foreach($_GET as $key => $value){if($key != "num"){echo "&".$key."=".$value;}}?>'))">num&eacute;ro suivant</a>
		</td>
	</tr>
<?}?>
</table>
<table width="768" border="1">
	<tr>
		<th>nouveau num</th>
		<th>DATE INSC</th>
		<th>TITRE</th>
		<th width="50%" >NOM</th>
		<th>STATUT</th>
		<th>PRENOM</th>
		<th>PAYS NAISSANCE</th>
		<th>NATIONALITE</th>
		<th>RADIE ?</th>
		<th><a href="#" onclick="">modifier plusieurs pays</a></th>
		<th><a href="#" onclick="">modifier plusieurs nationalit&eacute;s</a></th>
	</tr>
<?while($valeur = mysql_fetch_array($resultat,MYSQL_ASSOC)){?>
	<tr>
		<td>
			<?echo affichage($valeur["nouveau_N"]);?>
		</td>
		<td>
			<?echo affichage($valeur["date_certificat"]);?>
		</td>
		<td>
			<?echo affichage($valeur["CIVILITE"]);?>
		</td>
		<td width="50%" >
			<a href="#" onclick="writediv(file('./contenu/modif_dom.php?id_user=<?echo $_GET["id_user"];?>&droits=<?echo $_GET['droits']?>&id=<?echo $valeur["id"];?><?if(isset($_GET)){if(isset($_GET["immeuble"])){?>&immeuble=<?echo $_GET["immeuble"];}if(isset($_GET["num"])){?>&num=<?echo $_GET["num"];}if(isset($_GET["civilite"])){?>&civilite=<?echo $_GET["civilite"];}if(isset($_GET["nom"])){?>&nom=<?echo $_GET["nom"];}if(isset($_GET["prenom"])){?>&prenom=<?echo $_GET["prenom"];}if(isset($_GET["date_naissance"])){?>&date_naissance=<?echo $_GET["date_naissance"];}if(isset($_GET["lieu_naissance"])){?>&lieu_naissance=<?echo $_GET["lieu_naissance"];}if(isset($_GET["pays_naissance"])){?>&pays_naissance=<?echo $_GET["pays_naissance"];}if(isset($_GET["nationalite"])){?>&nationalite=<?echo $_GET["nationalite"];}if(isset($_GET["radie"])){?>&radie=<?echo $_GET["radie"];}if(isset($_GET["date_debut_radie"])){?>&date_debut_radie=<?echo $_GET["date_debut_radie"];}if(isset($_GET["date_fin_radie"])){?>&date_fin_radie=<?echo $_GET["date_fin_radie"];}?><?}if(isset($_GET["limit"])){?>&limit=<?echo $_GET["limit"];}if(isset($_GET["limit_2"])){?>&limit_2=<?echo $_GET["limit_2"];}?>'))""><?echo "- ".affichage($valeur["NOM"]);?></a>
			
		</td>
		<td>
			<?
			if($table_statut != NULL){
			foreach($table_statut as $key => $value){
				if($value[0] == $valeur["id_statut"]){
					echo affichage($value[1])."<br>";
				}
			}
			}
			echo affichage($valeur["NOM_MARITAL"]);?>
		</td>
		<td>
			<?echo affichage($valeur["PRENOM"]);?>
		</td>
		<td>
			<?if($valeur["pays"] != 0){
				$vrai_pays = "SELECT nom_pays FROM pays WHERE id=".$valeur["pays"];
				$res_vrai_pays = mysql_fetch_array(mysql_query($vrai_pays));
				echo affichage($res_vrai_pays["nom_pays"]);//ici aller rechercher le nom du pays
			}
			else{
				echo $valeur["pays_temp"]."<br><a href=\"#\" onclick=\"document.getElementById('alert').innerHTML = '';writediv(file('./contenu/maj_pays.php?id=".$valeur["id"]."'));\"><font color='#FF0000'>MAJ Pays</font></a>";
			}
			?>
		</td>
		<td>
			<?if($valeur["nationalite"] != 0){
				$vrai_nat = "SELECT nom_nationalite FROM nationalite WHERE id=".$valeur["nationalite"];
				$res_vrai_nat = mysql_fetch_array(mysql_query($vrai_nat));
				echo affichage($res_vrai_nat["nom_nationalite"]);
			}
			else{
				echo $valeur["nationalite_temp"]."<br><a href=\"#\" onclick=\"document.getElementById('alert').innerHTML = '';writediv(file('./contenu/maj_nationalite.php?id=".$valeur["id"]."'));\"><font color='#FF0000'>MAJ Nationalite</font></a>";
			}
			?>
		</td>
		<td>
			<?if($valeur["radie"] == "1") echo "oui"; else if($valeur["radie"] == "0") echo "non";?>
		</td>
		<td></td>
		<td></td>
	</tr>
<?}?>
</table>