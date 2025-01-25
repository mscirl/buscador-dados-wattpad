<?php

namespace Thais\BuscadorDeDadosWattpad;

//utilizando o método da dependência Guzzle
use GuzzleHttp\ClientInterface;
//utilizando a dependência do Symfony, Crawler, que busca informações
use Symfony\Component\DomCrawler\Crawler;

$response = $client->request('GET', $url);

class Buscar {

    public function __construct(ClientInterface $httpClient, Crawler $crawler) {
        $this->httpCliente = $http_Client;
        $this->crawler = $crawler;
    }

}