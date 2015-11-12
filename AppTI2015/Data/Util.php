<?php

namespace Data;

class Util
{
    public static function converterParaCamelCase($string, $primeiraLetraMinuscula = false)
    {
        $palavras = array_map(function($palavra) {
            return ucfirst(strtolower($palavra));
        }, explode('_', $string));

        if ($primeiraLetraMinuscula) {
            $palavras[0] = strtolower($palavras[0]);
        }

        return implode('', $palavras);
    }
}