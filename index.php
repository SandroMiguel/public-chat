<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors','On');
?>
<!doctype html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <title>Chat público</title>
  <meta name="description" content="Chat público" />
  <meta name="author" content="Sandro Marques">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="styles.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>

<body>
  <div class="outer">
    <div class="middle">
      <div class="inner">
        <div id="logo"></div>
        <div id="container_nickname">
          <div id="content_insert"></div>
          <div id="content_replace">
            <form name="form_nickname" id="form_nickname" method="post" action="nickname.ajax.php">
              <p>Nickname</p>
              <input name="nickname" type="text" autofocus required class="general_textbox" id="nickname" maxlength="32">
              <button>Entrar</button>
            </form>  
          </div>
        </div>
      </div>
    </div>
  </div>  
</body>

<script>
'use strict';
function resetContentInsert() {
	if ($('#content_insert').children().length > 0) {
		// existe uma mensagem > remover conteúdo com animação
		$('#content_insert').animate({
			height: 0
		}, "fast", function() {
			$(this).empty();
            $('#content_insert').removeAttr('style');
		});	
	}
}
$(document).ready(function() {
    // submeter formulário pela função sendForm()
    $('#form_nickname').on('submit', function(e) {
        e.preventDefault();
        sendForm();
    });
    
    function sendForm() {
        var msg_error = 'Ocorreu um erro';
        var msg_timeout = 'O servidor não está a responder';
        var message = '';
        var form = $('#form_nickname');
        resetContentInsert();
        $.ajax({
            data: form.serialize(),
            url: form.attr('action'),
            type: form.attr('method'),
            dataType: "json",
            error: function(xhr, status, error) {
                if (status==="timeout") {
                    message = msg_timeout;
                    message = '<div class="bg-error">'+ message +'</div>';
                    $('#content_insert').empty().html(message).hide().fadeIn('slow');
                } else {
                    message = msg_error;
                    message = '<div class="bg-error">'+ message +'</div>';
                    $('#content_insert').empty().html(message).hide().fadeIn('slow');
                }
            },
            success: function(response) {
                var action 	= response.action;
                var notification = response.notification;
                var bg_notification = null;
                switch (notification) {
                    case 'success':
                        bg_notification = 'bg-success';
                        break;    
                    case 'error':
                        bg_notification = 'bg-error';
                        break;    
                }
                message = '<div class="'+ bg_notification +'">'+ response.message +'</div>';
                if (action === 'insert') {
                    $('#content_insert').finish();
                    $('#content_insert').removeAttr('style');
                    $('#content_insert').empty().html(message).hide().fadeIn('slow');
                } else {
                    $('#content_replace').empty().html(message).hide().fadeIn('slow');
                    setTimeout(function(){window.location="chat.php"} , 1000);
                }
            },
            timeout: 7000
        });
    }
});
</script>
</html>