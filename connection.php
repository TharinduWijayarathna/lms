<?php
class Database{
    
    public static $connection;

    public static function setUpConnection()
    {
        if (!isset(Database::$connection)) {
            Database::$connection = new mysqli("localhost", "root", "Wikum@123", "lms_jiat", "3306");
        }
    }
    public static function iud($q)
    {
        Database::setUpConnection();
        Database::$connection->query($q);
    }
    public static function search($q)
    {
        Database::setUpConnection();
        $resultset = Database::$connection->query($q);
        return $resultset;
    }
}
?>