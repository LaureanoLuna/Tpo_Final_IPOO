<?php
include('BaseDatoss.php');
include('ResponsableV.php');
include('Empresa.php');
include('Pasajero.php');
 /****************************************************************************/
        /********************TEST DE PRUEBA ***********************/
 /****************************************************************************/

$obj = new responsable(5,3,"Laureano","Luna");
/*$resp = $obj->AgregarResponsable();
if($resp){
    echo "Anda\n-----------\n". $obj;
} */
/* $obj->setrnumeroempleado(1);
$obj->setrnombre("Ivan");
$resp = $obj->Modificar();
if($resp == true){
    echo "anda";
}
else{
    echo "no anda";
} */
/* $obj->setrnumeroempleado(1);
$resp = $obj->EliminarResponsable();

if($resp == true){
    echo "anda";
}else{
    echo "no anda";
} */

$objEmpresa = new empresa(2,"Flecha","Nahuel");
/* $resp= $objEmpresa->IngresarEmpresa();
if ($resp){
    echo "\nanda empresa ";
} */

/* $objEmpresa->setIdempresa(1);
$objEmpresa->setIdempresa(3);
$resp = $objEmpresa->ModificarEmpresa();
if ($resp){
    echo "anda";
} */
/* $objEmpresa->setIdempresa(3);
$resp = $objEmpresa->EliminarEmpresa();

if ($resp){
    echo "anda";
} */

$objPasajero= new pasajero("Laureano","Luna",38233325,1126478811);

/*$resp = $objPasajero->AgregarPasajero() */;
 
$objPasajero->setRdocumento(35468488);
$objPasajero->setPnombre("CArlsod");

$resp = $objPasajero->ModificarPasajero(35468488);

if ($resp){
    echo "Anda";
}