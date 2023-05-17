<?php


class PasajeroNecesidadesEspeciales extends Pasajero{
    //atributos
    private $arregloServiciosEspeciales;

    public function __construct($nombre, $apellido, $dni, $telefono,$nroAsiento,$nroTicketPasaje,$arregloServiciosEspeciales){
        parent::__construct($nombre, $apellido, $dni, $telefono,$nroAsiento,$nroTicketPasaje);
        $this->arregloServiciosEspeciales=$arregloServiciosEspeciales;
    }

    public function getArregloServiciosEspeciales(){
        return $this->arregloServiciosEspeciales;
    }

    public function setArregloServiciosEspeciales($arregloServiciosEspeciales){
        $this->arregloServiciosEspeciales=$arregloServiciosEspeciales;
    }
    //LEEEEEEEEEEEEEEERRRRRRR    hacer una funcion para mostrar el arreglo donde estann los servicios especiales
    public function darPorcentajeIncremento(){
        $porcentaje=0;
        $cantServicios=count($this->getArregloServiciosEspeciales());
        if($cantServicios==1){
            $porcentaje=15;
        }elseif($cantServicios==3){
            $porcentaje=30;
        }
        return $porcentaje;
    }

    //funcion que retorna una cadena con los servicios especiales que n_ecesita el pasajero
    public function mostrarServicios(){
        $colServicios=$this->getArregloServiciosEspeciales();
        $texto="";
        $cantidadServicios=count($colServicios);
        for($i=0;$i<$cantidadServicios;$i++){
            $texto=$texto."\n".$colServicios[$i];
        }
        return $texto;
    }

    public function __toString(){
        $cadena=parent::__toString();
        $cadena.="\nServicios que necesita:".$this->mostrarServicios();//funcion para mostar el arreglo de las necesidades ;
        return $cadena;
    }
}