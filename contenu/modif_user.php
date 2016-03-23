<?
include('../action_bdd/action_bdd.php');
if(!isset($_GET['id_user']))
{
	$traitement = select_users($_GET['droits']);
?>
<b><u>Modification des donn&eacute;es des utilisateurs  : </u>
<br><font color="#FF0000">Attention ! vous ne pouvez modifier que les utilisateurs ayant des droits inf&eacute;rieurs aux votres</font></b><br><br>
<table>
	<tr>
		<th>Modifier</th>
		<th>Nom</th>
		<th>Pr&eacute;nom</th>
		<th>Login</th>
		<th>Mot de passe</th>
		<th>Droits</th>
	</tr>
	<?while($resultat = mysql_fetch_array($traitement, MYSQL_ASSOC)){?>
	<tr>
		<td><a href="#" onclick="writediv(file('./contenu/modif_user.php?droits=<?echo $_GET["droits"];?>&modif_droit=vrai&id_user=<?echo $resultat['id']?>'));">modifier</a></td>
		<td><?echo $resultat['nom']?></td>
		<td><?echo $resultat['prenom']?></td>
		<td><?echo $resultat['login']?></td>
		<td><?echo $resultat['mdp']?></td>
		<td><?echo $resultat['droits']?></td>
	</tr>
	<?}?>
</table>
<?}
else
{
	$resultat = select_modif_data($_GET['id_user']);?>
	<b><u>Modification de mes donn&eacute;es des utilisateurs  : </u></b><br><br>
	<form name="modif_data" id="modif_data" method="post" action="./action_bdd/update_modif_data.php">
	<input type="hidden" name="id" id="id" value="<? echo $_GET['id_user']?>">
	<table>
		<tr>
			<th>
				nom
			</th>
			<td>
				<input type="text" name="nom" id="nom" value="<? echo $resultat['nom']?>">
			</td>
		</tr>
		<tr>
			<th>
				pr&eacute;nom
			</th>
			<td>
				<input type="text" name="prenom" id="prenom" value="<? echo $resultat['prenom']?>">
			</td>

		</tr>
		<tr>
			<th>
				login
			</th>
			<td>
				<input type="text" name="login" id="login" value="<? echo $resultat['login']?>">
			</td>
		</tr>
		<tr>
			<th>
				mot de passe
			</th>
			<td>
				<input type="password" name="mdp" id="mdp" value="<? echo $resultat['mdp']?>">
			</td>
		</tr>
		<tr>
			<th>
				confirmation du mot de passe
			</th>
			<td>
				<input type="password" name="confirm_mdp" id="confirm_mdp" value="<? echo $resultat['mdp']?>">
			</td>
		</tr>
		<tr>		
			<th>
				droits
			</th>
			<td>
				<table class="info_importante">
				<tr><td>
				<? 
				if(isset($_GET["modif_droit"]) && $_GET["modif_droit"] == "vrai"){
					?><select name="droits" id="droits">
						<option value="I" <?if($resultat['droits'] == "I")echo "selected";?>>Interrogation</option>
						<?if(isset($_GET["droits"]) && $_GET["droits"] != "I"){?>
						<option value="C" <?if($resultat['droits'] == "C")echo "selected";?>>Cr&eacute;ation</option>
						<?if(isset($_GET["droits"]) && $_GET["droits"] != "C"){?>
						<option value="M"  <?if($resultat['droits'] == "M")echo "selected";?>>Modification</option>
						<?if(isset($_GET["droits"]) && $_GET["droits"] != "M"){?>
						<option value="T" <?if($resultat['droits'] == "T")echo "selected";?>>Tous les droits</option>
						<?}}}?>
					</select><?
				}
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
<?}?>