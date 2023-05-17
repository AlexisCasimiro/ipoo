<?php
include_once "ResponsableV.php";
include_once "Pasajero.php";
include_once "Viaje.php";
include_once "PasajeroNecesidadesEspeciales.php";
include_once "PasajeroVIP.php";


//datos del viaje
echo "*******INGRESE LOS DATOS DEL VIAJE******\n";
echo"Ingrese el codigo de viaje:";
$codigo=trim(fgets(STDIN));
echo "Ingrese el destino el viaje:";
$destinoViaje=trim(fgets(STDIN));
echo "Ingrese cantidad maxima de pasajeros:";
$pasajerosMax=trim(fgets(STDIN));
//datos del responsable del viaje
echo "*******INGRESE LOS DATOS DEL RESPOSABLE DEL VIAJE******\n";
echo "Ingrese el numero del empleado:";
$nroEmpleado=trim(fgets(STDIN));
echo "Ingrese el numero de licencia del empleado:";
$nroLicencia=trim(fgets(STDIN));
echo "Ingrese el nombre del empleado:";
$nombreEmpl=trim(fgets(STDIN));
echo "Ingrese el apellido del empleado:";
$apellidoEmpl=trim(fgets(STDIN));
echo "Ingrese el costo del Viaje:";
$costoViaje=trim(fgets(STDIN));
$objResponsable= new ResponsableV($nroEmpleado,$nroLicencia,$nombreEmpl,$apellidoEmpl);
$objViaje=new Viaje($codigo,$destinoViaje,$pasajerosMax,$objResponsable,$costoViaje,0);

do{
echo "\n**MENU DE OPCIONES**\n
    1) Cambiar el codigo del viaje\n
    2) Cambiar el destino del viaje\n
    3) Cambiar la cantidad de pasajeros maximas\n
    4) Ingresar pasajero\n
    5) Modificar datos de un pasajero\n
    6) Mostrar datos del viaje\n\n\n";
echo "Ingrese una opcion:";
$opcion=trim(fgets(STDIN));
$datosDeLosPasajero=[];
$cadena="";

switch($opcion){
    case 1:
        echo"Ingrese el nuevo codigo del viaje:";
        $nuevoCod=trim(fgets(STDIN));
        $objViaje->setCodigoViaje($nuevoCod);
        break;
    case 2:
        echo "Ingrese nuevo destino del viaje:";
        $nuevoDestino=trim(fgets(STDIN));
        $objViaje->setDestino($nuevoDestino);
        break;
    case 3:
        echo "Ingrese nueva cantidad maxima de pasajeros:";
        $nuevaCant=trim(fgets(STDIN));
        $objViaje->setMaxPasajeros($nuevaCant);
        break;
    case 4:
        if(count($objViaje->getColPasajeros())<$objViaje->getMaxPasajeros()){
        do{
            echo "\n**MENU DE OPCIONES**\n
            1) Ingresar pasajero estandar\n
            2) Ingresar pasajero VIP\n
            3) Ingresar pasajero con Necesidades Especiales\n\n";
            echo"Ingrese una opcion:";
            $opcionPasajero=trim(fgets(STDIN));
            
            switch($opcionPasajero){
                case 1:
                    echo "Ingrese nombre del pasajero:";
                    $nombrePasajeroEst=trim(fgets(STDIN));
                    echo "Ingrese apellido del pasajero:";
                    $apellidoPasajeroEst=trim(fgets(STDIN));
                    echo "Ingrese el D.N.I del pasajero";
                    $dniPasajeroEst=trim(fgets(STDIN));
                    echo "Ingrese el telefono del pasajero:";
                    $telefonoPasajeroEst=trim(fgets(STDIN));
                    echo "Ingrese el numero de asiento del pasajero:";
                    $nroAsientoEst=trim(fgets(STDIN));
                    echo "Ingrese el numero de ticket del pasaje del viaje:";
                    $nroTicketEst=trim(fgets(STDIN));
                    $objPasajeroNuevo=new Pasajero($nombrePasajeroEst,$apellidoPasajeroEst,$dniPasajeroEst,$telefonoPasajeroEst,$nroAsientoEst,$nroTicketEst);
                    $colPasajeros=$objViaje->getColPasajeros();
                    $colPasajeros[]=$objPasajeroNuevo;
                    $objViaje->setColPasajeros($colPasajeros);
                    break;
                case 2:
                    echo "Ingrese nombre del pasajero:";
                    $nombrePasajeroVIP=trim(fgets(STDIN));
                    echo "Ingrese apellido del pasajero:";
                    $apellidoPasajeroVIP=trim(fgets(STDIN));
                    echo "Ingrese el D.N.I del pasajero";
                    $dniPasajeroVIP=trim(fgets(STDIN));
                    echo "Ingrese el telefono del pasajero:";
                    $telefonoPasajeroVIP=trim(fgets(STDIN));
                    echo "Ingrese el numero de asiento del pasajero:";
                    $nroAsientoVIP=trim(fgets(STDIN));
                    echo "Ingrese el numero de ticket del pasaje del viaje:";
                    $nroTicketVIP=trim(fgets(STDIN));
                    echo "Ingrese el numero de viajero frecuente:";
                    $nroViajeroFrecuenteVIP=trim(fgets(STDIN));
                    echo "Ingrese las cantidad de millas del pasajeor:";
                    $cantMillasVIP=trim(fgets(STDIN));
                    $objPasajeroVIPNuevo=new PasajeroVIP($nombrePasajeroVIP,$apellidoPasajeroVIP,$dniPasajeroVIP,$telefonnoPasajeroVIP,$nroAsientoVIP,$nroTicketVIP,$nroViajeroFrecuenteVIP,$cantMillasVIP);
                    $colPasajeros=$objViaje->getColPasajeros();
                    $colPasajeros[]=$objPasajeroNuevo;
                    $objViaje->setColPasajeros($colPasajeros);
                    break;
                case 3:
                    echo "Ingrese nombre del pasajero:";
                    $nombrePasajeroNE=trim(fgets(STDIN));
                    echo "Ingrese apellido del pasajero:";
                    $apellidoPasajeroNE=trim(fgets(STDIN));
                    echo "Ingrese el D.N.I del pasajero";
                    $dniPasajeroNE=trim(fgets(STDIN));
                    echo "Ingrese el telefono del pasajero:";
                    $telefonoPasajeroNE=trim(fgets(STDIN));
                    echo "Ingrese el numero de asiento del pasajero:";
                    $nroAsientoNE=trim(fgets(STDIN));
                    echo "Ingrese el numero de ticket del pasaje del viaje:";
                    $nroTicketNE=trim(fgets(STDIN));
                    echo "Cuantos servicios Especiales necesita?:(1),(2),(3)";
                    $cantServicios=trim(fgets(STDIN));
                    $colServicios=[];
                    for($i=1;$i<=$cantServicios;$i++){
                        echo "ingrese un servicio que necesita:";
                        $servicio=trim(fgets(STDIN));
                        $colServicios[]=$servicio;
                    }
                    $objPasajeroNecesidadesEspeciales=new PasajeroNecesidadesEspeciales($nombrePasajeroNE,$apellidoPasajeroNE,$dniPasajeroNE,$telefonoPasajeroNE,$nroAsientoNE,$nroTicketNE,$colServicios);
                    $colPasajeros=$objViaje->getColPasajeros();
                    $colPasajeros[]=$objPasajeroNuevo;
                    break;
                    
        }
        }while($opcionPasajero !=4);
        }else{
            echo "Ya se alcanzo la cantidad maxima de pasajeros";
        }
        break;
    case 5:
        echo "Ingrese Numero de D.N.I del pasajero a modificar datos:";
        $documento=trim(fgets(STDIN));
        echo "Ingrese nuevo nombre:";
        $nuevoNombre=trim(fgets(STDIN));
        echo "Ingrese nuevo apellido:";
        $nuevoApellido=trim(fgets(STDIN));
        echo"Ingrese nuevo Telefono:";
        $nuevoTelefonoPasajero=trim(fgets(STDIN));
        $objViaje->buscaPasajero($documento,$nuevoNombre,$nuevoApellido,$nuevoTelefonoPasajero);
        $objViaje->cadenaArregloPasajeros();
        break;
    case 6:
        echo $objViaje;
        break;
}
}while($opcion!=6);
