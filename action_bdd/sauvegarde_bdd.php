<?
include("connexion.php");
//modification des donnees personnelew
if(isset($_POST))
{
    include('../action_bdd/action_bdd.php');
    
    $CheminFichier = "../export/exportDB.sql";
    touch($CheminFichier);
    $file=fopen($CheminFichier,"w"); // Ouverture du fichier avec le mode Ècriture
    
    
    $ContenuFichier = "\n-- Dump de la base de donnees\n-- Entraide et Partage\n\n\nSET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\nSET time_zone = \"+00:00\";\n\n";
    $ContenuFichier .= "--\n-- Database: `entraide`\n--\n\n-- --------------------------------------------------------\n";
    $SQL_TABLES = show_tables();
    while($table = mysql_fetch_array($SQL_TABLES,ENT_QUOTES))
    {
        // Description Table
        $SQL_DESC = desc_table($table[0]);
        $ContenuFichier .= "\n--\n-- Table structure for table `".$table[0]."`\n--\n\n";
        $ContenuFichier .= "DROP TABLE IF EXISTS `".$table[0]."`;\n";
        $ContenuFichier .= "CREATE TABLE `".$table[0]."` (\n";

        $records = mysql_query('SHOW FIELDS FROM `'.$table[0].'`');
        if ( mysql_num_rows($records) == 0 )
            return false;
        while ( $record = mysql_fetch_assoc($records) )
        {
            $ContenuFichier .= '  `'.$record['Field'].'` '.$record['Type'];
        
            if ( @strcmp($record['Null'],'YES') != 0 )
                $ContenuFichier .= ' NOT NULL';
            if ( !empty($record['Extra']) )
                $ContenuFichier .= ' '.$record['Extra'];
            else
            {
                if ( isset($record['Default']) )
                {
                    $ContenuFichier .= ' DEFAULT \''.$record['Default'].'\'';
                }
                else
                {
                    $ContenuFichier .= ' DEFAULT NULL';
                }
            }
            $ContenuFichier .= ",\n";
        }
    
    
        $ContenuFichier = ereg_replace(",\n$", null, $ContenuFichier);
    
    
        // Save all Column Indexes
        //$ContenuFichier .= $this->getSqlKeysTable($table);
        $ContenuFichier .= "\n)";
    
        //Save table engine
        $records = mysql_query("SHOW TABLE STATUS LIKE '".$table[0]."'");
        if ( $record = mysql_fetch_assoc($records) )
        {
            if ( !empty($record['Engine']) )
            {
                $ContenuFichier .= ' ENGINE='.$record['Engine'];
            }
            if ( !empty($record['Auto_increment']) )
            {
                $ContenuFichier .= ' AUTO_INCREMENT='.$record['Auto_increment'];
            }
        }
        $ContenuFichier.= " DEFAULT CHARSET=latin1;\n\n";
    
        // Dumping data table
        $ContenuFichier.= "--\n-- Dumping data for table `".$table[0]."`\n--\n\n";
    
        $records = mysql_query('SHOW FIELDS FROM `'.$table[0].'`');
        $num_fields = @mysql_num_rows($records);
        if ( $num_fields != 0 )
        {
            // Field names
            $selectStatement = "SELECT ";
            $insertStatement = "INSERT INTO `$table[0]` (";
            $NumField = array();
            for ($x = 0; $x < $num_fields; $x++) 
            {
                $record = @mysql_fetch_assoc($records);
                if ( "int" == @substr($record['Type'], 0,3)) 
                {
                    $NumField [$x] = true;
                }
                
                $selectStatement .= '`'.$record['Field'].'`';
                $insertStatement .= '`'.$record['Field'].'`';
                $insertStatement .= ", ";
                $selectStatement .= ", ";
            }
            $insertStatement = @substr($insertStatement,0,-2).') VALUES';
            $selectStatement = @substr($selectStatement,0,-2).' FROM `'.$table[0].'`';

            $records = @mysql_query($selectStatement);
            $num_rows = @mysql_num_rows($records);
            $num_fields = @mysql_num_fields($records);
            // Dump data
            if ( $num_rows > 0 ) 
            {
                $ContenuFichier .= $insertStatement;
                $ContenuFichier .= "\n";
                for ($i = 0; $i < $num_rows; $i++) 
                {
                    $record = @mysql_fetch_assoc($records);
                    $ContenuFichier .= '(';
                    for ($j = 0; $j < $num_fields; $j++) 
                    {
                        $field_name = @mysql_field_name($records, $j);
                        if ($NumField[$j])
                        {
                            $ContenuFichier .= $record[$field_name];
                        }
                        else
                        {
                            $ContenuFichier .= "'".@str_replace('\"','"',@mysql_escape_string($record[$field_name]))."'";
                        }
                        $ContenuFichier .= ', ';
                        if (strlen($ContenuFichier) > 524287) 
                        {
                            fwrite($file, $ContenuFichier);
                            $ContenuFichier = '';
                        }
                    }
                    $ContenuFichier = @substr($ContenuFichier,0,-2).")";
                    $ContenuFichier .= ( $i < ($num_rows-1) ) ? ',' : ';';
                    $ContenuFichier .= "\n";
                }
            }
            fwrite($file, $ContenuFichier);
            $ContenuFichier = '';
        }
        fwrite($file, $ContenuFichier);
        $ContenuFichier = '';
    }
    fwrite($fp,$ContenuFichier); // Ceci ajoutera ou crira le contenu "texte ..." dans le fichier "le_fichier.txt"
    fclose($fp);
}

?>
