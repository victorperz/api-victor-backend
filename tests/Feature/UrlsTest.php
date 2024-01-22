<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class UrlsTest extends TestCase
{
    public function testSePuedeObtenerUrlAcortadaYRedireccioneALaOriginal(): void
    {$this->withoutExceptionHandling();
        $exampleUrl = 'https://www.clavesegura.org';

        $jsonResponse = $this->post('/api/v1/short-urls/?url='.$exampleUrl);

        $jsonResponse->assertOk();

        $this->assertNotEmpty($jsonResponse);

        //Validar que la respuesta devuelve la url acortada esperada
        $this->assertEquals('http://tinyurl.com/yqyzevbc', $jsonResponse['url']);  

        //Validar que viene una key url de la respuesta
        $this->assertArrayHasKey('url', $jsonResponse);
    }
}
