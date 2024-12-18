<?php
class MoobiDatabaseHandler {

    private $host = "localhost";
    private $port = 3305;
    private $dbname = 'sindicato';
    private $usuario = "root";
    private $senha = '';
    private $dbh;

    public function __construct() {
        $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->dbname";
        $opcoes = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->usuario, $this->senha, $opcoes);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        } die();
    }
}
