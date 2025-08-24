<?php

require 'core/SysMail.php'; // Ajuste o caminho para o arquivo SysMail.php

// Defina as variáveis necessárias
$mail = new Core\SysMail();
$emailTo = '17a0668d6b1fea@mailtrap.io'; // Coloque aqui o e-mail de teste do Mailtrap
$subject = 'Teste de Envio de E-mail';
$body = '<h1>Este é um e-mail de teste!</h1><p>Se você recebeu isso, o envio está funcionando.</p>';
$altBody = 'Este é um e-mail de teste 123! Se você recebeu isso, o envio está funcionando.';

// Tente enviar o e-mail
try {
    if ($mail->send($emailTo, $subject, $body, $altBody)) {
        echo "E-mail enviado com sucesso!";
    } else {
        echo "Falha ao enviar o e-mail.";
    }
} catch (Exception $e) {
    echo "Erro ao enviar o e-mail: " . $e->getMessage();
}
