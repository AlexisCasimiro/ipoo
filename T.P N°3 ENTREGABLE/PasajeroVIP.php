<?php

class PasajeroVIP extends Pasajero{
    //atributos
    private $nroViajeroFrecuente;
    private $cantMillas;

    public function __construct($nombre, $apellido, $dni, $telefono,$nroAsiento,$nroTicketPasaje,$nroViajeroFrecuente,$cantMillas){
        parent::__construct($nombre, $apellido, $dni, $telefono,$nroAsiento,$nroTicketPasaje);
        $this->nroViajeroFrecuente=$nroViajeroFrecuente;
        $this->cantMillas=$cantMillas;
    }

    //retorna el numero de viajero Frecuente
    public function getNroViajeFrecuente(){
        return $this->nroViajeroFrecuente;
    }

    //setea el numero de viajero frecuente
    public function setNroViajeFrecuente($nroViajeroFrecuente){
        $this->nroViajeroFrecuente=$nroViajeroFrecuente;
    }

    //retorna la cantidad de millas
    public function getCantMillas(){
        return $this->cantMillas;
    }

    //setea la cantiad de millas
    public function setCantMillas($cantMillas){
        $this->cantMillas=$cantMillas;
    }

    //funcion que retorna el porcentaje para el pasajero VIP
    public function darPorcentajeIncremento(){
        $porcentaje=35;
        $millas=$this->getCantMillas();
        if($millas>=300){
            $porcentaje=30;
        }
        return $porcentaje;
    }


    public function __toString(){
        $cadena=parent::__toString();
        $cadena.="\nNumero de Viajero Frecuente:".$this->getNroViajeFrecuente()."\nCantidad de millas:".$this->getCantMillas();
        return $cadena;
    }
}