<?php

class Viaje{
    //atributos
    private $codigoViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $colPasajeros;
    private $cadena;
    private $responsable;
    private $costo;
    private $costosAbonados;

    //metodo constructor
    public function __construct($codigoViaje,$destino,$cantMaxPasajeros,$responsable,$costo,$costosAbonados){
        $this->codigoViaje=$codigoViaje;
        $this->destino=$destino;
        $this->cantMaxPasajeros=$cantMaxPasajeros;
        $this->colPasajeros=[];
        $this->cadena="";
        $this->responsable=$responsable;
        $this->costo=$costo;
        $this->costosAbonados=$costosAbonados;
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

    //retorna datos de pasajeros
    public function getColPasajeros(){
        return $this->colPasajeros;
    }
    //setea el array
    public function setColPasajeros($colPasajeros){
        $this->colPasajeros=$colPasajeros;
    }

    //retorna la cadena con datos de los pasajeros
    public function getCadena(){
        return $this->cadena;
    }
    //setea el array
    public function setCadena($cadena){
        $this->cadena=$cadena;
    }

    //retorna los datos del responsable del viaje
    public function getResponsable(){
        return $this->responsable;
    }
    //setea el array
    public function setResponsable($responsable){
        $this->responsable=$responsable;
    }

    //retorna el costo
    public function getCosto(){
        return $this->costo;
    }

    //setea el costo
    public function setCosto($costo){
        $this->costo=$costo;
    }

    //retora el costo total recaudado del viaje
    public function getCostosAbonado(){
        return $this->costosAbonados;
    }

    //setea el costo total recaudado del viaje
    public function setCostosAbonados($costosAbonados){
        $this->costosAbonados=$costosAbonados;
    }
    
    //metodo que permite agregar datos de un pasajero
    public function agregarPasajero($nombre,$apellido,$dni,$telefono){
        $arregloPasajeros=$this->getColPasajeros();
        $i=0;
        $igual=false;
        while($i<count($arregloPasajeros)&&!$igual){
            $unPasajero=$arregloPasajeros[$i];
            if($unPasajero->getDocumento()==$dni){
                $igual=true;
            }
            $i++;
        }
        if(count($arregloPasajeros)<$this->getMaxPasajeros()&&!$igual){
            $pasajeroNuevo=new Pasajero($nombre,$apellido,$dni,$telefono);
            $arregloPasajeros[]=$pasajeroNuevo;
            $this->setColPasajeros($arregloPasajeros);
        }
    }

    //metodo que busca el indice del pasajero a modificar,cambia el nombre o apellido o telefono
    public function buscaPasajero ($dni,$nombre,$apellido,$telefono){
        $datosPasajero=$this->getColPasajeros();
        $i=0;
        $encontro=false;
        while($datosPasajero[$i]->getDocumento()!=$dni && !$encontro){
            $i++;
        }
        $indice=$i; //no es necesario
        $datosPasajero[$i]->setNombre($nombre);
        $datosPasajero[$i]->setApellido($apellido);
        $datosPasajero[$i]->setTelefono($telefono);
        $this->setColPasajeros($datosPasajero);
    }

    //metodo que crea una cadena con los datos de los pasajeros
    public function cadenaArregloPasajeros(){
        $cadena="";
        $arregloPasajeros=$this->getColPasajeros();
        $j=1;
        for($i=0;$i<count($arregloPasajeros);$i++){
            $cadena=$cadena."Pasajero N°:".$j."\n".$arregloPasajeros[$i]."\n";
            $j++;
        }
        $this->setCadena($cadena);

    }


    //la suma de los costos abonados por los pasajeros podria ser la recaudacion total?
    /**
     * Modificar la clase viaje para almacenar el costo del viaje, la suma de los costos abonados por los pasajeros
     * e implementar el método venderPasaje($objPasajero) que debe incorporar el pasajero a la colección de pasajeros
     *  ( solo si hay espacio disponible), actualizar los costos abonados y 
     * retornar el costo final que deberá ser abonado por el pasajero
     * @param object $objPasajero
     * @return int
     */
    public function venderPasaje($objPasajero){
        $colPasajeros=$this->getColPasajeros();
        $importe=$this->getCosto();
        $disponible=$this->hayPasajesDisponible();
        $incremento=$objPasajero->darPorcentajeIncremento();
        if($disponible){
            $importe=($importe)+($importe*($incremento/100));
            $costosAbonados=$this->getCostosAbonado()+$importe;
            $colPasajeros[]=$objPasajero;
            $this->setColPasajeros($colPasajeros);
            $this->setCostosAbonados($costosAbonados);
        }
        return $importe;
    }
    

    /**
     * Implemente la función hayPasajesDisponible() 
     * que retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad máxima de pasajeros y
     *  falso caso contrario
     * @return boolean
     */
    public function hayPasajesDisponible(){
        $disponible=false;
        if(count($this->getColPasajeros())<$this->getMaxPasajeros()){
            $disponible=true;
        }
        return $disponible;
    }


    public function __toString(){
        return "Codigo del viaje:".$this->getCodigoViaje()."\n Destino:".$this->getDestino().
        "\n Cantidad maxima de pasajeros:".$this->getMaxPasajeros()."\n ******Datos del responsable del viaje******"."\n"
        .$this->getResponsable().
        "\n ******Datos de los pasajeros******"."\n".$this->getCadena();
    }


}