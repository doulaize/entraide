<?
    include("./include/entete.php");
    ?>
<?if(isset($_SESSION['id'])){?>
<div id="principal" width="600px">
<div id="principal2" width="600px">
    <div id="haut" width="600px">
        <div id="coingh"></div>
        <div id="coindh">
        </div>
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
                                    document.getElementById('users').style.visibility='hidden';
                                    document.getElementById('users').style.display='none';
                                    document.getElementById('stats').style.visibility='hidden';
                                    document.getElementById('stats').style.display='none';
                                    document.getElementById('params').style.visibility='hidden';
                                    document.getElementById('params').style.display='none';
                                    document.getElementById('backup').style.visibility='hidden';
                                    document.getElementById('backup').style.display='none';
                                    document.getElementById('alert').innerHTML = '';">Donn&eacute;es personnelles</a>&nbsp;&nbsp;
                                    <a href="#" onclick="writediv('');
                                    document.getElementById('sous_menu_data_perso').style.visibility='hidden';
                                    document.getElementById('sous_menu_data_perso').style.display='none';
                                    document.getElementById('section_dom').style.visibility='visible';
                                    document.getElementById('section_dom').style.display='block';
                                    document.getElementById('users').style.visibility='hidden';
                                    document.getElementById('users').style.display='none';
                                    document.getElementById('stats').style.visibility='hidden';
                                    document.getElementById('stats').style.display='none';
                                    document.getElementById('params').style.visibility='hidden';
                                    document.getElementById('params').style.display='none';
                                    document.getElementById('backup').style.visibility='hidden';
                                    document.getElementById('backup').style.display='none';
                                    document.getElementById('alert').innerHTML = '';">Section Domiciliations</a>&nbsp;&nbsp;
                                    <?if($_SESSION['droits'] != "I"){?>
                                    <a href="#" onclick="writediv('');
                                    document.getElementById('users').style.visibility='visible';
                                    document.getElementById('users').style.display='block';
                                    document.getElementById('section_dom').style.visibility='hidden';
                                    document.getElementById('section_dom').style.display='none';
                                    document.getElementById('sous_menu_data_perso').style.visibility='hidden';
                                    document.getElementById('sous_menu_data_perso').style.display='none';
                                    document.getElementById('stats').style.visibility='hidden';
                                    document.getElementById('stats').style.display='none';
                                    document.getElementById('params').style.visibility='hidden';
                                    document.getElementById('params').style.display='none';
                                    document.getElementById('backup').style.visibility='hidden';
                                    document.getElementById('backup').style.display='none';
                                    document.getElementById('alert').innerHTML = '';">Utilisateurs</a>&nbsp;&nbsp;
                                    <?}?>
                                    <?if($_SESSION['droits'] == "T"){?>
                                    <a href="#" onclick="writediv('');
                                    document.getElementById('stats').style.visibility='visible';
                                    document.getElementById('stats').style.display='block';
                                    document.getElementById('section_dom').style.visibility='hidden';
                                    document.getElementById('section_dom').style.display='none';
                                    document.getElementById('sous_menu_data_perso').style.visibility='hidden';
                                    document.getElementById('sous_menu_data_perso').style.display='none';
                                    document.getElementById('users').style.visibility='hidden';
                                    document.getElementById('users').style.display='none';
                                    document.getElementById('params').style.visibility='hidden';
                                    document.getElementById('params').style.display='none';
                                    document.getElementById('backup').style.visibility='hidden';
                                    document.getElementById('backup').style.display='none';
                                    document.getElementById('alert').innerHTML = '';">Statistiques</a>&nbsp;&nbsp;
                                    <a href="#" onclick="writediv('');
                                    document.getElementById('params').style.visibility='visible';
                                    document.getElementById('params').style.display='block';
                                    document.getElementById('section_dom').style.visibility='hidden';
                                    document.getElementById('section_dom').style.display='none';
                                    document.getElementById('sous_menu_data_perso').style.visibility='hidden';
                                    document.getElementById('sous_menu_data_perso').style.display='none';
                                    document.getElementById('users').style.visibility='hidden';
                                    document.getElementById('users').style.display='none';
                                    document.getElementById('stats').style.visibility='hidden';
                                    document.getElementById('stats').style.display='none';
                                    document.getElementById('backup').style.visibility='hidden';
                                    document.getElementById('backup').style.display='none';
                                    document.getElementById('alert').innerHTML = '';">Param&egrave;tres</a>&nbsp;&nbsp;
                                    <a href="#" onclick="writediv('');
                                    document.getElementById('backup').style.visibility='visible';
                                    document.getElementById('backup').style.display='block';
                                    document.getElementById('section_dom').style.visibility='hidden';
                                    document.getElementById('section_dom').style.display='none';
                                    document.getElementById('sous_menu_data_perso').style.visibility='hidden';
                                    document.getElementById('sous_menu_data_perso').style.display='none';
                                    document.getElementById('users').style.visibility='hidden';
                                    document.getElementById('users').style.display='none';
                                    document.getElementById('stats').style.visibility='hidden';
                                    document.getElementById('stats').style.display='none';
                                    document.getElementById('params').style.visibility='hidden';
                                    document.getElementById('params').style.display='none';
                                    document.getElementById('alert').innerHTML = '';">Sauvegarde</a>&nbsp;&nbsp;
                                    <?}?>
                                    <a href="./disconnect.php">D&eacute;connexion</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
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
                                            <td>
                                                <?if($_SESSION['droits'] != "I"){?>
                                                ||
                                            </td>
                                            <td>
                                                <a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/create_dom.php?droits=<?echo $_SESSION['droits']?>'));">Cr&eacute;er</a>
                                                <?}?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                            <td>
                                <div id="users" style="visibility:hidden;display:none;">
                                    <table>
                                        <tr>
                                            <td>
                                                <a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/create_user.php?droits=<?echo $_SESSION['droits']?>'));">Cr&eacute;ation</a>
                                            </td>
                                            <?if($_SESSION['droits'] == "M" || $_SESSION['droits'] == "T"){?>
                                            <td>||</td>
                                            <td>
                                                <a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/modif_user.php?modif_droit=vrai&droits=<?echo $_SESSION['droits']?>'));">Modification</a>
                                            </td>
                                            <td>||</td>
                                            <td>
                                                <a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/del_user.php?droits=<?echo $_SESSION['droits']?>'));">Suppression</a>
                                            </td>
                                            <?}?>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                            <td>
                                <div id="stats" style="visibility:hidden;display:none;">
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
                                </div>
                            </td>
                            <td>
                                <div id="params" style="visibility:hidden;display:none;">
                                    <table>
                                        <tr>
                                            <td>
                                                <a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_pays.php'));">gestion des pays</a>
                                            </td>
                                            <td>||</td>
                                            <td>
                                                <a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_nationalite.php'));">gestion des nationalit&eacute;s</a>
                                            </td>
                                            <td>||</td>
                                            <td>
                                                <a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_statut.php'));">gestion des statut</a>
                                            </td>
                                            <td>||</td>
                                            <td>
                                                <a href="#" onclick="document.getElementById('alert').innerHTML = '';window.open('./gestion_sorties.php');">gestion des sorties</a>
                                            </td>
                                            <td>||</td>
                                            <td>
                                                <a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/gestion_signatures.php'));">gestion des droits de signature</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                            <td>
                                <div id="backup" style="visibility:hidden;display:none;">
                                    <table>
                                        <tr>
                                            <td>
                                                <a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/sauvegarde_bdd.php'));">Sauvegarde BDD sur disque</a>
                                            </td>
                                            <td>||</td>
                                            <td>
                                                <a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/recuperation_bdd.php'));">R&eacute;cup&eacute;ration BDD depuis disque</a>
                                            </td>
                                            <td>||</td>
                                            <td>
                                                <a href="#" onclick="document.getElementById('alert').innerHTML = '';writediv(file('./contenu/sauvegarde_soft.php'));">Sauvegarde logiciel domiciliation sur disque</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <div id="alert">
                                <?if(isset($_SESSION['message'])&& $_SESSION['message'] != "")
                                    {
                                        echo $_SESSION['message'];
                                        $_SESSION['message']= "";
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
        </table>
    </div>
    <div id="bas" width="600px">
        <div id="coingb">
        </div>
        <div id="coindb">
        </div>
    </div>
</div>
<?}?>
</body>
</html>
