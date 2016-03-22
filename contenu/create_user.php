<?
	include('../action_bdd/action_bdd.php');
	$resultat = select_liste_droits($_GET['droits']);
?>
<u><b>Cr&eacute;ation d'un utilisateur : </b></u><br><br>
<form name="create_user" id="create_user" method="post" action="./action_bdd/create_user.php">
	<table>
		<tr>
			<th>
				Nom
			</th>
			<td>
				<input type="text" name="nom" id="nom" value="">
			</td>
		</tr>
		<tr>
			<th>
				Pr&eacute;nom
			</th>
			<td>
				<input type="text" name="prenom" id="prenom" value="">
			</td>

		</tr>
		<tr>
			<th>
				Login
			</th>
			<td>
				<input type="text" name="login" id="login" value="">
			</td>
		</tr>
		<tr>
			<th>
				Mot de passe
			</th>
			<td>
				<input type="password" name="mdp" id="mdp" value="">
			</td>
		</tr>
		<tr>
			<th>
				Confirmation du mot de passe
			</th>
			<td>
				<input type="password" name="confirm_mdp" id="confirm_mdp" value="">
			</td>
		</tr>
		<tr>		
			<th>
				Droits
			</th>
			<td>
				<?echo $resultat;?>
			</td>
		</tr>
		<tr>		
			<th>
				Droits Signature
			</th>
			<td>
				<select name="droit_signature" id="droit_signature">
					<option value="0">NON</option>
					<option value="1">OUI</option>
				</select>
			</td>
		</tr>

		<tr>		
			<th>
				Valider
			</th>
			<td align="center">
				<input type="button" name="valider" id="valider" value="Valider" 
				onclick="javascript:
						if(test_saisie_modif_data()== 1){
							submit();
						}
						else{
							return 0;
						}"
				>
			</td>
		</tr>
	</table>
</form>