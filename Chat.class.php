<?php
/**
 * Mensagens do chat
 *
 * @package     Chat\Messages
 * @author      Sandro Miguel Marques <sandromiguel@produlogia.com>
 * @version     v.1.0 (07/04/2016)
 * @copyright   Copyright (c) 2016, Sandro
 */

class Chat extends DbConnPDO {
    /** @var string|null Query SQL */
    private $_sql;
    
    /**
     * Construtor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Lê as últimas x mensagens.
     *
     * @param int $limit Número de mensagens
     *
     * @return boolean Devolve 'true' se o nickname já existir.
     */
    public function getMessages($limit) {
        try {
            $this->_sql = '
                SELECT 
                    `FromNickname`, 
                    `Message` 
                FROM 
                    `'. MESSAGES .'` 
                ORDER BY 
                    IdMessage DESC 
                LIMIT :limit
            ';
            $stmt = $this->prepare($this->_sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            $obj = $stmt->fetchAll(PDO::FETCH_OBJ);
            $stmt->closeCursor();
            return $obj;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Insere uma mensagem na base de dados.
     *
     * @param string $from      Nickname que enviou a mensagem
     * @param string $message   Mensagem
     *
     * @return boolean Devolve 'true' em caso de sucesso ou 'false' em caso de erro.
     */
    public function insert($from, $message) {
        $this->_sql = 'INSERT INTO `'.MESSAGES.'` 
            (`FromNickname`, `Message`) 
            VALUES 
            (:from, :message)
            ';
        try {
            $stmt = $this->prepare($this->_sql);
            $stmt->bindParam(':from',       $from,      PDO::PARAM_STR);
            $stmt->bindParam(':message',    $message,   PDO::PARAM_STR);
            if ($stmt->execute()) {
                $stmt->closeCursor();
                return true;
            }
            $stmt->closeCursor();
            return false;
        } catch (Exception $e) {
            throw $e;
        }
    }
    
    /**
     * @return string Devolve a query SQL.
     */
    public function __toString() {
        if (is_null($this->_sql)) {
            return 'NULL';
        }
        return $this->_sql;
    }
}

