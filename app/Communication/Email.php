<?php

namespace App\Communication;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class Email {
  /** Credenciais de acesso ao SMTP */
  const HOST = "smtp.gmail.com";
  const USER = "[EMAIL]";
  const PASS = "[SENHA]";
  const SECURE = "TLS";
  const PORT = 587;
  const CHARSET = "UTF-8";

  /** Dados do remetente */
  const FROM_EMAIL = "[EMAIL]";
  const FROM_NAME = "[NOME]";

  /** Mensagem de erro do envio */
  private $error = "";

  /**
   * Método responsável por retornar a mensagem de erro do envio
   * @return string
   */
  public function getError() {
    return $this->error;
  }

  /**
   * Método responsável por enviar um e-mail
   * @param string|array $addresses
   * @param string $subject
   * @param string $body
   * @param string|array $attachments
   * @param string|array $ccs
   * @param string|array $bccs
   * @return boolean
   */
  public function sendEmail($addresses, $subject, $body, $atachments = [], $ccs = [], $bccs = []) {
    $this->error = "";
    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP(true);
      $mail->Host = self::HOST;
      $mail->SMTPAuth = true;
      $mail->Username = self::USER;
      $mail->Password = self::PASS;
      $mail->SMTPSecure = self::SECURE;
      $mail->Port = self::PORT;
      $mail->CharSet = self::CHARSET;

      $mail->setFrom(self::FROM_EMAIL, self::FROM_NAME);

      $addresses = is_array($addresses) ? $addresses : [$addresses];

      foreach($addresses as $address) {
        $mail->addAddress($address);
      }

      $atachments = is_array($atachments) ? $atachments : [$atachments];

      foreach($atachments as $atachment) {
        $mail->addAttachment($atachment);
      }

      $ccs = is_array($ccs) ? $ccs : [$ccs];

      foreach($ccs as $cc) {
        $mail->addCC($cc);
      }

      $bccs = is_array($bccs) ? $bccs : [$bccs];

      foreach($bccs as $bcc) {
        $mail->addBCC($bcc);
      }

      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = $body;

      return $mail->send();
    } catch(PHPMailerException $exception) {
      $this->error = $exception->getMessage();
      return false;
    }
  }
}
