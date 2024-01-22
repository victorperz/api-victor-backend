<?php

namespace Tests\Feature;

use Tests\TestCase;

class UrlsTest extends TestCase
{
    public function testSePuedeObtenerUrlAcortadaYRedireccioneALaOriginal(): void
    {    
        // Enviamos token para pasar la autorizacion del middleware   
        $token = '{}';
        $data  = [
            'url' => 'https://www.clavesegura.org'
        ];

        $jsonResponse = $this->withHeaders([
                                    'Authorization' => 'Bearer ' . $token,
                           ])->post(route('api.v1.urls'),$data);

        $jsonResponse->assertOk();

        $this->assertNotEmpty($jsonResponse);

        //Validar que la respuesta devuelve la url acortada esperada
        $this->assertEquals('http://tinyurl.com/yqyzevbc', $jsonResponse['url']);  

        //Validar que viene una key url de la respuesta
        $this->assertArrayHasKey('url', $jsonResponse);
    }
}
