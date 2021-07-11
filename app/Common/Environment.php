<?php

namespace App\Common;

class Environment {
  /**
   * Método responsável por carregar as variáveis de ambiente do projeto
   * @param string $dir Caminho absoluto da pasta onde encontra-se o arquivo .env
   */
  public static function load($dir) {
    if(!file_exists($dir . "/.env")) {
      return false;
    }

    $lines = file($dir . "/.env");

    // echo "<pre>"; print_r($lines); echo "</pre>";

    foreach($lines as $line) {
      putenv(trim($line));
    }
  }
}
