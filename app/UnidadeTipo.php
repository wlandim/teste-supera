<?php

namespace App;

class UnidadeTipo
{
    const Json = 0;
    const Webview = 1;
    const XML = 2;
    const HL7 = 3;

    public function getTipos() {
        $tipos = [];
        $oClass = new \ReflectionClass(__CLASS__);

        $constantes = $oClass->getConstants();
        $constantes = array_flip($constantes);

        foreach ($constantes as $key=>$value) {
            $obj = new \stdClass();
            $obj->id = $key;
            $obj->tipo = $value;
            array_push($tipos, $obj);
        }

        return $tipos;
    }

    public function getTipo($valor) {
        $oClass = new \ReflectionClass(__CLASS__);
        $constantes = $oClass->getConstants();
        $constantes = array_flip($constantes);
        return $constantes[$valor];
    }
}
