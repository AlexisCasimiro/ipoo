<?php
include_once("claseResponsableV.php");
include_once("clasePasajero.php");
include_once("claseViaje.php");


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
$objResponsable= new ResponsableV($nroEmpleado,$nroLicencia,$nombreEmpl,$apellidoEmpl);
$objViaje=new Viaje($codigo,$destinoViaje,$pasajerosMax,$objResponsable);

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
        echo"Ingrese nombre del pasajero:";
        $nombrePasajero=trim(fgets(STDIN));
        echo "Ingrese apellido del pasajero:";
        $apellidoPasajero=trim(fgets(STDIN));
        echo "Ingrese numero de D.N.I:";
        $dniPasajero=trim(fgets(STDIN));
        echo"Ingrese Telefono del pasajero:";
        $telefonoPasajero=trim(fgets(STDIN));
        $objViaje->agregarPasajero($nombrePasajero,$apellidoPasajero,$dniPasajero,$telefonoPasajero);
        $objViaje->cadenaArregloPasajeros();
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
        $objViaje->cadenaArregloPasajeros();//tal vez no es necesario(lo hago para no repetirlo)
        echo $objViaje;
        break;
}
}while($opcion!=6);
