<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

require 'constants.inc.php';
require 'DbConnPDO.class.php';
require 'Chat.class.php';

# 1. Ler as mensagens da base de dados
try {
    $chat = new Chat();
    $messages = $chat->getMessages(10);
    echo json_encode($messages);
} catch (Exception $e) {
    $message = 'Ocorreu um erro.';
	if (DEFAULT_APP_DEBUG) {
		$message .= ' ' . $e->getMessage();
	}
	echo json_encode(
        array(
            "action"        =>  "insert",
            "notification"  =>  "error",
            "message"       =>  $message
        )
    );
    exit;
}
