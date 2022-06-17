<?php
include('BaseDatoss.php');
include('ResponsableV.php');


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
$obj->setrnumeroempleado(1);
$resp = $obj->EliminarResponsable();

if($resp == true){
    echo "anda";
}else{
    echo "no anda";
}