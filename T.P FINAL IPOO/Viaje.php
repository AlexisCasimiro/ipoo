<?php

class Viaje{
    //atributos
    private $idViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $objEmpresa;
    private $objResponsable;
    private $costo;
    private $colObjPasajeros;
    private $mensajeoperacion;

    //metodo constructor
    public function __construct(){
        $this->idViaje=1;
        $this->destino="";
        $this->cantMaxPasajeros="";
        $this->objEmpresa=new Empresa;
        $this->objResponsable=new ResponsableV;
        $this->costo="";
        $this->colObjPasajeros=[];
    }
    //cargar un viaje
    public function cargarViaje($destino,$cantMaxPasajeros,$objEmpresa,$objResponsable,$costo){		
		$this->setDestino($destino);
		$this->setMaxPasajeros($cantMaxPasajeros);
		$this->setObjEmpresa($objEmpresa);
		$this->setObjResponsable($objResponsable);
        $this->setCosto($costo);
    }

    //retorna el codigo del viaje
    public function getIdViaje(){
        return $this->idViaje;
    }

    //setea el valor del codigo del viaje
    public function setIdViaje($idViaje){
        $this->idViaje=$idViaje;
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

    //retorna los datos del responsable del viaje
    public function getObjEmpresa(){
        return $this->objEmpresa;
    }
    //setea el array
    public function setObjEmpresa($objEmpresa){
        $this->objEmpresa=$objEmpresa;
    }

    //retorna los datos del responsable del viaje
    public function getObjResponsable(){
        return $this->objResponsable;
    }
    //setea el array
    public function setObjResponsable($objResponsable){
        $this->objResponsable=$objResponsable;
    }

    //retorna el costo
    public function getCosto(){
        return $this->costo;
    }

    //setea el costo
    public function setCosto($costo){
        $this->costo=$costo;
    }

    //retorna la coleccion de los pasajeros
    public function getColPasajeros(){
        return $this->colObjPasajeros;
    }
    //setea la coleccion de los pasajeros del viaje 
    public function setColPasajeros($colObjPasajeros){
        $this->colObjPasajeros=$colObjPasajeros;
    }
    //error
    public function getmensajeoperacion(){
		return $this->mensajeoperacion;
	}

    public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
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

    //FALTAN AGREGAR FUNCIONES PARA AGREGAR Y MODIFICAR LOS DATOS DE A CLASE
    //
    //
    public function insertarViaje(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO viaje(vdestino,vcantmaxpasajeros,idempresa,rnumeroempleado,vimporte) 
				VALUES ('".$this->getDestino()."','".$this->getMaxPasajeros()."',".$this->getObjEmpresa()->getIdEmpresa().",
                '".$this->getObjResponsable()->getNroEmpleado()."','".$this->getCosto()."')";
		
		if($base->Iniciar()){

			if($id=$base->devuelveIDInsercion($consultaInsertar)){
                $this->setIdViaje($id);
			    $resp=  true;

			}	else {
					$this->setmensajeoperacion($base->getError());
					
			}

		} else {
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}

    public function listarViajes($condicion=""){
	    $arregloViajes = null;
		$base=new BaseDatos();
		$consulta="Select * from viaje ";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
		$consulta.=" order by idviaje ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arregloViajes= array();
				while($row2=$base->Registro()){
                    $objResponsable=new ResponsableV;
                    $objResponsable->BuscarResponsable($row2['rnumeroempleado']);
                    $objEmpresa=new Empresa;
                    $objEmpresa->BuscarEmpresa($row2['idempresa']);
                    $objPasajero=new Pasajero;
                    $objViaje=new Viaje();
                    $objViaje->setIdViaje($row2['idviaje']);
                    $objViaje->cargarViaje($row2['vdestino'],$row2['vcantmaxpasajeros'],$objEmpresa,$objResponsable,$row2['vimporte']);
                    $coleccionPasajeros=$objPasajero->listarPasajeros("idviaje=".$row2['idviaje']);
                    $this->setColPasajeros($coleccionPasajeros);
					array_push($arregloViajes,$objViaje);
				}
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 }	
		 return $arregloViajes;
	}

    /**
	 * Recupera los datos del pasajero
	 * @param int $idViaje
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function BuscarViaje($idViaje){
		$base=new BaseDatos();
		$consultaViaje="Select * from viaje where idviaje=".$idViaje;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaViaje)){
				if($row2=$base->Registro()){
                    $objViaje=new Viaje;
                    $this->setIdViaje($idViaje);
                    $objResponsable=new ResponsableV;
                    $objResponsable->BuscarResponsable($row2['rnumeroempleado']);
                    $objEmpresa=new Empresa;
                    $objEmpresa->BuscarEmpresa($row2['idempresa']);
                    
                    $objViaje->cargarViaje($row2['vdestino'],$row2['vcantmaxpasajeros'],$objEmpresa,$objResponsable,$row2['vimporte']);
                    //
                    
					$resp= true;
				}				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }		
		 return $resp;
	}

    public function modificarViaje(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consultaModifica="UPDATE viaje SET vdestino='".$this->getDestino()."',vcantmaxpasajeros='".$this->getMaxPasajeros()."'
                           ,rnumeroempleado='".$this->getObjResponsable()->getNroEmpleado()."',vimporte='".$this->getCosto()."' 
                           WHERE idviaje=". $this->getIdViaje();
		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $resp=  true;
			}else{
				$this->setmensajeoperacion($base->getError());
				
			}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}

    public function eliminarViaje(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM viaje WHERE idviaje=".$this->getIdViaje();
				if($base->Ejecutar($consultaBorra)){
				    $resp=  true;
				}else{
						$this->setmensajeoperacion($base->getError());
					
				}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp; 
	}

    

    public function __toString(){
        $cadena="";
        $pasajero=new Pasajero;
        $coleccionPasajeros=$pasajero->listarPasajeros("idviaje=".$this->getIdViaje());
        /*$coleccionPasajeros=$this->getColPasajeros();*/
        for($i=0;$i<count($coleccionPasajeros);$i++){
            $unpasajero=$coleccionPasajeros[$i];
            $cadena=$cadena.$unpasajero;
        }
        return "\nCodigo del viaje:".$this->getIdViaje()."\nDestino:".$this->getDestino()."\nCosto:".$this->getCosto().
        "\nCantidad maxima de pasajeros:".$this->getMaxPasajeros()."\n ******Datos del responsable del viaje******"."\n"
        .$this->getObjResponsable().
        "\n******Datos de los pasajeros******"."\n".$cadena."\nPertenece a la Empresa con el ID:".$this->getObjEmpresa()->getIdEmpresa()."\n";
    }


}