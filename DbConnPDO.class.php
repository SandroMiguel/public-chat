<?php
/**
 * PDO Database connection
 * Representa a ligação global à base de dados
 *
 * @package		Chat\PDO
 * @author		Sandro Miguel Marques <sandromiguel@produlogia.com>
 * @version		v.1.0 (13/01/2016)
 */

class DbConnPDO extends PDO {
    /** @var string|null Mensagem de erro */
    private $_error = null;

    /**
     * Construtor
     * Abrir a ligação à base de dados
     */
    public function __construct() {
        $connection_string = sprintf('mysql:host=%s;dbname=%s;charset=UTF8', DB_HOSTNAME, DB_NAME);
        try {
            parent::__construct($connection_string, DB_USERNAME, DB_PASSWORD);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            throw $e;
        }
    }

    /**
     * Mostra o erro.
     *
     * @return string Devolve o erro.
     */
    public function getError() {
        return $this->_error;
    }
    
    /**
     * Fecha a ligação à base de dados quando o objeto é destruido
     */
    public function __destruct() {
        $this->conn = null;
    }
}