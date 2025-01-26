<?php

// Carrega o autoload do Composer com caminho absoluto
require __DIR__ . '/vendor/autoload.php';


//'chamando' o código do outro arquivo em src
use Thais\BuscadorDadosWattpad\Buscar;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;


    // Configura o Client do Guzzle corretamente
    $client = new Client(['base_uri' => 'https://www.wattpad.com/']);

    $crawler = new Crawler();

    // Cria o buscador
    $buscador = new Buscar($client, $crawler);

    // Complemento da URL levando para o perfil
    $resultados = $buscador->buscar('/user/xxmonxxx');

    print_r($resultados);