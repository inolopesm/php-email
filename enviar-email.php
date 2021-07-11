<?php

require __DIR__ . "/bootstrap/app.php";

use \App\Communication\Email;

$address = "matheus.moovery@gmail.com";
$subject = "Olá mundo com ENV :)";
$body = "<b>Olá mundo</b><br>Parece que consegui enviar o e-mail.<br><i>Matheus da Moovery</i>";

$email = new Email();
$sucesso = $email->sendEmail($address, $subject, $body);

echo $sucesso ? "Mensagem enviada com sucesso" : $email->getError();
