<?
include("connexion.php");
//modification des donnees personnelles
if(isset($_POST))
{
    $res = true;
    
    if ($res == true)
    {
        $res = ($_POST['nom'] != "");
        if ($res = false)
        {
            $_SESSION['message'] = "<font color='#0000FF'>Le nom de ne peut pas &egrave;tre vide</font>";
        }
    }    
    if ($res == true)
    {
        $res = ($_POST['prenom'] != "");
        if ($res = false)
        {
            $_SESSION['message'] = "<font color='#0000FF'>Le pr&eacute;nom de ne peut pas &egrave;tre vide</font>";
        }
    }    
    if ($res == true)
    {
        $res = ($_POST['login'] != "");
        if ($res = false)
        {
            $_SESSION['message'] = "<font color='#0000FF'>Le login de ne peut pas &egrave;tre vide</font>";
        }
    }    
    if ($res == true)
    {
        $res = ($_POST['mdp'] != "");
        if ($res = false)
        {
            $_SESSION['message'] = "<font color='#0000FF'>Le mot de passe de ne peut pas &egrave;tre vide</font>";
        }
    }
    
    if ($res == true)-
    {
        $SQL = "INSERT INTO utilisateurs(nom,prenom,login,mdp,droits";
        if($_POST['droits'] == "T")
            $SQL .= ",signature";
        $SQL .= ") VALUES('".htmlentities($_POST['nom'],ENT_QUOTES)."','".htmlentities($_POST['prenom'],ENT_QUOTES)."','".htmlentities($_POST['login'],ENT_QUOTES)."','".htmlentities($_POST['mdp'],ENT_QUOTES)."','".htmlentities($_POST['droits'],ENT_QUOTES)."'";
        if($_POST['droits'] == "T")
            $SQL .= ", ".$_POST['droit_signature'];
        $SQL .= ")";
        $res = mysql_query($SQL);
        session_start();
        if($res == true)
        {
            $_SESSION['message'] = "<font color='#00FF00'>L'utilisateur a bien &eacute;t&eacute; cr&eacute;&eacute;</font>";
        }
        else
        {
            $_SESSION['message'] = "<font color='#0000FF'>Probl&egrave;me &agrave; la cr&eacute;ation !!</font>";
        }
    }
    header('Location:../index.php');
}
?>