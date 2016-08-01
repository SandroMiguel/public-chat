<?php
require 'constants.inc.php';
require 'DbConnPDO.class.php';
require 'Chat.class.php';

$nickname   = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_STRING);
$message    = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

# 1. Inserir a mensagen na base de dados
try {
    $chat = new Chat();
    $chat->insert($nickname, $message);
} catch (Exception $e) {
    echo 'ocorreu um erro ao fazer o INSERT na BD<br>';
    echo $e->getMessage().'<br>';
    echo $chat->__toString();
}
