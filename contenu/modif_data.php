<?
	include('../action_bdd/action_bdd.php');
	$resultat = select_modif_data($_GET['id']);
?>
<u><b>Modification de mes donn&eacute;es personnelles : </b></u><br><br>
<form name="modif_data" id="modif_data" method="post" action="./action_bdd/update_modif_data.php">
	<input type="hidden" name="id" id="id" value="<? echo $_GET['id']?>">
	<table>
		<tr>
			<th>
				Nom
			</th>
			<td>
				<input type="text" name="nom" id="nom" value="<? echo $resultat['nom']?>">
			</td>
		</tr>
		<tr>
			<th>
				Pr&eacute;nom
			</th>
			<td>
				<input type="text" name="prenom" id="prenom" value="<? echo $resultat['prenom']?>">
			</td>

		</tr>
		<tr>
			<th>
				Login
			</th>
			<td>
				<input type="text" name="login" id="login" value="<? echo $resultat['login']?>">
			</td>
		</tr>
		<tr>
			<th>
				Mot de passe
			</th>
			<td>
				<input type="password" name="mdp" id="mdp" value="<? echo $resultat['mdp']?>">
			</td>
		</tr>
		<tr>
			<th>
				Confirmation du mot de passe
			</th>
			<td>
				<input type="password" name="confirm_mdp" id="confirm_mdp" value="<? echo $resultat['mdp']?>">
			</td>
		</tr>
		<tr>		
			<th>
				Droits
			</th>
			<td>
				<table class="info_importante">
				<tr><td>
				<? 
				if($resultat['droits'] == "T"){
					echo "Tous les droits";
				}
				elseif($resultat['droits'] == "M"){
					echo "Droits de cr&eacute;ation et de modification";
				}
				elseif($resultat['droits'] == "C"){
					echo "Droits de cr&eacute;ation";
				}
				elseif($resultat['droits'] == "I"){
					echo "Droits restreints";
				}
				?>
				</td></tr>
				</table>
			</td>
		</tr>
		<tr>		
			<th>
				valider
			</th>
			<td align="center">
				<input type="button" name="valider" id="valider" value="Valider" 
				onclick="javascript:
						if(test_saisie_modif_data()== 1){
							submit();
						}
						else{
							return 0;
						}">
			</td>
		</tr>
	</table>
</form>