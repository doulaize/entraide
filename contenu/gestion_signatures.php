<?
	include('../action_bdd/action_bdd.php');
	include('../include/fonctions.php');
	if(isset($_GET["liste"]) && $_GET["liste"] != ""){
		delete_all_signataires();
		$tab = split(',',$_GET["liste"]);
	}
	if(isset($tab)){
	foreach($tab as $key => $value){
		set_signature($value);
	}
	}
	$users = select_all_signataires();
	$nb = select_nb_signataires();
	$nombre = mysql_fetch_array($nb,ENT_QUOTES);
	?>
		<table>
			<tr>
				<th>nom</th><th>prenom</th><td>signataire?</td>
			</tr>
	<?
	for($i=0;$i<$nombre["nb"];$i++){
		$signataires = mysql_fetch_array($users,ENT_QUOTES);
			echo "<tr><td>".$signataires["nom"]."</td>";
			echo "<td>".$signataires["prenom"]."</td>";
		?>
			<td><input type="checkbox" <?if($signataires["signature"] == 1) echo "checked";?> id="<?echo $i ?>"><input type="hidden" id="sign_<?echo $i;?>" value="<?echo $signataires["id"];?>"></td></tr>
		<?
	}
?>
		<tr><td>
			<input type="hidden" id="lst_signataire">
			<input type="button" value="valider" onclick="var liste='';<?for($j=0;$j<$nombre["nb"];$j++){?>if(document.getElementById('<?echo $j;?>').checked == true){liste = liste+document.getElementById('sign_<?echo $j;?>').value+','}<?}?>writediv(file('./contenu/gestion_signatures.php?liste='+liste))">
		</td></tr>
		</table>
