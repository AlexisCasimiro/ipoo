<?php

class ResponsableV{
    //atributos
    private $nroEmpleado;
    private $nroLicencia;
    private $nombre;
    private $apellido;

    //metodo constructor
    public function __construct($nroEmpleado,$nroLicencia,$nombre,$apellido){
        $this->nroEmpleado=$nroEmpleado;
        $this->nroLicencia=$nroLicencia;
        $this->nombre=$nombre;
        $this->apellido=$apellido;
    }

    //retorna el numero de empleado
    public function getNroEmpleado(){
        return $this->nroEmpleado;
    }
    //setea el numero de empleado
    public function setNroEmpleado($nroEmpleado){
        $this->nroEmpleado=$nroEmpleado;
    }

    //retorna el numero de licencia
    public function getNroLicencia(){
        return $this->nroLicencia;
    }
    //setea el numero de licencia
    public function setNroLicencia($nroLicencia){
        $this->nroLicencia=$nroLicencia;
    }

    //retorna el nombre del empleado
    public function getNombre(){
        return $this->nombre;
    }
    //setea el nombre del empleado
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    //retorna el apellido del empleado
    public function getApellido(){
        return $this->apellido;
    }
    //setea el apellido del empleado
    public function setApellido($apellido){
        $this->apellido=$apellido;
    }

    public function __toString(){
        return "Numero de Empleado:".$this->getNroEmpleado()."\n"."Numero de licencia:".$this->getNroLicencia().
        "\n"."Nombre:".$this->getNombre()."\n"."Apellido:".$this->getApellido();
    }

}