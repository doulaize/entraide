<?session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html>
	<head>
		<title>Bienvenue entraide V 2.0</title>
		<META NAME="Copyright" CONTENT="Rocher Xavier ©"> 
		<META NAME="TITLE" CONTENT="Entraide et Partage avec les Sans-Logis">
		<META NAME="DESCRIPTION" CONTENT="site des inscription pour les domiciliations">
		<META NAME="KEYWORDS" CONTENT="entraide, partage, sans-logis,domiciliation,association bénévole">
		<META NAME="LANGUAGE" CONTENT="FR">
		<META NAME="SUBJECT" CONTENT="Entraide et Partage">
		<META NAME="ROBOTS" CONTENT="All">
		<META NAME="AUTHOR" CONTENT="Xavier Rocher" LANG="fr">
		<META NAME="OWNER" CONTENT="xavierrocher@free.fr">
		<META NAME="ABSTRACT" CONTENT="site des inscription pour les domiciliations">
		<META NAME="REVISIT-AFTER" CONTENT="15 DAYS">
		<META HTTP-EQUIV="REFRESH" CONTENT="600">
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
		
		<link rel="stylesheet" type="text/css" href="./css/styles.css">
		
<script>
	function test_saisie_modif_data(){
		if(document.getElementById('mdp').value != document.getElementById('confirm_mdp').value){
			alert('vous avez mal retapé votre mot de passe !');
			return 0;
		}
		if(document.getElementById('nom').value == ""){
			alert('votre nom est vide !');
			return 0;			
		}
		if(document.getElementById('prenom').value == ""){
			alert('votre prénom est vide !');
			return 0;			
		}
		if(document.getElementById('login').value == ""){
			alert('votre login est vide !');
			return 0;			
		}
		return 1;
	}
</script>	
		
	</head>
	<body>
		<script type="text/javascript" src="./js/wz_dragdrop.js"></script>
			<table class="logo" width="157">
				<tr>
					<td><img src="./img/logo_test.JPG" alt="logo" height="69">
					</td>
					<td valign="top"><img title="réduire la fenêtre de connexion" src="./img/reduire.JPG" onclick="
							javascript:
								if(document.getElementById('reduire').value==1){
									this.src='./img/agrandir.JPG';
									document.getElementById('reduire').value='0';
									this.title='agrandir la fenêtre de connexion';
									document.getElementById('bloc_connexion').style.visibility='hidden';
								}
								else{
									this.src='./img/reduire.JPG';
									document.getElementById('reduire').value='1';
									this.title='réduire la fenêtre de connexion';
									document.getElementById('bloc_connexion').style.visibility='visible';
								}" alt="agrandir/reduire"><input type="hidden" id="reduire" value="1">
					</td>
					<td valign="top">
						<form action="./login.php" name="connexion" method="post">
						<div id="bloc_connexion" style="position:absolute;">
								<table class="tableau_site">
									<tr>
										<th>
											<b>date du jour : </b>
										</th>
										<th><? 
										$time= date('d/m/Y');
										$num_date = date("w");
										$jour_semaine = "";
										if($num_date == 0)
											$jour_semaine = "Dimanche ";
										if($num_date == 1)
											$jour_semaine = "Lundi ";
										if($num_date == 2)
											$jour_semaine = "Mardi ";
										if($num_date == 3)
											$jour_semaine = "Mercredi ";
										if($num_date == 4)
											$jour_semaine = "Jeudi ";
										if($num_date == 5)
											$jour_semaine = "Vendredi ";
										if($num_date == 6)
											$jour_semaine =	"Samedi ";
										echo $jour_semaine.$time;
										?></th>
									</tr>
									<?if(!isset($_SESSION['id'])){?>
									<tr>
										<th>
											<H5><b>CONNEXION</b></H5> 
										</th>
										<th>
											Nom
										</th>
										<th>
											Mot de Passe&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input type="submit" tabindex="3" value="OK">
										</th>
									</tr>
									<tr>
										<td><a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01 Strict" height="31" width="88"></a>
										</td>
										<td>
											<input type="text" name="login" tabindex="1">
										</td>
										<td>
											<input type="password" name="mdp" tabindex="2">
										</td>
									</tr>
									<?}?>
									<tr>
										<td colspan='3'>
											<div id="div_error"></div>
										</td>
									</tr>
								</table>
						</div> 
						</form>
					</td>
				</tr>
			</table>
<?
//gestion des erreurs de connection
if(isset($_GET['error'])){
	if($_GET['error'] == 1){
		?>
		<script type="text/javascript">
			document.getElementById('div_error').innerHTML="<font color='#FF0000'>Vous n'avez pas rempli tous les champs de connexion !!</font>";
		</script>
		<?
	}
	if($_GET['error'] == 2){
		?>
		<script type="text/javascript">
			document.getElementById('div_error').innerHTML="<font color='#FF0000'>Vos identifiants et/ou mots de passe sont incorrects, veuillez réessayer</font>";
		</script>
		<?
	}	
	if($_GET['error'] == 3){
		?>
		<script type="text/javascript">
			document.getElementById('div_error').innerHTML="<font color='#FF0000'>Il est impossible de rentrer dans cette page sans se connecter !!</font>";
		</script>
		<?
	}	
	if($_GET['error'] == 4){
		?>
		<script type="text/javascript">
			document.getElementById('div_error').innerHTML="<font color='#00FF00'>Vous avez été bien déconnecté</font>";
		</script>
		<?
	}
	if($_GET['error'] == "alert"){
		?>
		<script type="text/javascript">
			document.getElementById('div_error').innerHTML="<font color='#00FF00'>Ne tentez pas d'entrer sur une page interdite !!</font>";
		</script>
		<?
	}	
}
if(isset($_GET['success']) || isset($_SESSION['connected'])){
	if(isset($_SESSION['id']) && $_SESSION['id'] != ""){
	?>
	<script type="text/javascript">
		document.getElementById('div_error').innerHTML="<b>Bienvenue <? echo $_SESSION['prenom']." ".$_SESSION['nom']."</b>";?>";
	</script>
	<?
	}
	else{
?>
	<script type="text/javascript">
		document.getElementById('div_error').innerHTML="N'essayez pas de m'avoir ! je suis mauvais, mais pas à ce point !";
	</script>
	<?
	}
}
?>