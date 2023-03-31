<?php

class Viaje{
    //atributos
    private $codigoViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $cantPasajeros;
    private $datosPasajero;

    //metodos
    public function __construct($codigoViaje,$destino,$cantMaxPasajeros){
        $this->codigoViaje=$codigoViaje;
        $this->destino=$destino;
        $this->cantMaxPasajeros=$cantMaxPasajeros;
        $this->cantPasajeros=0;
        $this->datosPasajero=[];
    }

    //retorna el codigo del viaje
    public function getCodigoViaje($codigoViaje){
        return $this->codigoViaje;
    }

    //setea el valor del codigo del viaje
    public function setCodigoViaje($codigoViaje){
        $this->codigoViaje=$codigoViaje;
    }

    //retorna el destino
    public function getDestino($destino){
        return $this->destino;
    }

    //setea el destino
    public function setDestino($destino){
        $this->destino=$destino;
    }

    //retorna cantidad maxima de pasajeros
    public function getMaxPasajeros($cantMaxPasajeros){
        return $this->cantMaxPasajeros;
    }

    //setea cantidad maxima de pasajeros
    public function setMaxPasajeros($cantMaxPasajeros){
        $this->cantMaxPasajeros=$cantMaxPasajeros;
    }

    //retorna cantidad de pasajeros
    public function getPasajeros($cantPasajeros){
        return $this->cantPasajeros;
    }

    //setea cantidad de pasajeros 
    public function setPasajeros($cantPasajeros){
        $this->cantPasajeros=$cantPasajeros;
    }

    //retorna datos de pasajeros
    public function getDatPasajeros($datosPasajero){
        return $this->datosPasajero;
    }

    //setea datos de pasajeros

    //no creo que haga falta esto
    /**public function setDatPasajeros($datosPasajero){
      *  $this->datosPasajero=$datosPasajero;
    }*/

    
    //la cantidad la puedo hacer con un for o un while en el test..... con get llamo el valor de la variable

    //metodo que permite agregar datos de un pasajero
    public function agregarPasajero($nombre,$apellido,$dni){
            $pasajero=[
            "nombre"=>$nombre,
            "apellido"=>$apellido,
            "documento"=>$dni,
        ];
        array_push($this->datosPasajero,$pasajero);
        $cantPasajeros=$this->getPasajeros()+1;
        setPasajeros($cantPasajeros);
    }
    //el dni lo uso como id para cambiar los datos del pasajero
    //usar un do while o while para encontrar el dni
    public function buscaPasajero ($dni){
        $indice=$this->cantPasajeros;
        while($this->datosPasajero[$indice]["documento"] != $dni){
            $indice=$indice-1;
        }
        return $indice;
    }






    //foreach concatenando los datos de los pasajeros para crear una cadena en una variable








    //
    public function __toString()
    {
        return "Codigo del viaje:".$this->codigoViaje."\n 
        Destino:".$this->destino."\n 
        Cantidad maxima de pasajeros:".$this->cantMaxPasajeros."\n 
        Cantidad de pasajeros:".$this->pasajeros;
    }
}