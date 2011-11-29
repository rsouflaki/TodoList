<?php
class Database
{
   private static $instance; // stores the MySQLi instance
 
   private function __construct() { } // block directly instantiating
   private function __clone() { } // block cloning of the object
 
   public static function get() {
      // create the instance if it does not exist
      if(!isset(self::$instance)) {
         // the MYSQL_* constants should be set to or
         //  replaced with your db connection details
         self::$instance = new MySQLi(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
         if(self::$instance->connect_error) {
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