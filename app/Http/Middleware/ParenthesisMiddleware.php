<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ParenthesisMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        //obtener el token en solicitud
        $token = $request->bearerToken();

        // validar los parentesis para vareficar si damos acceso o no
        $validateToken = $this->validateParenthesis($token);

        //validamos la estructura (abrir cerrar con el mismo tipo)
        if(!$validateToken){
            return response()->json(['error' => 'Not authorized'], 401);
        }        
        return $next($request);
    }

    public function validateParenthesis($token){

        //Variable para para guardar la pila de parentesis abiertos
        $stack = [];

        // Definimos los caracteres de cierre y apertura
        $close = ")]}";
        $open  = "{[(";

        // Creamos un array de comparación para verificar la correspondencia de paréntesis
        $compare = array(
            ")" => "(",
            "]" => "[",
            "}" => "{"
            );
        // Dividimos la cadena para iterarla
        $data  = str_split($token);

        // iteramos
        foreach($data as $character){
            //Comparamos si los parentesis que cierran )]} existe en la variable character
            if (str_contains($close,$character))
            {
                /* Si la pila está vacía y el paréntesis de cierre no tiene
                 un correspondiente paréntesis de apertura en la pila, 
                 entonces la expresión no está autorizada. 
                 Devolvemos false y un mensaje. */
                if (count($stack) == 0)
                    return false;

                /* Si el paréntesis de cierre tiene un correspondiente
                 paréntesis de apertura, lo eliminamos de la pila*/
                if ($stack[count($stack) - 1] == $compare[$character])
                {
                    array_pop($stack);
                }else{
                    return false;        
                }
               
            } elseif(str_contains($open,$character)){
                /* Si el caracter actual es un paréntesis 
                de apertura, lo agregamos a la pila*/
                array_push($stack,$character);
            }
        }
        if(count($stack) == 0) 
            return true;
        else
            // Si la pila no esta vacia, hay parentesis que no fueron cerrados.
            return false; 
    }
}
