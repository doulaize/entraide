<?
	include("./include/entete.php");
?>

<?if(isset($_SESSION['id'])){?>
<div id="principal" width="600px">
    <div id="principal2" width="600px">

		<div id="haut" width="600px"><div id="coingh"></div><div id="coindh"></div>
		</div>
		<div id="contenu2" width="600px">
<table>
	<tr>
		<td>
<table>
	<tr>
		<td colspan="6">
<div>
	<a href="#" onclick="writediv('');
		document.getElementById('sous_menu_data_perso').style.visibility='visible';
		document.getElementById('sous_menu_data_perso').style.display='block';
		document.getElementById('section_dom').style.visibility='hidden';
		document.getElementById('section_dom').style.display='none';
		document.getElementById('debut').style.visibility='hidden';
		document.getElementById('debut').style.display='none';
		document.getElementById('users').style.visibility='hidden';
		document.getElementById('users').style.display='none';
		document.getElementById('stats').style.visibility='hidden';
		document.getElementById('stats').style.display='none';
		document.getElementById('params').style.visibility='hidden';
		document.getElementById('params').style.display='none';">Donn&eacute;es personnelles</a>&nbsp;&nbsp;
		
	<a href="#" onclick="writediv('');
		document.getElementById('sous_menu_data_perso').style.visibility='hidden';
		document.getElementById('sous_menu_data_perso').style.display='none';
		document.getElementById('section_dom').style.visibility='visible';
		document.getElementById('section_dom').style.display='block';
		document.getElementById('debut').style.visibility='hidden';
		document.getElementById('debut').style.display='none';
		document.getElementById('users').style.visibility='hidden';
		document.getElementById('users').style.display='none';
		document.getElementById('stats').style.visibility='hidden';
		document.getElementById('stats').style.display='none';
		document.getElementById('params').style.visibility='hidden';
		document.getElementById('params').style.display='none';">Section Domiciliations</a>&nbsp;&nbsp;
		
	<a href="#" onclick="writediv('');
		document.getElementById('users').style.visibility='visible';
		document.getElementById('users').style.display='block';
		document.getElementById('section_dom').style.visibility='hidden';
		document.getElementById('section_dom').style.display='none';
		document.getElementById('debut').style.visibility='hidden';
		document.getElementById('debut').style.display='none';
		document.getElementById('sous_menu_data_perso').style.visibility='hidden';
		document.getElementById('sous_menu_data_perso').style.display='none';
		document.getElementById('stats').style.visibility='hidden';
		document.getElementById('stats').style.display='none';
		document.getElementById('params').style.visibility='hidden';
		document.getElementById('params').style.display='none';">Utilisateurs</a>&nbsp;&nbsp;
		
	<a href="#" onclick="writediv('');
		document.getElementById('stats').style.visibility='visible';
		document.getElementById('stats').style.display='block';
		document.getElementById('section_dom').style.visibility='hidden';
		document.getElementById('section_dom').style.display='none';
		document.getElementById('debut').style.visibility='hidden';
		document.getElementById('debut').style.display='none';
		document.getElementById('sous_menu_data_perso').style.visibility='hidden';
		document.getElementById('sous_menu_data_perso').style.display='none';
		document.getElementById('users').style.visibility='hidden';
		document.getElementById('users').style.display='none';
		document.getElementById('params').style.visibility='hidden';
		document.getElementById('params').style.display='none';">Statistiques</a>&nbsp;&nbsp;
		
	<a href="#" onclick="writediv('');
		document.getElementById('params').style.visibility='visible';
		document.getElementById('params').style.display='block';
		document.getElementById('section_dom').style.visibility='hidden';
		document.getElementById('section_dom').style.display='none';
		document.getElementById('debut').style.visibility='hidden';
		document.getElementById('debut').style.display='none';
		document.getElementById('sous_menu_data_perso').style.visibility='hidden';
		document.getElementById('sous_menu_data_perso').style.display='none';
		document.getElementById('users').style.visibility='hidden';
		document.getElementById('users').style.display='none';
		document.getElementById('stats').style.visibility='hidden';
		document.getElementById('stats').style.display='none';">Param&egrave;tres</a>&nbsp;&nbsp;
		
	<a href="./disconnect.php">D&eacute;connexion</a>
</div>
		</td>
	</tr>
	<tr>
		<td>
			<div id="debut" style="visibility:visible;display:block;">Choisissez une section</div>
		</td>
		<td>
			<div id="sous_menu_data_perso" style="visibility:hidden;display:none;">
			<table>
				<tr>
					<td>
						<a href="#" onclick="document.getElementById('alert').innerHTML = '';
							writediv(file('./contenu/modif_data.php?id=<?echo $_SESSION['id']?>'));">Modification donn&eacute;es</a>
					</td>
				</tr>
			</table>
			</div>
		</td>
		<td>
			<div id="section_dom" style="visibility:hidden;display:none;">
				<table>
					<tr>
						<td>
							<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/search_dom.php?droits=<?echo $_SESSION['droits']?>&id_user=<?echo $_SESSION['id'];?>'));">Rechercher</a>
						</td>
						<td>||</td>
						<td>
							<?if($_SESSION['droits'] == "I"){?>
							<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv('Vous n\'avez pas les droits');">Cr&eacute;er</a>
							<?}else{?>
							<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/create_dom.php?droits=<?echo $_SESSION['droits']?>'));">Cr&eacute;er</a><?}?>
						</td>
					</tr>
				</table>
			</div>
		</td>
		<td>
			<div id="users" style="visibility:hidden;display:none;">
			<?if($_SESSION['droits'] != "I"){?>
				<table>
					<tr>
						<td>
							<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/create_user.php?droits=<?echo $_SESSION['droits']?>'));">Cr&eacute;ation</a>		
						</td>
						<?if($_SESSION['droits'] != "C"){?>
						<td>||</td>
						<td>
							<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/modif_user.php?modif_droit=vrai&droits=<?echo $_SESSION['droits']?>'));">Modification</a>
						</td>
						<?if($_SESSION['droits'] == "M" || $_SESSION['droits'] == "T"){?>
						<td>||</td>
						<td>
							<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/del_user.php?droits=<?echo $_SESSION['droits']?>'));">Suppression</a>
						</td>
						<?}}?>
					</tr>
				</table>
			<?}else{?>
				<script>writediv('vous n\'avez pas les droits');</script>
			<?}?>
			</div>
		</td>
		<td>
			<div style="visibility:hidden;display:none;" id="stats">
			<?if($_SESSION['droits'] != "I" && $_SESSION['droits'] != "C" && $_SESSION['droits'] != "M"){?>
				<?if($_SESSION['droits'] == "T"){?>
				<table>
				<tr>
					<td>
					<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/stats_user.php'));">Utilisateurs</a>
					</td>
					<td>||</td>
					<td>
					<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/stats_dom.php'));">Domicili&eacute;s</a>
					</td>
				</tr>
				</table>
			<?}}
			else{
			?><script>writediv('vous n\'avez pas les droits');</script><?
			}?>
			</div>
		</td>
		<td>
			<div style="visibility:hidden;display:none;" id="params">
			<?if($_SESSION['droits'] != "I" && $_SESSION['droits'] != "C" && $_SESSION['droits'] != "M"){?>
			<table>
				<tr>
					<td>
				<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_pays.php'));">gestion des pays</a></td><td>||</td><td>
				<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_nationalite.php'));">gestion des nationalit&eacute;s</a></td><td>||</td><td>
				<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_statut.php'));">gestion des statuts</a></td><td>||</td><td>
				<a href="#" onclick="document.getElementById('alert').innerHTML = '';window.open('./gestion_sorties.php');">gestion des sorties</a></td><td>||</td><td>
				<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_signatures.php'));">gestion des droits de signature</a></td>
				</tr></table>
			<?}else{?>
			<script>writediv('vous n\'avez pas les droits');</script>
			<?}?>
			</div>
		</td>
	</tr>
</table>
</td></tr><td>
<table>
	<tr>
		<td>
			<div id="sous_menu_data_perso" style="visibility:hidden;display:none;">
			<table>
				<tr>
					<td>
						<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/modif_data.php?id=<?echo $_SESSION['id']?>'));">Modification donn&eacute;es</a>
					</td>
				</tr>
			</table>
			</div>
		</td>
		<td>
			<div id="section_dom" style="visibility:hidden;display:none;">
				<table>
					<tr>
						<td>
							<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/search_dom.php?droits=<?echo $_SESSION['droits'];?>&id_user=<?echo $_SESSION['id'];?>'));">Rechercher</a>
						</td>
						<td>||</td>
						<td>
							<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/create_dom.php?droits=<?echo $_SESSION['droits']?>'));">Cr&eacute;er</a>
						</td>
					</tr>
				</table>
			</div>
		</td>
		<td>
			<div id="users" style="visibility:hidden;display:none;">
			<?if($_SESSION['droits'] != "I"){?>
				<table>
					<tr>
						<td>
							<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/create_user.php?droits=<?echo $_SESSION['droits']?>'));">Cr&eacute;ation</a>		
						</td>
						<?if($_SESSION['droits'] != "C"){?>
						<td>||</td>
						<td>
							<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/modif_user.php?droits=<?echo $_SESSION['droits']?>'));">Modification</a>
						</td>
						<?if($_SESSION['droits'] == "M" || $_SESSION['droits'] == "T"){?>
						<td>||</td>
						<td>
							<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/del_user.php?droits=<?echo $_SESSION['droits']?>'));">Suppression</a>
						</td>
						<?}}?>
					</tr>
				</table>
			<?}else{?>
				<script>writediv('vous n\'avez pas les droits');</script>
			<?}?>
			</div>
		</td>
		<td>
			<div style="visibility:hidden;display:none;" id="stats">
			<?if($_SESSION['droits'] != "I"){?>
				<?if($_SESSION['droits'] == "T"){?>
				<table>
				<tr>
					<td>
					<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/stats_user.php'));">Utilisateurs</a>
					</td>
					<td>||</td>
					<td>
					<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/stats_dom.php'));">Domicili&eacute;s</a>
					</td>
				</tr>
				</table>
			<?}}
			else{
			?><script>writediv('vous n\'avez pas les droits');</script><?
			}?>
			</div>
		</td>
		<td>
			<div style="visibility:hidden;display:none;" id="params">
			<?if($_SESSION['droits'] != "I"){?>
			<table>
				<tr>
					<td>
				<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_pays.php'));">gestion des pays</a></td><td>||</td><td>
				<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_nationalite.php'));">gestion des nationalit&eacute;s</a></td><td>||</td><td>
				<a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_statut.php'));">gestion des statuts</a></td><td>||</td><td>
				<a href="#" onclick="document.getElementById('alert').innerHTML = '';window.open('./contenu/gestion_sorties.php');">gestion des sorties</a></td></tr></table>
			<?}?>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			
			<div id="alert">
			<?if(isset($_SESSION['message'])&& $_SESSION['message'] != "")
			{
				echo "<font color='#00FF00'>Vos données personnelles on bien été modifiées.</font>";$_SESSION['message'] = "";
			}?>
			</div>
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td>
			<div id="contenu">
				
			</div>
		</td>
	</tr>
</table>
	</td>
	</tr>
</table>
		</div>
		<div id="bas" width="600px">
			<div id="coingb"></div>
			<div id="coindb"></div>

		</div>
	</div>
</div>


<?}
?>

<?
	include("./include/pied.php");
?>