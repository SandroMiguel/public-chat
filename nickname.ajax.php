<?php
session_start();

require 'constants.inc.php';
require 'DbConnPDO.class.php';
require 'User.class.php';

// Definir uma variável com o nickname recebido pelo método POST
$nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_STRING);

# 1. Verificar se o nickname contém o número mínimo de carateres
if (strlen($nickname) < 3) {
    $message = 'O nickname deve ter no mínimo 3 carateres';
    echo json_encode(
        array(
            'action'        =>  'insert',
            'notification'  =>  'error',
            'message'       =>  $message
        )
    );
    exit;
}

# 2. Verificar se o nickname já existe na base de dados
try {
    $user = new User();
    $nickname_exists = $user->checkNicknameExists($nickname);
    if ($nickname_exists) {
        $message = 'Este nickname já existe.';
        echo json_encode(
            array(
                'action'        => 'insert',
                'notification'  => 'error',
                'message'       =>  $message
            )
        );
        exit;
    }
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

# 3. Inserir o utilizador na base de dados
try {
    $user->insert($nickname);
    $_SESSION['nickname'] = $nickname;
    echo json_encode(
        array(
            'action'        =>  'replace',
            'notification'  =>  'success',
            'message'       =>  'Olá '.$nickname.', aguarde por favor...'
        )
    );    
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

