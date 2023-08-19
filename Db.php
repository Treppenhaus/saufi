<?php
class Db {
    protected $host;
    protected $username;
    protected $password;
    protected $database;
    private $connection;

    public function __construct($host, $username = "root", $password = "", $database) {
        $this -> host = $host;
        $this -> username = $username;
        $this -> password = $password;
        $this -> database = $database;
        $this -> connection = new mysqli($host, $username, $password, $database);
    }

    public function query($query) {
        return $this -> connection -> query($query);
    }

    public function hash($pass) {
        return hash("sha512", $pass);
    }

    public function loggedin() {
        return isset($_SESSION["nickname"]);
    }
}
?>