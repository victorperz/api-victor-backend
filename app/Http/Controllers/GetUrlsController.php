<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Src\BoundedContext\Urls\Infrastructure\GetUrlsController as UrlsInfrastructure;

class GetUrlsController extends Controller
{
    private $getUrlsController;

    public function __construct() 
    {
        /**
        * Del controlador hacemos referencia a la capa de infraestructura
        * llamando a la clase infraestructura en el constructor
        */
        $this->getUrlsController = new UrlsInfrastructure();
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // hacemos referencia al metodo magico invoke
        $resp = $this->getUrlsController->__invoke($request);

        return redirect($resp);
    }
}
