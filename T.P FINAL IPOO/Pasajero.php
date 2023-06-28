<?php

class Pasajero{
    //atributos
    private $dni;
    private $nombre;
    private $apellido;
    
    private $telefono;
    private $objViaje;
    private $mensajeoperacion;

    //metodo constructor
    public function __construct(){
        $this->dni="";
        $this->nombre="";
        $this->apellido="";
        $this->telefono="";
        $this->objViaje=new Viaje;
    }

    //cargar un pasajero
    public function cargarPasajero($NroD,$Nom,$Ape,$telefono,$objViaje){		
		$this->setDocumento($NroD);
		$this->setNombre($Nom);
		$this->setApellido($Ape);
		$this->setTelefono($telefono);
        $this->setObjViaje($objViaje);
    }

    //retorna el dni del pasajero
    public function getDocumento(){
        return $this->dni;
    }
    //setea el dni del pasajero
    public function setDocumento($dni){
        $this->dni=$dni;
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

    //retorna el telefono del pasajero
    public function getTelefono(){
        return $this->telefono;
    }
    //setea el telefono del pasajero
    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }

    //retorna el numero del asiento
    public function getObjViaje(){
        return $this->objViaje;
    }

    //setea el numero del asiento
    public function setObjViaje($objViaje){
        $this->objViaje=$objViaje;
    }

    //error
    public function getmensajeoperacion(){
		return $this->mensajeoperacion;
	}

    public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

    public function listarPasajeros($condicion=""){
	    $arregloPasajeros = null;
		$base=new BaseDatos();
		$consulta="Select * from pasajero ";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
		$consulta.=" order by papellido ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arregloPasajeros= array();
				while($row2=$base->Registro()){
					$objViaje=new Viaje;
					$objViaje->BuscarViaje($row2['idviaje']);
					$objPasajero=new Pasajero;
					$objPasajero->cargarPasajero($row2['pdocumento'],$row2['pnombre'],$row2['papellido'],$row2['ptelefono'],$objViaje);
					array_push($arregloPasajeros,$objPasajero);
				}
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 }	
		 return $arregloPasajeros;
	}

    /**
	 * Recupera los datos del pasajero
	 * @param int $dniPasajero
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function BuscarPasajero($dniPasajero){
		$base=new BaseDatos();
		$consultaPasajero="Select * from pasajero where pdocumento=".$dniPasajero;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPasajero)){
				if($row2=$base->Registro()){					
				    $this->setDocumento($dniPasajero);
					$this->setNombre($row2['pnombre']);
					$this->setApellido($row2['papellido']);
                    $this->setTelefono($row2['ptelefono']);
					//$this->setObjViaje($row2['idviaje']);
					$objViaje=new Viaje;
					$objViaje->BuscarViaje($row2['idviaje']);
					$this->setObjViaje($objViaje);
                    
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

    public function insertarPasajero(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO pasajero(pdocumento, pnombre, papellido, ptelefono, idviaje) 
				VALUES ('".$this->getDocumento()."','".$this->getNombre()."','".$this->getApellido()."',
                '".$this->getTelefono()."','".$this->getObjViaje()->getIdViaje()."')";
		
		if($base->Iniciar()){

			if($base->Ejecutar($consultaInsertar)){

			    $resp=  true;

			}	else {
					$this->setmensajeoperacion($base->getError());
					
			}

		} else {
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}

    public function modificarPasajero(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consultaModifica="UPDATE pasajero SET pdocumento='".$this->getDocumento()."',pnombre='".$this->getNombre()."'
                           ,papellido='".$this->getApellido()."',ptelefono='".$this->getTelefono()."',idviaje='"
                           .$this->getObjViaje()->getIdViaje()."' WHERE pdocumento=". $this->getDocumento();
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

    public function eliminarPasajero(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM pasajero WHERE pdocumento=".$this->getDocumento();
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
        return "Nombre:".$this->getNombre()."\n"."Apellido:".$this->getApellido().
        "\n"."Numero de documento:".$this->getDocumento()."\n"."Telefono:".$this->getTelefono()
		."\nID del Viaje al que pertene:".$this->getObjViaje()->getIdViaje();
    }

}