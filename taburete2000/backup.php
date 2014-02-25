<?php
/**
 * This file contains the Backup_Database class wich performs
 * a partial or complete backup of any given MySQL database
 * @author Daniel López Azaña <http://www.daniloaz.com>
 * @version 1.0
 */

/**
 * Original article: http://www.daniloaz.com/en/560/programming/backup-de-bases-de-datos-mysql-con-php/
 */

/**
 * Changes by J.P. Hendrix:
 * ereg_replace("\n","\\n",$row[$j]); => preg_replace( '/\n/ , "\\n" , $row[$j] );
 * mysql_... => PDO
 */

// Report all errors
error_reporting(E_ALL);
 
/**
 * Define database parameters here
 */
define("DB_USER", 'root');
define("DB_PASSWORD", '');
define("DB_NAME", 'formula1');
define("DB_HOST", 'localhost');
define("OUTPUT_DIR", 'cache');
define("TABLES", '*');

/**
 * Instantiate Backup_Database and perform backup
 */
$backupDatabase = new Backup_Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$status = $backupDatabase->backupTables(TABLES, OUTPUT_DIR) ? 'OK' : 'KO';
echo "<br /><br /><br />Backup result: ".$status;
 
/**
 * The Backup_Database class
 */
class Backup_Database {
    /**
     * Host where database is located
     */
    var $host = '';
 
    /**
     * Username used to connect to database
     */
    var $username = '';
 
    /**
     * Password used to connect to database
     */
    var $passwd = '';
 
    /**
     * Database to backup
     */
    var $dbName = '';
 
    /**
     * Database charset
     */
    var $charset = '';
 
    /**
     * Connection variable
     */

    var $db = '';
 
    /**
     * Constructor initializes database
     */
    function Backup_Database($host, $username, $passwd, $dbName, $charset = 'utf8')
    {
        $this->host     = $host;
        $this->username = $username;
        $this->passwd   = $passwd;
        $this->dbName   = $dbName;
        $this->charset  = $charset;
 
        $this->initializeDatabase();
    }
 
    //protected function initializeDatabase()
    function initializeDatabase()
    {
        $this->db = new PDO("mysql:host=$this->host;dbname=$this->dbName;charset=$this->charset", $this->username, $this->passwd );
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
 
    /**
     * Backup the whole database or just some tables
     * Use '*' for whole database or 'table1 table2 table3...'
     * @param string $tables
     */
    public function backupTables($tables = '*', $outputDir = '.')
    {
        try
        {
            /**
            * Tables to export
            */
            if($tables == '*')
            {
                $tables = array();
                foreach( $this->db->query('SHOW TABLES') as $row )
                {
                    $tables[] = $row[0];
                }
            }
            else
            {
                $tables = is_array($tables) ? $tables : explode(',',$tables);
            }
 
            $sql = 'CREATE DATABASE IF NOT EXISTS '.$this->dbName.";\n\n";
            $sql .= 'USE '.$this->dbName.";\n\n";
 
            /**
            * Iterate tables
            */
            foreach($tables as $table)
            {
                echo "Backing up ".$table." table...";
 
                $result = $this->db->query( 'SELECT * FROM ' . $table );
                $numFields = $result->columnCount();
 
                $sql .= 'DROP TABLE IF EXISTS '.$table.';';
                $result2 = $this->db->query( 'SHOW CREATE TABLE ' . $table );
                $row2 = $result2->fetch();

                $sql.= "\n\n".$row2[1].";\n\n";
 
                for ($i = 0; $i < $numFields; $i++)
                {
                    // while($row = mysql_fetch_row($result))
                    while( $row = $result->fetch() )
                    {
                        $sql .= 'INSERT INTO '.$table.' VALUES(';
                        for($j=0; $j<$numFields; $j++)
                        {
                            $row[$j] = addslashes($row[$j]);
                            $row[$j] = preg_replace( '/\n/' , "\\n" , $row[$j] );
                            if (isset($row[$j]))
                            {
                                $sql .= '"'.$row[$j].'"' ;
                            }
                            else
                            {
                                $sql.= '""';
                            }
 
                            if ($j < ($numFields-1))
                            {
                                $sql .= ',';
                            }
                        }
 
                        $sql.= ");\n";
                    }
                }
 
                $sql.="\n\n\n";
 
                echo " OK" . "<br />";
            }
        }
        catch (Exception $e)
        {
            var_dump($e->getMessage());
            return false;
        }
 
        return $this->saveFile($sql, $outputDir);
    }
 
    /**
     * Save SQL to file
     * @param string $sql
     */
    protected function saveFile(&$sql, $outputDir = '.')
    {
        if (!$sql) return false;
 
        try
        {
            $handle = fopen($outputDir.'/db-backup-'.$this->dbName.'-'.date("Ymd-His", time()).'.sql','w+');
            fwrite($handle, $sql);
            fclose($handle);
        }
        catch (Exception $e)
        {
            var_dump($e->getMessage());
            return false;
        }
 
        return true;
    }
}
