<?php

declare(strict_types=1);

namespace Src\BoundedContext\Urls\Application;

use GuzzleHttp\Client;
use Src\BoundedContext\Urls\Domain\ValueObjects\ExternalUrl;
use Src\BoundedContext\Urls\Domain\ValueObjects\FormattedUrl;
use Src\BoundedContext\Urls\Domain\ValueObjects\ReceivedUrl;

final class GetUrlsUseCase
{
    public function __construct(
        private string $externalUrl, 
        private string $receivedUrl
        ){}

    public function __invoke()
    {
     //Validar que sea una url valida en la capa del dominio
     $urlApiExternal = new ExternalUrl($this->externalUrl);
     $urlReceived    = new ReceivedUrl($this->receivedUrl);
     $url            = $urlApiExternal->value().$urlReceived->value();
        
     //Ejecutar peticion http con cliente GuzzleHttp
     $client   = new Client();
     $response = $client->request('GET', $url);
     //Obtener el cuerpo de la peticion y devolver el contenido como cadena de caracteres
     $body     = $response->getBody()->getContents();

     $respJson = new FormattedUrl($body);

     return $respJson;
    }
}




