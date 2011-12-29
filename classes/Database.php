<?php
define('SQL_HOST','localhost');
define('SQL_USER','root');
define('SQL_PASS','pasok');
define('SQL_DB','todo_db');

class Database
{
   private static $instance; // stores the MySQLi instance
 
   private function __construct() { } // block directly instantiating
   private function __clone() { } // block cloning of the object
 
   public static function get()
   {
      // create the instance if it does not exist
      if(!isset(self::$instance))
      {
         // the MYSQL_* constants should be set to or
         //  replaced with your db connection details
         self::$instance = new MySQLi(SQL_HOST, SQL_USER, SQL_PASS, SQL_DB);
         if(self::$instance->connect_error)
         {
            throw new Exception('MySQL connection failed: ' . self::$instance->connect_error);
         }
      }
      // return the instance
      return self::$instance;
   }
}

// to use:
// $result = Database::get()->query("SELECT * FROM ...");
?>