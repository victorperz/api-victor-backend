<?php

namespace Tests\Feature;

use Tests\TestCase;

class ParenthesisMiddlewareTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSePuedeValidarQueLaAutorizacionBearerTokenFunciona(): void
    {   

        $token = '{{{}()()[]Hol(a) esta es una prueba}}';
        $data  = [
            'url' => 'https://www.linkedin.com'
        ];

        $response = $this->withHeaders([
                            'Authorization' => 'Bearer ' . $token,
                       ])->post(route('api.v1.urls'),$data);
        
        $response->assertOk();
    }
}
