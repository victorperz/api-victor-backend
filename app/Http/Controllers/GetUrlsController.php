<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Src\BoundedContext\Urls\Infrastructure\GetUrlsController as UrlsInfrastructure;

class GetUrlsController extends Controller
{
    private $getUrlsController;

    public function __construct() 
    {
        $this->getUrlsController = new UrlsInfrastructure();
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $resp           = $this->getUrlsController->__invoke($request);
        $urlFormat      = $resp->formatUrlToJson();
        // Le damos formato estructura php
        $getUrlFromJson = json_decode($urlFormat->getContent(), true);

        return $getUrlFromJson;

    }
}
