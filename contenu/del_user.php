<?
include('../action_bdd/action_bdd.php');
if(!isset($_GET['id_user']))
{
	$traitement = select_users($_GET['droits']);
?>
<b><u>Suppression des donn&eacute;es des utilisateurs  : </u>
<br><font color="#FF0000">Attention ! vous ne pouvez suppprimer que les utilisateurs ayant des droits inf&eacute;rieurs aux votres</font></b><br><br>
<table>
	<tr>
		<th>supprimer</th>
		<th>nom</th>
		<th>pr&eacute;nom</th>
		<th>login</th>
		<th>mot de passe</th>
		<th>droits</th>
	</tr>
	<?while($resultat = mysql_fetch_array($traitement, MYSQL_ASSOC)){?>
	<tr>
		<td><a href="./action_bdd/del_user.php?id_user=<?echo $resultat['id']?>">Supprimer</a></td>
		<td><?echo $resultat['nom']?></td>
		<td><?echo $resultat['prenom']?></td>
		<td><?echo $resultat['login']?></td>
		<td><?echo $resultat['mdp']?></td>
		<td><?echo $resultat['droits']?></td>
	</tr>
	<?}?>
</table>
<?}?>