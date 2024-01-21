<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class UrlsTest extends TestCase
{
    public function testSePuedeObtenerUrlAcortadaYRedireccioneALaOriginal(): void
    {
        $this->withoutExceptionHandling();
        $exampleUrl = 'https://www.clavesegura.org';

        //Recibimos la clase RedirectResponse
        $redirectedUrl = $this->post('/api/v1/short-urls/?url='.$exampleUrl);

        //Verificar que tengo de respuesta una redireccion 
        $redirectedUrl->assertStatus(Response::HTTP_FOUND);

        //Verificamos que contenga algo en la respuesta
        $this->assertNotEmpty($redirectedUrl);

        //obtener la url de la cabecera
        $locationHeader = $redirectedUrl->headers->get('Location');

        //Verificar que la respuesta devuelve la url acortada esperada
        $this->assertEquals('http://tinyurl.com/yqyzevbc', $locationHeader);  

    }
        


        //Verficar que devuelva un atributo url dentro del json

    //Debe tener un endpoint funcional tipo post

    // la url recibida por parametro debe ser tipo string y requerida

   




}
