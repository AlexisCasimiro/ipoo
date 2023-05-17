<<<<<<< HEAD
<?php

class Pasajero{
    //atributos
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;

    //metodo constructor
    public function __construct($nombre, $apellido, $dni, $telefono){
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->dni=$dni;
        $this->telefono=$telefono;
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

    public function __toString(){
        return "Nombre:".$this->getNombre()."\n"."Apellido:".$this->getApellido().
        "\n"."Numero de documento:".$this->getDocumento()."\n"."Telefono:".$this->getTelefono();
    }

=======
<?php

class Pasajero{
    //atributos
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;

    //metodo constructor
    public function __construct($nombre, $apellido, $dni, $telefono){
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->dni=$dni;
        $this->telefono=$telefono;
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

    public function __toString(){
        return "Nombre:".$this->getNombre()."\n"."Apellido:".$this->getApellido().
        "\n"."Numero de documento:".$this->getDocumento()."\n"."Telefono:".$this->getTelefono();
    }

>>>>>>> 84b40ad2ae8041a4a52e9c337a25bd6cc2a24df3
}