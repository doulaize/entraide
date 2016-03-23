<?
	include('../action_bdd/action_bdd.php');
	$resultat = select_modif_data($_GET['id']);
?>

<form name="modif_data" id="modif_data" method="post" action="./action_bdd/sauvegarde_bdd.php">
	<table>
		<tr>		
			<td align="center">
				<input type="submit" name="valider" id="valider" value="Sauvegarde de la base de donn&eacute;es"/>
			</td>
		</tr>
	</table>
</form>