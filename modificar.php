<?php

include('BaseDatoss.php');
include('ResponsableV.php');
include('Empresa.php');
include('Pasajero.php');
include('Viaje.php');

$objRespo = new responsable();
$objViaje= new viaje();
$objempresa= new empresa();
$objPasajero = new pasajero();

$base = new BaseDatos();

$objViaje->BuscarViaje(14);
$objViaje->setVdestino('Roca');
$objViaje->ModificarViaje();
echo $objViaje;

/* $c = $objRespo->Listar();
foreach ($c as $key => $value) {
    echo "\n".$value."\n";
}
 *//* 
$objRespo->BuscarResponsable(1);
$x=$objViaje->Listar("rnumeroempleado ="."1");
foreach ($x as $key => $value) {
    echo $value;
  

    $xobj=$objPasajero->Listar('idviaje='.$value->getId());
    foreach ($xobj as $key => $valor) {
        $valor->EliminarPasajero();
        echo $valor;
    }
    $value->EliminarViaje();
    echo $value;
} 
echo $objRespo;
echo " Lo busca ";
$objRespo->setrnumerolicencia('3');

echo $objRespo;
$objRespo->EliminarResponsable();
echo " Lo SETTEA ";

echo $objRespo; 
 */