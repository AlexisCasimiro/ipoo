<?php

class Viaje{
    //atributos
    private $codigoViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $cantPasajeros;
    private $datosPasajero;
    private $cadena;

    //metodos
    public function __construct($codigoViaje,$destino,$cantMaxPasajeros){
        $this->codigoViaje=$codigoViaje;
        $this->destino=$destino;
        $this->cantMaxPasajeros=$cantMaxPasajeros;
        $this->cantPasajeros=0;
        $this->datosPasajero=[];
        $this->cadena="";
    }

    //retorna una cadena con todos los datos de los pasajeros
    public function getCadena(){
        return $this->cadena;
    }
    //setea la cadena de datos de pasajeros
    public function setCadena($cadena){
        $this->cadena=$cadena;
    }

    //retorna el codigo del viaje
    public function getCodigoViaje(){
        return $this->codigoViaje;
    }

    //setea el valor del codigo del viaje
    public function setCodigoViaje($codigoViaje){
        $this->codigoViaje=$codigoViaje;
    }

    //retorna el destino
    public function getDestino(){
        return $this->destino;
    }

    //setea el destino
    public function setDestino($destino){
        $this->destino=$destino;
    }

    //retorna cantidad maxima de pasajeros
    public function getMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }

    //setea cantidad maxima de pasajeros
    public function setMaxPasajeros($cantMaxPasajeros){
        $this->cantMaxPasajeros=$cantMaxPasajeros;
    }

    //retorna cantidad de pasajeros
    public function getPasajeros(){
        return $this->cantPasajeros;
    }

    //setea cantidad de pasajeros 
    public function setPasajeros($cantPasajeros){
        $this->cantPasajeros=$cantPasajeros;
    }

    //retorna datos de pasajeros
    public function getDatPasajeros(){
        return $this->datosPasajero;
    }
    //setea el array
    public function setDatPasajeros($datosPasajero){
        $this->datosPasajero=$datosPasajero;
    }
    

    //metodo que permite agregar datos de un pasajero
    public function agregarPasajero($nombre,$apellido,$dni){
            $pasajero=[
            "nombre"=>$nombre,
            "apellido"=>$apellido,
            "dni"=>$dni,
        ];
        array_push($this->getDatPasajero(),$pasajero);
        $cantPasajeros=$this->getPasajeros($this->cantPasajeros)+1;
        $this->setPasajeros($cantPasajeros);
    }

    //metodo que busca el indice del pasajero a modificar,cambia el nombre o apellido
    public function buscaPasajero ($datosPasajero, $dni,$nombre,$apellido){
        $indice=array_search($dni,array_column($this->getDatPasajeros(),"dni"));
        $this->datosPasajero[$indice]=[
            "nombre"=>$nombre,
            "apellido"=>$apellido,
            "dni"=>$dni,
        ];
    }

    // metodo que dado el arreglo de los datos de los pasajeros crea una cadena para orgnizar los datos del arreglo y asi poder mostrarlo
    public function cadenaArregloPasajeros($datosPasajero){
        $cadena="";
        $j=1;
        for($i=0;$i<count($this->getDatPasajeros());$i++){
            $cadena=$cadena."\n"."Pasajero n°:".$j."\t"."nombre:".$this->getDatPasajeros()[$i]["nombre"]."\t apellido:".$this->getDatPasajeros()[$i]["apellido"]."\t D.N.I:".$this->getDatPasajeros()[$i]["dni"]."\t";
            $j=$j+1;
        }
        $this->setCadena($cadena);
    }
    

    public function __toString()
    {
        return "Codigo del viaje:".$this->getCodigoViaje()."\n Destino:".$this->getDestino()."\n Cantidad maxima de pasajeros:".$this->getMaxPasajeros()."\n Cantidad de pasajeros:".$this->getPasajeros()."\n Datos de los pasajeros que viajan:".$this->getCadena();
    }
}