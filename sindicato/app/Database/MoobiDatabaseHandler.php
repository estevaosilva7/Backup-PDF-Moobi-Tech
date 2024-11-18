<?php

class MoobiDatabaseHandler {
    private $host;
    private $db;
    private $user;
    private $password;
    private $pdo;

    public function __construct($host = 'localhost', $db = 'sindicato', $user = 'root', $password = 'Test123@') {
        $this->host = $host;
        $this->db = $db;
        $this->user = $user;
        $this->password = $password;
        $this->connect();
    }

    private function connect() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}


/* //Exemplo de uso da classe:
try {
    $db = new MoobiDatabaseHandler();
    $pdo = $db->getConnection();
    // Agora você pode usar a variável $pdo para fazer consultas ao banco de dados
    echo "Conexão estabelecida com sucesso!";
} catch (Exception $e) {
    echo $e->getMessage();
}

?>
*/