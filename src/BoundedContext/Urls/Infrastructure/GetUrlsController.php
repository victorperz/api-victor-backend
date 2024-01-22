<?php

declare(strict_types=1);

namespace Src\BoundedContext\Urls\Infrastructure;

use Illuminate\Http\Request;
use Src\BoundedContext\Urls\Application\GetUrlsUseCase;

final class GetUrlsController
{
    public function __invoke(Request $request)
    {
        // API externa
        $externalUrl = 'https://tinyurl.com/api-create.php?url=';
        
        // Captura de la url que vamos a acortar con el api de tinyurl
        $receivedUrl = $request->url;
  
        // Ambas variables las debemos pasar por parametro a la capa de aplicaciones (caso de uso)
        $getUrlsUseCase = new GetUrlsUseCase($externalUrl, $receivedUrl);
        $response       = $getUrlsUseCase->__invoke();

        return $response;
    }
}