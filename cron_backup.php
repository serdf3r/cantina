<?php 
// Create connection
$host = '127.0.0.1';
$user = 'root';
$pass = '';
$name = 'cantina';
//*/59 * * * *  /usr/bin/mysqldump -h 127.0.0.1  -u root  cantina > /opt/lampp/htdocs/cantina/backup/backup_$(date -u +\%Y\%m\%dT\%H\%M\%S).sql


backupDatabaseTables($host,$user,$pass,$name,$tables = '*');
/**
 * @function    backupDatabaseTables
 * @author      CodexWorld
 * @link        http://www.codexworld.com
 * @usage       Backup database tables and save in SQL file
 */
function backupDatabaseTables($dbHost,$dbUsername,$dbPassword,$dbName,$tables = '*') {
    $return='';
    //connect & select the database
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 

    //get all of the tables
    if($tables == '*'){
        $tables = array();
        $result = $db->query("SHOW TABLES");
        while($row = $result->fetch_row()){
            $tables[] = $row[0];
        }
    }else{
        $tables = is_array($tables)?$tables:explode(',',$tables);
    }

    //loop through the tables
    foreach($tables as $table){
        $result = $db->query("SELECT * FROM $table");
        $numColumns = $result->field_count;

        $return .= "DROP TABLE $table;";

        $result2 = $db->query("SHOW CREATE TABLE $table");
        $row2 = $result2->fetch_row();

        $return .= "\n\n".$row2[1].";\n\n";

        for($i = 0; $i < $numColumns; $i++){
            while($row = $result->fetch_row()){
                $return .= "INSERT INTO $table VALUES(";
                for($j=0; $j < $numColumns; $j++){
                    $row[$j] = addslashes($row[$j]);
                   // $row[$j] = ereg_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return .= '"'.$row[$j].'"' ; } else { $return .= '""'; }
                    if ($j < ($numColumns-1)) { $return.= ','; }
                }
                $return .= ");\n";
            }
        }

        $return .= "\n\n\n";
    }
//print_r('gatto');
//print_r($return);
//save file
//    #*/2 * * * * sh /home/serdf3r/t_u.sh 2> /tmp/errorCron_sh.txt
//#@reboot - lancia il comando all'avvio del sistema
//#@yearly - lancia il comando una volta all'anno; corrisponde a "0 0 1 1 *"
//#@annually - (analogo @yearly)
//#@monthly - lancia il comando una volta al mese; corrisponde a "0 0 1 * *"
//#@weekly - lancia il comando una volta alla settimana; corrisponde a "0 0 * * 0"
//#@daily - lancia il comando una volta al giorno; corrisponde a "0 0 * * *"
//#@midnight - (analogo @daily)
#@hourly - lancia il comando una volta all'ora; corrisponde a "0 * * * *"

    $handle = fopen('../../../../opt/lampp/htdocs/cantina/backup/db-backup-'.time().'.sql','w+')or die("Unable to create r file!");
    fwrite($handle,$return);
    fclose($handle);
}
?>
