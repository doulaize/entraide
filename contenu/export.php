<?
	$search_num=$_GET["search_num"];
	$search_nom=$_GET["search_nom"];
	$search_prenom=$_GET["search_prenom"];
	$search_civilite=$_GET["search_civilite"];
	$search_date_naissance=$_GET["search_date_naissance"];
	$search_lieu_naissance=$_GET["search_lieu_naissance"];
	$search_pays_naissance = $_GET["search_pays_naissance"];
	$search_nationalite = $_GET["search_nationalite"];
	$search_radie = $_GET["search_radie"];
	$search_date_debut_radie = $_GET["search_date_debut_radie"];
	$search_date_fin_radie = $_GET["search_date_fin_radie"];	
	$search_immeuble = $_GET["search_immeuble"];
?>

Veuillez choisir les champs qui vous int&eacute;ressent : <br>
	<a href="#" onclick="document.getElementById('ch_1').checked=true;document.getElementById('ch_2').checked=true;document.getElementById('ch_3').checked=true;document.getElementById('ch_4').checked=true;document.getElementById('ch_5').checked=true;document.getElementById('ch_6').checked=true;document.getElementById('ch_7').checked=true;document.getElementById('ch_8').checked=true;document.getElementById('ch_9').checked=true;document.getElementById('ch_10').checked=true;document.getElementById('ch_11').checked=true;document.getElementById('ch_12').checked=true;document.getElementById('ch_13').checked=true;document.getElementById('ch_14').checked=true;document.getElementById('ch_15').checked=true;document.getElementById('ch_16').checked=true;document.getElementById('ch_17').checked=true;document.getElementById('ch_18').checked=true;document.getElementById('ch_19').checked=true;document.getElementById('ch_20').checked=true;document.getElementById('ch_21').checked=true;document.getElementById('ch_22').checked=true;document.getElementById('ch_23').checked=true;document.getElementById('ch_24').checked=true;document.getElementById('ch_25').checked=true;document.getElementById('ch_26').checked=true;document.getElementById('ch_27').checked=true;">tout cocher</a>	
	<table><tr><td>1 id : </td><td><input type="checkbox" name="ch_1" id="ch_1"><br></td></tr>
	<tr><td>2 nouveau_N : </td><td><input type="checkbox" name="ch_2" id="ch_2"><br></td></tr>
	<tr><td>3 ancien_N : </td><td><input type="checkbox" name="ch_3" id="ch_3"><br></td></tr>
	<tr><td>4 date_1_ere_inscription : </td><td><input type="checkbox" name="ch_4" id="ch_4"><br></td></tr>
	<tr><td>5 date_certificat : </td><td><input type="checkbox" name="ch_5" id="ch_5"><br></td></tr>
	<tr><td>6 radie : </td><td><input type="checkbox" name="ch_6" id="ch_6"><br></td></tr>
	<tr><td>7 CIVILITE : </td><td><input type="checkbox" name="ch_7" id="ch_7"><br></td></tr>
	<tr><td>8 NOM : </td><td><input type="checkbox" name="ch_8" id="ch_8"><br></td></tr>
	<tr><td>9 NOM_MARITAL : </td><td><input type="checkbox" name="ch_9" id="ch_9"><br></td></tr>
	<tr><td>10 PRENOM : </td><td><input type="checkbox" name="ch_10" id="ch_10"><br></td></tr>
	<tr><td>11 date_naissance : </td><td><input type="checkbox" name="ch_11" id="ch_11"><br></td></tr>
	<tr><td>12 lieu_naissance : </td><td><input type="checkbox" name="ch_12" id="ch_12"><br></td></tr>
	<tr><td>13 pays : </td><td><input type="checkbox" name="ch_13" id="ch_13"><br></td></tr>
	<tr><td>14 dept : </td><td><input type="checkbox" name="ch_14" id="ch_14"><br></td></tr>
	<tr><td>15 nationalite : </td><td><input type="checkbox" name="ch_15" id="ch_15"><br></td></tr>
	<tr><td>16 nature_document_identite : </td><td><input type="checkbox" name="ch_16" id="ch_16"><br></td></tr>
	<tr><td>17 numero_document_identite : </td><td><input type="checkbox" name="ch_17" id="ch_17"><br></td></tr>
	<tr><td>18 contacts : </td><td><input type="checkbox" name="ch_18" id="ch_18"><br></td></tr>
	<tr><td>19 nationalite_temp : </td><td><input type="checkbox" name="ch_19" id="ch_19"><br></td></tr>
	<tr><td>20 pays_temp : </td><td><input type="checkbox" name="ch_20" id="ch_20"><br></td></tr>
	<tr><td>21 motif_RAD_temp : </td><td><input type="checkbox" name="ch_21" id="ch_21"><br></td></tr>
	<tr><td>22 date_radiation_temp : </td><td><input type="checkbox" name="ch_22" id="ch_22"><br></td></tr>
	<tr><td>23 id_statut : </td><td><input type="checkbox" name="ch_23" id="ch_23"><br></td></tr>
	<tr><td>24 date de naissance : </td><td><input type="checkbox" name="ch_24" id="ch_24"><br></td></tr>
	<tr><td>25 date de certificat: </td><td><input type="checkbox" name="ch_25" id="ch_25"><br></td></tr>
	<tr><td>26 date de 1ere inscription: </td><td><input type="checkbox" name="ch_26" id="ch_26"><br></td></tr>
	<tr><td>27 date de radiation: </td><td><input type="checkbox" name="ch_27" id="ch_27"><br></td></tr>
	</table>
	<input type="button" value="Exporter!" onclick="var lst='';if(document.getElementById('ch_1').checked){lst = lst+',1';}if(document.getElementById('ch_2').checked){lst = lst+',2';}if(document.getElementById('ch_3').checked){lst = lst+',3';}if(document.getElementById('ch_4').checked){lst = lst+',4';}if(document.getElementById('ch_5').checked){lst = lst+',5';}if(document.getElementById('ch_6').checked){lst = lst+',6';}if(document.getElementById('ch_7').checked){lst = lst+',7';}if(document.getElementById('ch_8').checked){lst = lst+',8';}if(document.getElementById('ch_9').checked){lst = lst+',9';}if(document.getElementById('ch_10').checked){lst = lst+',10';}if(document.getElementById('ch_11').checked){lst = lst+',11';}if(document.getElementById('ch_12').checked){lst = lst+',12';}if(document.getElementById('ch_13').checked){lst = lst+',13';}if(document.getElementById('ch_14').checked){lst = lst+',14';}if(document.getElementById('ch_15').checked){lst = lst+',15';}if(document.getElementById('ch_16').checked){lst = lst+',16';}if(document.getElementById('ch_17').checked){lst = lst+',17';}if(document.getElementById('ch_18').checked){lst = lst+',18';}if(document.getElementById('ch_19').checked){lst = lst+',19';}if(document.getElementById('ch_20').checked){lst = lst+',20';}if(document.getElementById('ch_21').checked){lst = lst+',21';}if(document.getElementById('ch_22').checked){lst = lst+',22';}if(document.getElementById('ch_23').checked){lst = lst+',23';}if(document.getElementById('ch_24').checked){lst = lst+',24';}if(document.getElementById('ch_25').checked){lst = lst+',25';}if(document.getElementById('ch_26').checked){lst = lst+',26';}if(document.getElementById('ch_27').checked){lst = lst+',27';}window.open('./contenu/export_csv.php?search_immeuble=<?echo $search_immeuble;?>&lst_ch='+lst+'&search_num=<?echo $search_num;?>&search_nom=<? echo $search_nom;?>&search_prenom=<? echo $search_prenom;?>&search_civilite=<? echo $search_civilite;?>&search_date_naissance=<? echo $search_date_naissance;?>&search_lieu_naissance=<? echo $search_lieu_naissance;?>&search_pays_naissance=<? echo $search_pays_naissance;?>&search_nationalite=<? echo $search_nationalite;?>&search_radie=<? echo $search_radie;?>&search_date_debut_radie=<? echo $search_date_debut_radie;?>&search_date_fin_radie=<? echo $search_date_fin_radie?>');">
