<?php

/**
 * Classe para gerenciar a conexão com o banco de dados utilizando PDO.
 * Contém métodos para estabelecer a conexão e retornar a instância do PDO.
 *
 * @author Estevão carlosestevano@moobitech.com.br
 */
class MoobiDatabaseHandler {
    private $mHost;
    private $mDb;
    private $mUser;
    private $mPassword;
    private $pdo;

    /**
     * Construtor da classe MoobiDatabaseHandler.
     * Inicializa os parâmetros de conexão e estabelece a conexão com o banco de dados.
     *
     * @param string $mHost     O host do banco de dados (default: 'localhost').
     * @param string $mDb       O nome do banco de dados (default: 'sindicato').
     * @param string $mUser     O nome de usuário do banco de dados (default: 'root').
     * @param string $mPassword A senha do usuário do banco de dados (default: 'Test123@').
     */
    public function __construct($mHost = 'localhost', $mDb = 'sindicato', $mUser = 'root', $mPassword = 'Test123@') {
        $this->mHost = $mHost;
        $this->mDb = $mDb;
        $this->mUser = $mUser;
        $this->mPassword = $mPassword;
        $this->connect(); // Chama o método para estabelecer a conexão.
    }

    /**
     * Estabelece a conexão com o banco de dados utilizando PDO.
     * Configura a instância PDO para lançar exceções em caso de erro.
     *
     * @throws PDOException Se houver erro na conexão com o banco de dados.
     */
    private function connect() {
        try {
            // Estabelece a conexão com o banco de dados.
            $this->pdo = new PDO("mysql:host={$this->mHost};dbname={$this->mDb}", $this->mUser, $this->mPassword);
            // Define o modo de erro para exceção.
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Se ocorrer um erro de conexão, a execução é interrompida e a mensagem de erro é exibida.
            die("Erro de conexão: " . $e->getMessage());
        }
    }

    /**
     * Retorna a instância do PDO para realizar consultas no banco de dados.
     *
     * @return PDO A instância do PDO conectada ao banco de dados.
     */
    public function getConnection() {
        return $this->pdo;
    }
}

// Exemplo de uso da classe:
// try {
//     $db = new MoobiDatabaseHandler();
//     $pdo = $db->getConnection();
//     // Agora você pode usar a variável $pdo para fazer consultas ao banco de dados.
//     echo "Conexão estabelecida com sucesso!";
// } catch (Exception $e) {
//     echo $e->getMessage();
// }

?>
