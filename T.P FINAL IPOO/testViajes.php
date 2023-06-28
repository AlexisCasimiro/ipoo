<?php
include_once "BaseDatos.php";
include_once "Empresa.php";
include_once "Pasajero.php";
include_once "ResponsableV.php";
include_once "Viaje.php";


do{
echo "\n******Elija una opcion******\n
	0)Agregar una empresa\n
	1)Agregar un viaje\n
	2)Agregar un responsable\n
	3)Agregar Pasajeros a un Viaje\n
	4)Modificar un Viaje\n
	5)Modificar un Responsable\n
	6)Modificar un Pasajero\n
	7)Modificar una Empresa\n
	8)Mostrar viajes\n
	9)Mostrar Pasajeros\n
	10)Mostrar Responsables\n
	11)Mostrar datos las Empresas\n
	12)Eliminar Empresa\n
	13)Eliminar Viaje\n
	14)Eliminar Responsable\n
	15)Eliminar Pasajero\n
	-----------------------------------------\n
	16)Salir del menú\n
	-----------------------------------------\n";
$opcion=trim(fgets(STDIN));

switch($opcion){
	case 0:
		//agregar una empresa
		echo "Ingrese nombre de la empresa:";
		$nombreEmpresa=trim(fgets(STDIN));
		echo "Ingrese la direccion de la empresa:";
		$direccionEmpresa=trim(fgets(STDIN));
		$obj_Empresa=new Empresa();
		$obj_Empresa->cargarEmpresa($nombreEmpresa,$direccionEmpresa);
		$respuesta=$obj_Empresa->insertarEmpresa();
		$idDeUnicaEmpresa=$obj_Empresa->getIdEmpresa();
		if ($respuesta==true) {
			echo "\nLA EMPRESA FUE INGRESADA A LA BASE DE DATOS\n";
		}else {
			echo "NO se pudo ingresar la empresa a la base de datos";
    	}
		break;
	case 1:	
		$objViaje=new Viaje;
		$obj_Empresa=new Empresa;
		$arregloEmpresas=$obj_Empresa->listarEmpresa();
		for($i=0;$i<count($arregloEmpresas);$i++){
			$unaEmpresa=$arregloEmpresas[$i];
			echo $unaEmpresa;
			echo "\n*************************************\n";
		}
		echo"Ingrese el ID de la Empresa a la cual agregar el viaje\n";
		$idEmpresa=trim(fgets(STDIN));
		$obj_Empresa->BuscarEmpresa($idEmpresa);
		echo "Ingrese el destino del Viaje:";
		$destino=trim(fgets(STDIN));
		echo "Ingrese la cantidad maxima de pasajeros:";
		$cantMax=trim(fgets(STDIN));
		$objResponsable=new ResponsableV;
		$colResponsables=$objResponsable->listarResponsable();
		echo "Ingrese '1' si desea elegir un responsable que ya esta en la base de datos, ingrese '2' si desea ingresar un nuevo responsable";
		$responsable=trim(fgets(STDIN));
		$respuesta=false;
		if($responsable=="1"){
			if($colResponsables==null){
				echo"No tiene ningun Responsable en la base de datos,¿
				desea ingresar un Responsable? (S/N)";
				$respuestaSN=trim(fgets(STDIN));
				if($respuestaSN=="S"){
					echo "Ingrese numero de licencia:";
					$nroLic=trim(fgets(STDIN));
					echo "Ingrese nombre del Responsable:";
					$nomRes=trim(fgets(STDIN));
					echo "Ingrese apellido del Responsable:";
					$apeRes=trim(fgets(STDIN));
					$objResponsable->cargarResponsable(null,$nroLic,$nomRes,$apeRes);
					$objResponsable->insertarResponsable();
					$respuesta=true;
				}elseif($respuestaSN=="N"){
					echo "No se podra ingresar un Viaje a la base de datos\n";
				}
			}else{
				for($i=0;$i<count($colResponsables);$i++){
					$unResponsable=$colResponsables[$i];
					echo $unResponsable;
					echo "\n*************************************\n";
				}
				echo "Elija un numero del empleado Responsable para su viaje:";
				$nroEmp=trim(fgets(STDIN));
				$respuesta=$objResponsable->BuscarResponsable($nroEmp);
			}
		}elseif($responsable=="2"){
			echo "Ingrese numero de licencia:";
			$nroLic=trim(fgets(STDIN));
			echo "Ingrese nombre del Responsable:";
			$nomRes=trim(fgets(STDIN));
			echo "Ingrese apellido del Responsable:";
			$apeRes=trim(fgets(STDIN));
			$objResponsable->cargarResponsable(null,$nroLic,$nomRes,$apeRes);
			$respuesta=$objResponsable->insertarResponsable();
		}
		
		if($respuesta){
		echo "Ingrese el importe del viaje:";
		$importeViaje=trim(fgets(STDIN));
		$obj_Empresa=new Empresa;
		$obj_Empresa->BuscarEmpresa($idEmpresa);
		$objViaje->cargarViaje($destino,$cantMax,$obj_Empresa,$objResponsable,$importeViaje);
		$respuesta=$objViaje->insertarViaje();
		if($respuesta){
			echo "El viaje se ingreso a la base de datos correctamente";
		}
		else{
			echo "No se pudo ingresar el viaje a la base de datos";
		}
		}else{
			echo "No se puede cargar un Viaje a la base de datos";
		}
		break;
	case 2:
		//agregar un responsable
		$objResponsable=new ResponsableV;
		echo "Ingrese numero de licencia:";
		$nroLic=trim(fgets(STDIN));
		echo "Ingrese nombre del Responsable:";
		$nomRes=trim(fgets(STDIN));
		echo "Ingrese apellido del Responsable:";
		$apeRes=trim(fgets(STDIN));
		$objResponsable->cargarResponsable(null,$nroLic,$nomRes,$apeRes);
		$respuesta=$objResponsable->insertarResponsable();
		if($respuesta){
			echo "El Responsable fue ingresado a la base de datos";
		}else{
			echo $objResponsable->getmensajeoperacion();
		}
		break;
	case 3:
		$objPasajero=new Pasajero;
		echo "Ingrese numero de documento del Pasajero:";
		$nroDoc=trim(fgets(STDIN));
		echo "Ingrese nombre del Pasajero:";
		$nomPas=trim(fgets(STDIN));
		echo "Ingrese apellido del Pasajero:";
		$apePas=trim(fgets(STDIN));
		echo "Ingrese el telefono del Pasajero:";
		$telPas=trim(fgets(STDIN));
		$objViaje=new Viaje;
		$colViajes=$objViaje->listarViajes();
		for($i=0;$i<count($colViajes);$i++){
			$unViaje=$colViajes[$i];
			echo $unViaje;
			echo "\n************************************\n";
		}
		echo "Ingrese el ID del viaje al que va a pertenecer el Pasajero:";
		$idViaje=trim(fgets(STDIN));
		$objViaje->BuscarViaje($idViaje);
		$objPasajero->cargarPasajero($nroDoc,$nomPas,$apePas,$telPas,$objViaje);
		$respuesta=$objPasajero->insertarPasajero();
		if($respuesta){
			echo "El Pasajero fue ingresado a la base de datos correctamente\n";
		}else{
			echo $objPasajero->getmensajeoperacion();
		}
		break;
	case 4:
		//modificar un viaje
		$objViaje=new Viaje;
		$objResponsable=new ResponsableV;
		$colViajes=$objViaje->listarViajes();
		for($i=0;$i<count($colViajes);$i++){
			$unViaje=$colViajes[$i];
			echo $unViaje;
			echo "************************************\n";
		}
		echo "Ingrese el ID del viaje a modificar:";
		$idViajeModificar=trim(fgets(STDIN));
		$respuesta=$objViaje->BuscarViaje($idViajeModificar);
		if($respuesta){
		do{
			echo "\n1)Modificar Destino
			\n2)Modificar cantidad maxima de pasajeros
			\n3)Modificar el Responsable
			\n4)Modificar el Importe del Viaje\n";
			$opcionMod=trim(fgets(STDIN));
			switch($opcionMod){
				case 1:
					echo "Ingrese nuevo Destino:";
					$nuevoDes=trim(fgets(STDIN));
					$objViaje->setDestino($nuevoDes);
					$respuesta=$objViaje->modificarViaje();
					if($respuesta){
						echo "El Destino se modifico correctamente\n";
					}else{
						echo $objViaje->getmensajeoperacion();
					}
					break;
				case 2:
					echo "Ingrese nueva cantidad maxima de pasajeros\n";
					$nuevaCantMax=trim(fgets(STDIN));
					$objViaje->setMaxPasajeros($nuevaCantMax);
					$respuesta=$objViaje->modificarViaje();
					if($respuesta){
						echo "La cantidad maxima se modifico correctamente\n";
					}else{
						echo $objViaje->getmensajeoperacion();
					}
					break;
				case 3:
					$objResponsable=new ResponsableV;
					$colResponsables=$objResponsable->listarResponsable();
					for($i=0;$i<count($colResponsables);$i++){
						$unResponsable=$colResponsables[$i];
						echo $unResponsable;
					}
					echo "\nIngrese numero de empleado del nuevo Responsable del Viaje:\n";
					$nuevoIdRes=trim(fgets(STDIN));
					$encontro=$objResponsable->BuscarResponsable($nuevoIdRes);
					if($encontro){
						$objViaje->setObjResponsable($objResponsable);
						$respuesta=$objViaje->modificarViaje();
						if($respuesta){
						echo "El Responsable se modifico correctamente\n";
						}else{
							echo $objViaje->getmensajeoperacion();
						}
					}else{
						echo "NO SE ENCONTRO EL NUMERO DE EMPLEADO DEL RESPONSABLE\n";
					}
					break;
				case 4:
					echo "Ingrese nuevo Importe:";
					$nuevoImp=trim(fgets(STDIN));
					$objViaje->setCosto($nuevoImp);
					$respuesta=$objViaje->modificarViaje();
					if($respuesta){
						echo "El Importe se modifico correctamente\n";
					}else{
						echo $objViaje->getmensajeoperacion();
					}
					break;
			}
			echo "Desea modificar algo más del viaje?(S/N)\n";
			$respuestaSN=trim(fgets(STDIN));
		}while($respuestaSN=="S");
		break;
		}else{
			echo $objViaje->getmensajeoperacion();
		}
	case 5:
		//modificar un responsable
		$objResponsable=new ResponsableV;
		$colResponsables=$objResponsable->listarResponsable();
		for($i=0;$i<count($colResponsables);$i++){
			$unResponsable=$colResponsables[$i];
			echo $unResponsable;
			echo "\n*************************************\n";
		}
		echo "Elija un numero del empleado Responsable para realizarle modificaciones";
		$nroEmpModificar=trim(fgets(STDIN));
		$respuesta=$objResponsable->BuscarResponsable($nroEmpModificar);
		if($respuesta){
			do{
				echo "\n1)Modificar el numero de Licencia
				\n2)Modificar el nombre
				\n3)Modificar el apellido\n";
				$opcionMod=trim(fgets(STDIN));
				switch($opcionMod){
					case 1:
						echo "Ingrese nuevo numero de Licencia:";
						$nroLic=trim(fgets(STDIN));
						$objResponsable->setNroLicencia($nroLic);
						$respuesta=$objResponsable->modificarResponsable();
						if($respuesta){
							echo "El numero de Licencia se modifico correctamente";
						}else{
							echo $objResponsable->getmensajeoperacion();
						}
						break;
					case 2:
						echo "Ingrese nuevo nombre:";
						$nomRes=trim(fgets(STDIN));
						$objResponsable->setNombre($nomRes);
						$respuesta=$objResponsable->modificarResponsable();
						if($respuesta){
							echo "El nombre se modifico correctamente";
						}else{
							echo $objResponsable->getmensajeoperacion();
						}
						break;
					case 3:
						echo "Ingrese nuevo apellido:";
						$apeRes=trim(fgets(STDIN));
						$objResponsable->setApellido($apeRes);
						$respuesta=$objResponsable->modificarResponsable();
						if($respuesta){
							echo "El apellido se modifico correctamente";
						}else{
							echo $objResponsable->getmensajeoperacion();
						}
						break;
				}
				echo "Desea modificar algo más del viaje?(S/N)";
				$respuestaSN=trim(fgets(STDIN));
			}while($respuestaSN=="S");
		}else{
			echo "NO SE ENCONTRO EL NUMERO DE EMPLEADO DEL RESPONSABLE\N";
		}
		break;
	case 6:
		//modificar datos de un pasajero
		$objPasajero=new Pasajero;
		$objViaje=new Viaje;
		$colPasajeros=$objPasajero->listarPasajeros();
		for($i=0;$i<count($colPasajeros);$i++){
			$unPasasjero=$colPasajeros[$i];
			echo $unPasasjero;
			echo "\n*************************************\n";
		}
		echo "Ingrese numero de documento del Pasajero a modificar";
		$nroDocModificar=trim(fgets(STDIN));
		$respuesta=$objPasajero->BuscarPasajero($nroDocModificar);
		if($respuesta){
			do{
				echo "\n1)Modificar el Nombre
				\n2)Modificar el Apellido
				\n3)Modificar el Telefono
				\n4)Modificar el Viaje\n";
				$opcionMod=trim(fgets(STDIN));
				switch($opcionMod){
					case 1:
						echo "Ingrese nuevo Nombre:";
						$nuevoNom=trim(fgets(STDIN));
						$objPasajero->setNombre($nuevoNom);
						$respuesta=$objPasajero->modificarPasajero();
						if($respuesta){
							echo "El Nombre se modifico correctamente";
						}else{
							echo $objPasajero->getmensajeoperacion();
						}
						break;
					case 2:
						echo "Ingrese nuevo Apellido:";
						$nuevoApe=trim(fgets(STDIN));
						$objPasajero->setApellido($nuevoApe);
						$respuesta=$objPasajero->modificarPasajero();
						if($respuesta){
							echo "El Apellido se modifico correctamente";
						}else{
							echo $objPasajero->getmensajeoperacion();
						}
						break;
					case 3:
						echo "Ingrese nuevo Telefono:";
						$nuevoTel=trim(fgets(STDIN));
						$objPasajero->setTelefono($nuevoTel);
						$respuesta=$objPasajero->modificarPasajero();
						if($respuesta){
							echo "El Telefono se modifico correctamente";
						}else{
							echo $objPasajero->getmensajeoperacion();
						}
						break;
					case 4:
						//modificar el viaje
						echo "Ingrese el ID del nuevo Viaje:";
						$nuevoViaje=trim(fgets(STDIN));
						$objViaje->BuscarViaje($nuevoViaje);
						$objPasajero->setObjViaje($objViaje);
						$respuesta=$objPasajero->modificarPasajero();
						if($respuesta){
							echo "El Viaje se modifico correctamente";
						}else{
							echo $objViaje->getmensajeoperacion();
						}
						break;
				}
				echo "Desea modificar algo más del Pasajero?(S/N):";
				$respuestaSN=trim(fgets(STDIN));
			}while($respuestaSN=="S");
		}else{
			echo "No se encontro un pasajero con ese numero de documento";
		}
		break;
	case 7:
		//Modificar una empresa
		$obj_Empresa=new Empresa;
		$coleccionEmpresa=$obj_Empresa->listarEmpresa();
		for($i=0;$i<count($coleccionEmpresa);$i++){
			$unaEmpresa=$coleccionEmpresa[$i];
			echo $unaEmpresa;
			echo "\n*************************************\n";
		}
		echo "Elija un ID de la Empresa que desea realizar modificaciones:\n";
		$idEmModificar=trim(fgets(STDIN));
		$respuesta=$obj_Empresa->BuscarEmpresa($idEmModificar);
		if($respuesta){
			do{
				echo "\n1)Modificar el Nombre
				\n2)Modificar la Direccion";
				$opcionMod=trim(fgets(STDIN));
				switch($opcionMod){
					case 1:
						echo "Ingrese nuevo Nombre:";
						$nuevoNom=trim(fgets(STDIN));
						$obj_Empresa->setNombreEmpresa($nuevoNom);
						$respuesta=$obj_Empresa->modificarEmpresa();
						if($respuesta){
							echo "El Nombre se modifico correctamente";
						}else{
							echo "No es pudo modificar el nombre";
						}
						break;
					case 2:
						echo "Ingrese nueva Direccion de la Empresa:";
						$nuevaDire=trim(fgets(STDIN));
						$obj_Empresa->setDireccionEmpresa($nuevaDire);
						$respuesta=$obj_Empresa->modificarEmpresa();
						if($respuesta){
							echo "La direccion se modifico correctamente";
						}else{
							echo "No se pudo modificar la direccion de la Empresa";
						}
						break;
					
				}
				echo "Desea modificar algo más del Pasajero?(S/N):";
				$respuestaSN=trim(fgets(STDIN));
			}while($respuestaSN=="S");
		}else{
			echo "No se encontro una Empresa con ese ID";
		}
		break;
	case 8:
		//Mostrar Viajes
		$objViaje=new Viaje;
		$colViajes=$objViaje->listarViajes();
			foreach($colViajes as $unViaje){
				echo $unViaje;
				echo "***********************************";
			}
		break;
	case 9:
		//Mostrar pasajeros
		$objPasajero=new Pasajero;
		echo "\n1)Ver todos los pasajeros
		\n2)Ver todos los pasajeros de un viaje
		\n3)Ver un solo pasajero\n";
		$opcion=trim(fgets(STDIN));
		switch($opcion){
			case 1:
				$colPasajeros=$objPasajero->listarPasajeros();
				foreach($colPasajeros as $unPasasjero){
					echo $unPasasjero;
					echo "\n***************************************\n";
				}
				break;
			case 2:
				echo "Ingrese el ID del viaje que desea ver los Pasajeros:";
				$idViajeVer=trim(fgets(STDIN));
				$colPasajeros=$objPasajero->listarPasajeros($condicion="idviaje="."'$idViajeVer'");//"idviaje='$idViajeVer'"
				foreach($colPasajeros as $unPasasjero){
					echo $unPasasjero;
					echo "\n***************************************\n";
				}
				break;
			case 3:
				echo "Ingrese DNI del pasajero que desea ver:";
				$nroDocVer=trim(fgets(STDIN));
				$respuesta=$objPasajero->BuscarPasajero($nroDocVer);
				if($respuesta){
					echo $objPasajero;
				}else{
					echo $objPasajero->getmensajeoperacion();
				}
				break;
		}
		break;
	case 10:
		$objViaje=new Viaje;
		$objResponsable=new ResponsableV;
		echo "\n1)Ver todos los Responsable
		\n2)Ver el Responsable de un Viaje
		\n3)Ver un Responsable\n";
		$opcion=trim(fgets(STDIN));
		switch($opcion){
			case 1:
				$colResponsables=$objResponsable->listarResponsable();
				foreach($colResponsables as $unResponsable){
					echo $unResponsable;
					echo "\n***************************************\n";
				}
				break;
			case 2:
				echo "Ingrese el ID del viaje que desea ver el Responsable:";
				$idViajeVer=trim(fgets(STDIN));
				$respuesta=$objViaje->BuscarViaje($condicion="idviaje=".$idViajeVer);
				if($respuesta){
					$unResponsable=$objViaje->getObjResponsable();//"idviaje='$idViajeVer'"
					echo $unResponsable;
				}else{
					echo "No se encontro un viaje con ese ID\n";
				}
				
				break;
			case 3:
				echo "Ingrese numero de Empleado del Responsable que desea ver:";
				$nroResVer=trim(fgets(STDIN));
				$respuesta=$objResponsable->BuscarResponsable($nroResVer);
				if($respuesta){
					echo $objResponsable;
				}else{
					echo "No se encontro ningun responsable con ese numero de Empleado:";
				}
				break;
		}
		break;
	case 11:
		$obj_Empresa=new Empresa;
		$colEmpresas=$obj_Empresa->listarEmpresa();
		for($i=0;$i<count($colEmpresas);$i++){
			$unaEmpresa=$colEmpresas[$i];
			echo $unaEmpresa;
		}
		break;
	case 12:
		//eliminar empresa
		$obj_Empresa=new Empresa;
		$coleccionEmpresa=$obj_Empresa->listarEmpresa();
		for($i=0;$i<count($coleccionEmpresa);$i++){
			$unaEmpresa=$coleccionEmpresa[$i];
			echo $unaEmpresa;
			echo "\n*************************************\n";
		}
		echo "Elija un ID de la Empresa que desea ELIMINAR:\n";
		$idEmpEli=trim(fgets(STDIN));
		$respuesta=$obj_Empresa->BuscarEmpresa($idEmpEli);
		if($respuesta){
			$respuesta=$obj_Empresa->eliminarEmpresa();
			if($respuesta){
				echo "La Empresa se elimino correctamente";
			}else{
				echo "No se pudo eliminar la Empresa";
			}
		}else{
			echo "No se encontro la Empresa\n";
		}
		break;
	case 13:
		//eliminar viaje
		$objViaje=new Viaje;
		$colViajes=$objViaje->listarViajes();
		for($i=0;$i<count($colViajes);$i++){
			$unViaje=$colViajes[$i];
			echo $unViaje;
			echo "\n*************************************\n";
		}
		echo "Elija un ID del Viaje que desea ELIMINAR:\n";
		$idViajeEli=trim(fgets(STDIN));
		$respuesta=$objViaje->BuscarViaje($idViajeEli);
		if($respuesta){
			$respuesta=$objViaje->eliminarViaje();
			if($respuesta){
				echo "El Viaje se elimino Correctamente\n";
			}else{
				echo "No se pudo eliminar el Viaje\n";
			}
		}else{
			echo "No se encontro el Viaje\n";
		}
		break;
	case 14:
		//eliminar responsable
		$objResponsable=new ResponsableV;
		$colResponsables=$objResponsable->listarResponsable();
		for($i=0;$i<count($colResponsables);$i++){
			$unResponsable=$colResponsables[$i];
			echo $unResponsable;
			echo "\n*************************************\n";
		}
		echo "Elija un numero de empleado de un Responsable que desea ELIMINAR:\n";
		$nroResEli=trim(fgets(STDIN));
		$respuesta=$objResponsable->BuscarResponsable($nroResEli);
		if($respuesta){
			$respuesta=$objResponsable->eliminar();
			if($respuesta){
				echo "El Responsable se elimino Correctamente\n";
			}else{
				echo "No se pudo eliminar el Responsable\n";
			}
		}else{
			echo "No se encontro el Responsable\n";
		}
		break;
	case 15:
		//eliminar un pasajero
		$objPasajero=new Pasajero;
		$colPasajeros=$objPasajero->listarPasajeros();
		for($i=0;$i<count($colPasajeros);$i++){
			$unPasajero=$colPasajeros[$i];
			echo $unPasajero;
			echo "\n*************************************\n";
		}
		echo "Elija un numero de documento de un Pasajero que desea ELIMINAR:\n";
		$nroDocEli=trim(fgets(STDIN));
		$respuesta=$objPasajero->BuscarPasajero($nroDocEli);
		if($respuesta){
			$respuesta=$objPasajero->eliminarPasajero();
			if($respuesta){
				echo "El Pasajero se elimino Correctamente\n";
			}else{
				echo "No se pudo eliminar al Pasajero\n";
			}
		}else{
			echo "No se encontro al Pasajero\n";
		}
		break;
	}
}while($opcion!=16);

