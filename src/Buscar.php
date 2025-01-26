<?php

namespace Thais\BuscadorDadosWattpad;

// Utilizando o método da dependência Guzzle
use GuzzleHttp\ClientInterface;
// Utilizando a dependência do Symfony, Crawler, que busca informações
use Symfony\Component\DomCrawler\Crawler;

class Buscar {
    private $httpClient;
    private $crawler;

    // Construtor que recebe as dependências necessárias
    public function __construct(ClientInterface $httpClient, Crawler $crawler) {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    // Função que busca os dados: recebe a URL e retorna um array com os resultados
    public function buscar(string $url): array {
        // Faz a requisição HTTP GET para a URL especificada no arquivo buscador-dados
        $response = $this->httpClient->request('GET', $url);
        
        // Obtém o corpo da resposta (conteúdo HTML)
        $html = $response->getBody();
        
        // Carrega o conteúdo HTML no Crawler
        $this->crawler->addHtmlContent($html);

        // Extrai todas as histórias usando o seletor do container de cada história
        $historias = $this->crawler->filter('.discover-module-stories-large')->each(function ($node) {
            // Extrai o título da história através da classe css
            $titulo = $node->filter('a.title.meta.on-story-preview')->text();
            // Extrai os dados numéricos de leituras, votos e partes através de css também
            $leituras = $node->filter('.meta.social-meta span.read-count')->text();
            $votos = $node->filter('.meta.social-meta span.vote-count')->text();
            $partes = $node->filter('.meta.social-meta span.part-count')->text();


            // Retorna os dados formatados de cada história
            return [
                'História' => trim($titulo),
                'Leituras' => $leituras,
                'Votos' => $votos,
                'Partes' => $partes
            ];
        });

        // Retorna o array com todas as histórias encontradas no perfil com seus reespectivos dados
        return $historias;
    }
}