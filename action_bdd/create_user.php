<?
include("connexion.php");
//modification des donnees personnelles
if(isset($_POST))
{
    $res = true;
    $error = "";

    if ($res == true)
    {
        //Vérification login n'existe pas
        $SQL = "SELECT * FROM utilisateurs WHERE login LIKE '".htmlentities($_POST['login'])."'";
        $traitement = mysql_query($SQL);
        while ($row = mysql_fetch_array($traitement, MYSQL_NUM))
        {
            $res = false;
            $error = "Le login existe d&eacute;j&agrave;. Choisissez un autre";
        }
    }

    if ($res == true)
    {
        $SQL = "INSERT INTO utilisateurs(nom,prenom,login,mdp,droits";
        if($_POST['droits'] == "T")
            $SQL .= ",signature";
        $SQL .= ") VALUES('".htmlentities($_POST['nom'],ENT_QUOTES)."','".htmlentities($_POST['prenom'],ENT_QUOTES)."','".htmlentities($_POST['login'],ENT_QUOTES)."','".htmlentities($_POST['mdp'],ENT_QUOTES)."','".htmlentities($_POST['droits'],ENT_QUOTES)."'";
        if($_POST['droits'] == "T")
            $SQL .= ", ".$_POST['droit_signature'];
        $SQL .= ")";
        $res = mysql_query($SQL);
    }

    session_start();
    if($res == true)
    {
        $_SESSION['message'] = "<font color='#00FF00'>L'utilisateur a bien &eacute;t&eacute; cr&eacute;&eacute;</font>";
    }
    else
    {
        $_SESSION['message'] = "<font color='#0000FF'>Probl&egrave;me &agrave; la cr&eacute;ation d'utilisateur.   ".$error."</font>";
    }
    header('Location:../index.php');
}
?>
