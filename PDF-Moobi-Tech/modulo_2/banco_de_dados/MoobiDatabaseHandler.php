<?php
class MoobiDatabaseHandler {
    private $host;
    private $port;
    private $usuario;
    private $senha;
    private $pdo;
    private $transactionFailed = false;

    public function __construct($host, $port, $usuario, $senha, $dbname) {
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname";

        try {
            $this->pdo = new PDO($dsn, $usuario, $senha);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Banco não conectado: " . $e->getMessage());
        }
    }

    public function query(string $sql, array $aParametros = []) {
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($aParametros);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
            return false;
        }
    }

    public function execute($sql, $aParametros = []) {
        try {
            $statement = $this->pdo->prepare($sql);
            foreach ($aParametros as $key => $value) {
                $statement->bindValue($key, $value);
            }
            return $statement->execute();
        } catch (PDOException $e) {
            echo "Erro de execução: " . $e->getMessage();
            return false;
        }
    }

    public function startTransaction() {
        $this->transactionFailed = false;
        $this->pdo->beginTransaction();
    }

    public function failTransaction() {
        $this->transactionFailed = true;
    }

    public function endTransaction() {
        if ($this->transactionFailed) {
            $this->pdo->rollBack();
        } else {
            $this->pdo->commit();
        }
    }


}
