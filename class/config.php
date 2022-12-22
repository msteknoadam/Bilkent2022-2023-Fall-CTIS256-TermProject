<?php
class dbConfig {
    protected $serverName;
    protected $userName;
    protected $password;
    protected $dbName;
    function dbConfig() {
        $this -> serverName = 'localhost';
        $this -> userName = 'ctis256';
        $this -> password = 'ctis256';
        $this -> dbName = 'ctis256';
    }
}
?>