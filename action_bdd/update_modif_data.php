<?
include("connexion.php");
//modification des donnees personnelles
if(isset($_POST['id']) && $_POST['id'] != "")
{
    $res = true;
    $error = "";
    
    if ($res == true)
    {
        //VŽrification login n'existe pas
        $SQL = "SELECT * FROM utilisateurs WHERE id!=".htmlentities($_POST['id'])." and login LIKE'".htmlentities($_POST['login'],ENT_QUOTES)."'";
        //echo $SQL;
        $traitement = mysql_query($SQL);
        while ($row = mysql_fetch_array($traitement, MYSQL_NUM))
        {
            $res = false;
            $error = "Le login existe d&eacute;j&agrave;. Choisissez un autre";
        }
    }
    
    if ($res == true)
    {
        $SQL = "UPDATE utilisateurs SET nom='".htmlentities($_POST['nom'],ENT_QUOTES)."', prenom='".htmlentities($_POST['prenom'],ENT_QUOTES)."',login='".htmlentities($_POST['login'],ENT_QUOTES)."',mdp='".htmlentities($_POST['mdp'],ENT_QUOTES)."', droits='".htmlentities($_POST['droits'],ENT_QUOTES)."' WHERE id=".htmlentities($_POST['id'],ENT_QUOTES);
        $res = mysql_query($SQL);
    }
    session_start();
    
    if($res == true)
    {
        $_SESSION['message'] = "<font color='#00FF00'>Vos donn&eacute;s personnelles on bien &eacute;t&eacute; modifi&eacute;es.</font>";
    }
    else
    {
        $_SESSION['message'] = "<font color='#0000FF'>Probl&egrave;me &agrave; la modification d'utilisateur.   ".$error."</font>";
    }
    
    header('Location:../index.php');
}
?>
