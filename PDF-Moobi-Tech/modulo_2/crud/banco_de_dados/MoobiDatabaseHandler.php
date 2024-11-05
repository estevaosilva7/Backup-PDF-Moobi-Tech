<?php
class MoobiDatabaseHandler {
    private $mHost;
    private $mPort;
    private $mUsuario;
    private $mSenha;
    private $pdo;
    private $bTransactionFailed = false;

    public function __construct($mHost, $mPort, $mUsuario, $mSenha, $mDbname) {
        $dsn = "mysql:host=$mHost;port=$mPort;dbname=$mDbname";

        try {
            $this->pdo = new PDO($dsn, $mUsuario, $mSenha);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Banco não conectado: " . $e->getMessage());
        }
    }

    public function query(string $sql, array $aParametros = []) {
        try {
            $bStatement = $this->pdo->prepare($sql);
            $bStatement->execute($aParametros);
            return $bStatement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro na consulta: " . $e->getMessage();
            return false;
        }
    }

    public function execute($sql, $aParametros = []) {
        try {
            $bStatement = $this->pdo->prepare($sql);
            foreach ($aParametros as $key => $value) {
                $bStatement->bindValue($key, $value);
            }
            return $bStatement->execute();
        } catch (PDOException $e) {
            echo "Erro de execução: " . $e->getMessage();
            return false;
        }
    }

    public function startTransaction() {
        $this->bTransactionFailed = false;
        $this->pdo->beginTransaction();
    }

    public function failTransaction() {
        $this->bTransactionFailed = true;
    }

    public function endTransaction() {
        if ($this->bTransactionFailed) {
            $this->pdo->rollBack();
        } else {
            $this->pdo->commit();
        }
    }
}