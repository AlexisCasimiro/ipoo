<?php

class Pasajero{
    //atributos
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;
    private $nroAsiento;
    private $nroTicketPasaje;

    //metodo constructor
    public function __construct($nombre, $apellido, $dni, $telefono,$nroAsiento,$nroTicketPasaje){
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->dni=$dni;
        $this->telefono=$telefono;
        $this->nroAsiento=$nroAsiento;
        $this->nroTicketPasaje=$nroTicketPasaje;
    }
    
    //retorna el nombre del pasajero
    public function getNombre(){
        return $this->nombre;
    }
    //setea el nombre del pasajero
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    //retorna el apellido del pasajero
    public function getApellido(){
        return $this->apellido;
    }
    //setea el apellido del pasajero
    public function setApellido($apellido){
        $this->apellido=$apellido;
    }

    //retorna el dni del pasajero
    public function getDocumento(){
        return $this->dni;
    }
    //setea el dni del pasajero
    public function setDocumento($dni){
        $this->dni=$dni;
    }

    //retorna el telefono del pasajero
    public function getTelefono(){
        return $this->telefono;
    }
    //setea el telefono del pasajero
    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }

    //retorna el numero del asiento
    public function getNroAsiento(){
        return $this->nroAsiento;
    }

    //setea el numero del asiento
    public function setNroAsiento($nroAsiento){
        $this->nroAsiento=$nroAsiento;
    }

    //retorna el numero del ticket del pasaje del viaje
    public function getNroTicket(){
        return $this->nroTicketPasaje;
    }

    //setea el numero del ticket del pasaje del viaje
    public function setNroTicket($nroTicketPasaje){
        $this->nroTicketPasaje=$nroTicketPasaje;
    }

    public function darPorcentajeIncremento(){
        $porcentaje=10;
        return $porcentaje;
    }

    public function __toString(){
        return "Nombre:".$this->getNombre()."\n"."Apellido:".$this->getApellido().
        "\n"."Numero de documento:".$this->getDocumento()."\n"."Telefono:".$this->getTelefono();
    }

}