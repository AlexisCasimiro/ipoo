<?php
include_once "BaseDatos.php";
class Empresa{
    //atributos
    private $idEmpresa;
    private $nombreEmpresa;
    private $direccionEmpresa;
	private $colViajes;
    private $mensajeoperacion;

    public function __construct(){
        $this->idEmpresa="";
        $this->nombreEmpresa="";
        $this->direccionEmpresa="";
		$this->colViajes=[];
    }
	//cargar una empresa
	public function cargarEmpresa($nombreEmpresa,$direccionEmpresa){
		$this->setNombreEmpresa($nombreEmpresa);
		$this->setDireccionEmpresa($direccionEmpresa);
    }

    //retorna el idEmpresa
    public function getIdEmpresa(){
        return $this->idEmpresa;
    }
    //setea el idEmpresa
    public function setIdEmpresa($idEmpresa){
        $this->idEmpresa=$idEmpresa;
    }

    //retorna el nombreEmpresa
    public function getNombreEmpresa(){
        return $this->nombreEmpresa;
    }
    //setea el nombreEmpresa
    public function setNombreEmpresa($nombreEmpresa){
        $this->nombreEmpresa=$nombreEmpresa;
    }

    //retorna el año de fabricacion
    public function getDireccionEmpresa(){
        return $this->direccionEmpresa;
    }
    //setea el idEmpresa
    public function setDireccionEmpresa($direccionEmpresa){
        $this->direccionEmpresa=$direccionEmpresa;
    }

	//retorna la coleccion de viajes
    public function getColViajes(){
        return $this->colViajes;
    }
    //setea el idEmpresa
    public function setColViajes($colViajes){
        $this->colViajes=$colViajes;
    }

    //error
    public function getmensajeoperacion(){
		return $this->mensajeoperacion;
	}

    public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

    public function listarEmpresa($condicion=""){
	    $arreglo = null;
		$base=new BaseDatos();
		$consulta="Select * from empresa ";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
		$consulta.=" order by idempresa ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
					$objViaje=new Viaje;
					$objEmpresa=new Empresa;
					$objEmpresa->setIdEmpresa($row2['idempresa']);
					$objEmpresa->cargarEmpresa($row2['enombre'],$row2['edireccion']);
					$coleccionViajes=$objViaje->listarViajes("idempresa=".$row2['idempresa']);
					$this->setColViajes($coleccionViajes);
					array_push($arreglo,$objEmpresa);
				}
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 }	
		 return $arreglo;
	}

    /**
	 * Recupera los datos de la empresa por id
	 * @param int $id
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function BuscarEmpresa($id){
		$base=new BaseDatos();
		$consultaEmpresa="Select * from empresa where idempresa=".$id;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaEmpresa)){
				if($row2=$base->Registro()){					
				    $this->setIdEmpresa($id);
					$this->setNombreEmpresa($row2['enombre']);
					$this->setDireccionEmpresa($row2['edireccion']);
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

    public function insertarEmpresa(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO empresa(enombre, edireccion) 
				VALUES ('".$this->getNombreEmpresa()."','".$this->getDireccionEmpresa()."')";
		
		if($base->Iniciar()){

			if($id=$base->devuelveIDInsercion($consultaInsertar)){
				$this->setIdEmpresa($id);
			    $resp=  true;

			}	else {
					$this->setmensajeoperacion($base->getError());
					
			}

		} else {
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}

    public function modificarEmpresa(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consultaModifica="UPDATE empresa SET idempresa='".$this->getIdEmpresa()."',enombre='".$this->getNombreEmpresa()."'
                           ,edireccion='".$this->getDireccionEmpresa()."' WHERE idempresa=". $this->getIdEmpresa();
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

    public function eliminarEmpresa(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM empresa WHERE idempresa=".$this->getIdEmpresa();
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

	public function mostrarViajes(){
		$cadena="";
		$obj=new Viaje;
		$colViajes=$obj->listarViajes();
		foreach($colViajes as $unViaje){
			$cadena=$cadena . $unViaje;
		}
		return $cadena;
	}

    public function __toString(){
		$cadena="";
		$objViaje=new Viaje;
		$coleccionViajes=$objViaje->listarViajes("idempresa=".$this->getIdEmpresa());
		for($i=0;$i<count($coleccionViajes);$i++){
            $unViaje=$coleccionViajes[$i];
            $cadena=$cadena.$unViaje;
        }
        return "\nID de la empresa:".$this->getIdEmpresa()."\nNombre de la empresa:".$this->getNombreEmpresa().
        "\nDireccion de la empresa:".$this->getDireccionEmpresa()."\nViajes:".$cadena;
    }
}