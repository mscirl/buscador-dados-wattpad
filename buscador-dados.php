<?php

require 'vendor/autoload.php';

//'chamando' o código do outro arquivo em src
use Thais\BuscadorDeDadosWattpad\Buscar;

//especificar o método no .php que estará na pasta src 'GET'
$client = new Client(['base_uri' => 'https://www.wattpad.com/user']);
$crawler = new Crawler();

