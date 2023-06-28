<?php

class ResponsableV{
    //atributos
    private $nroEmpleado;
    private $nroLicencia;
    private $nombre;
    private $apellido;
    private $mensajeoperacion;

    //metodo constructor
    public function __construct(){
        $this->nroEmpleado="";
        $this->nroLicencia="";
        $this->nombre="";
        $this->apellido="";
    }

    //cargar un responsable
    public function cargarResponsable($nroEmpleado,$nroLicencia,$Nom,$Ape){
		$this->setNroEmpleado($nroEmpleado);
		$this->setNroLicencia($nroLicencia);
        $this->setNombre($Nom);
		$this->setApellido($Ape);
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

    //error
    public function getmensajeoperacion(){
		return $this->mensajeoperacion;
	}

    public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

    public function listarResponsable($condicion=""){
	    $arreglo = null;
		$base=new BaseDatos();
		$consulta="Select * from responsable ";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
		$consulta.=" order by rnumeroempleado ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();	
				while($row2=$base->Registro()){
					$objResponsable=new ResponsableV;
					$objResponsable->cargarResponsable($row2['rnumeroempleado'],$row2['rnumerolicencia'],$row2['rnombre'],$row2['rapellido']);
					array_push($arreglo,$objResponsable);
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
	 * Recupera los datos del pasajero
	 * @param int $rnumeroEmpleado
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function BuscarResponsable($rnumeroEmpleado){
		$base=new BaseDatos();
		$consultaResponsable="Select * from responsable where rnumeroempleado=".$rnumeroEmpleado;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaResponsable)){
				if($row2=$base->Registro()){	
				    $this->setNroEmpleado($rnumeroEmpleado);					
				    $this->setNroLicencia($row2['rnumerolicencia']);
					$this->setNombre($row2['rnombre']);
					$this->setApellido($row2['rapellido']);
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

    public function insertarResponsable(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO responsable(rnumerolicencia, rnombre, rapellido) 
				VALUES (".$this->getNroLicencia().",'".$this->getNombre()."',
                '".$this->getApellido()."')";
		
		if($base->Iniciar()){

			if($id=$base->devuelveIDInsercion($consultaInsertar)){
				$this->setNroEmpleado($id);
			    $resp=  true;

			}	else {
					$this->setmensajeoperacion($base->getError());
					
			}

		} else {
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}

    public function modificarResponsable(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consultaModifica="UPDATE responsable SET rnumerolicencia='".$this->getNroLicencia()."'
                           ,rnombre='".$this->getNombre()."',rapellido='".$this->getApellido().
                           "' WHERE rnumeroempleado=". $this->getNroEmpleado();
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

    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM responsable WHERE rnumeroempleado=".$this->getNroEmpleado();
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
        return "Numero de Empleado:".$this->getNroEmpleado()."\n"."Numero de licencia:".$this->getNroLicencia().
        "\n"."Nombre:".$this->getNombre()."\n"."Apellido:".$this->getApellido();
    }

}