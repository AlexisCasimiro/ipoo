<?php
include "claseViaje.php";


echo"Ingrese el codigo de viaje:";
$codigo=trim(fgets(STDIN));
echo "Ingrese el destino el viaje:";
$destinoViaje=trim(fgets(STDIN));
echo "Ingrese cantidad maxima de pasajeros:";
$pasajerosMax=trim(fgets(STDIN));
echo "Ingrese cantidad de pasajeros:";
$cantPasajeros=trim(fgets(STDIN));
$viaje1=new Viaje($codigo,$destinoViaje,$pasajerosMax);

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
        $viaje1->setCodigoViaje($nuevoCod);
        break;
    case 2:
        echo "Ingrese nuevo destino del viaje:";
        $nuevoDestino=trim(fgets(STDIN));
        $viaje1->setDestino($nuevoDestino);
        break;
    case 3:
        echo "Ingrese nueva cantidad maxima de pasajeros:";
        $nuevaCant=trim(fgets(STDIN));
        $viaje1->setMaxPasajeros($nuevaCant);
        break;
    case 4:
        echo"Ingrese nombre del pasajero:";
        $nombrePasajero=trim(fgets(STDIN));
        echo "Ingrese apellido del pasajero:";
        $apellidoPasajero=trim(fgets(STDIN));
        echo "Ingrese numero de D.N.I:";
        $dniPasajero=trim(fgets(STDIN));
        $datosDeLosPasajero=$viaje1->agregarPasajero($nombrePasajero,$apellidoPasajero,$dniPasajero);
        $viaje1->cadenaArregloPasajeros($datosDeLosPasajero);
        break;
    case 5:
        echo "Ingrese Numero de D.N.I del pasajero a modificar datos:";
        $documento=trim(fgets(STDIN));
        echo "Ingrese nuevo nombre:";
        $nuevoNombre=trim(fgets(STDIN));
        echo "Ingrese nuevo apellido:";
        $nuevoApellido=trim(fgets(STDIN));
        $datosDeLosPasajero=$viaje1->buscaPasajero($datosDeLosPasajero,$documento,$nuevoNombre,$nuevoApellido);
        $viaje1->cadenaArregloPasajeros($datosDeLosPasajero);
        break;
    case 6:
        echo $viaje1;
        break;
}
}while($opcion!=6);