<?php

require __DIR__ . "/bootstrap/app.php";

use \App\Communication\Email;

$address = "matheus.moovery@gmail.com";
$subject = "Arquivo Anexo via ENV";
$body = "Segue arquivo de teste";
$attachment = __DIR__ . "/anexo-teste.txt";

$email = new Email();
$sucesso = $email->sendEmail($address, $subject, $body, $attachment);

echo $sucesso ? "Mensagem enviada com sucesso" : $email->getError();
