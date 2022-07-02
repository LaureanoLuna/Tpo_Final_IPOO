<?php

include('BaseDatoss.php');
include('ResponsableV.php');
include('Empresa.php');
include('Pasajero.php');
include('Viaje.php');



function Menu(){

    echo "Menu general.
    \n 1. Menu pasajero
    \n 2. Menu responsable
    \n 3. Menu viaje
    \n 4. Menu empresa.
    \n 5. Salir\n";
}


function menuPasajero(){    
    //Menu pasajero
    $bool = true;
    while ($bool) {
        echo "Menu pasajero.\n
        1) Ver.\n
        2) Buscar.\n
        3) Modificar.\n
        4) Eliminar.\n
        5) Agregar.\n
        6) Salir\n";
        $selected = trim(fgets(STDIN));
        switch ($selected) { 
            case '1':// opcion de ver Pasajeros
                $objPasa = new pasajero();
               
                $colPasas = $objPasa->listar();
                if(count($colPasas) == 0){
                    echo "No hay pasajeros.\n";
                }else{
                 
                   
                    foreach ($colPasas as $key => $value) {
                        echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";
                        echo "\n".$value;
                        echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";                          
                    }
                   
                }
                break;

            case '2':// opcion de Buscar Pasajeros
               
                echo "Ingrese el dni del pasajero: \n";
                $dni = trim(fgets(STDIN));
                $objPasas = new Pasajero();
                if ($objPasas->buscar($dni)) {
                    echo $objPasas;
                } else {
                    echo "No se encontró el pasajero.\n";
                }
                break;

            case '3':// opcion de Modificar Pasajeros
               
                echo "Ingrese el documento de un pasajero: \n";
                $dniPasa = trim(fgets(STDIN));
                $objPasas = new Pasajero();
                if ($objPasas->Buscar($dniPasa)) {
                    echo $objPasas;
                    echo "Modificar\n1) Nombre\n2) Apellido\n3) Telefono";
                    $bool =true;
                    while ($bool) {
                       $opc=trim(fgets(STDIN));
                       switch ($opc) {
                        case '1':
                            echo "Ingrese el nombre: \n";
                            $nombrePas = trim(fgets(STDIN));                            
                            $objPasas->setPnombre($nombrePas);
                            if($objPasas->ModificarPasajero()){
                                echo "Se modifico con exito";
                            }  
                            break;
                        case '2':
                            echo "Ingrese el apellido: \n";
                            $apellidoPas = trim(fgets(STDIN));                            
                            $objPasas->setPapellido($apellidoPas);
                            if($objPasas->ModificarPasajero()){
                                echo "Se modifico con exito";
                            }
                             break;
                        case '3':
                            echo "Ingrese el telefono: \n";
                            $tel = intval(trim(fgets(STDIN)));
                            $objPasas->setPtelefono($tel);
                            if($objPasas->ModificarPasajero()){
                                echo "Se modifico con exito";
                            }
                                break;
                        default:
                        echo  "ingrese una opcion correcta";
                                $bool=false;
                            break;
                       }
                    }
                }else{
                    echo "\nno se encontro el pasajero\n";
                }
                   
            case '4':// opcion de Eliminar Pasajeros
                echo "Ingrese el documento de un pasajero: \n";
                $dniPasa= trim(fgets(STDIN));
                $objPasas = new pasajero();
                if ($objPasas->Buscar($dniPasa)) {
                    if ($objPasas->EliminarPasajero()) {
                        echo "Se elimino correctamente.\n";
                    } else {
                        echo "No se ha podido eliminar.\n";
                    }
                } else {
                    echo "NO existe ese Pasajero.\n";
                }
                break;

            case '5':// opcion de Agregar un Pasajeros
                
                echo "Ingrese el documento de un pasajero:: \n";
                $dniPasa = trim(fgets(STDIN));
                $objPasas = new Pasajero();
                if ($objPasas->Buscar($dniPasa)) {
                    echo "Ese pasajero ya existe.\n";
                } else {
                   /*  $objPasas->set($dniPasa); */
                    echo "\nIngrese el nombre: \n";
                    $nombre = trim(fgets(STDIN));
                    $objPasas->setPnombre($nombre);
                    echo "Ingrese el apellido: \n";
                    $apellido = trim(fgets(STDIN));
                    $objPasas->setPapellido($apellido);
                    echo "Ingrese el telefono: \n";
                    $tel = trim(fgets(STDIN));
                    $objPasas->setPtelefono($tel);
                    $bool = true;
                    while($bool){
                        echo "Ingrese el número de viaje existente: \n";
                        $idViaje = trim(fgets(STDIN));
                        $objV = new viaje();
                        if($objV->BuscarViaje($idViaje)){
                            
                            $colPasajeros = $objPasas->Listar("idviaje = $idViaje");
                            $lugaresOcup = count($colPasajeros);                           
                            if($lugaresOcup < $$objV->getVcantmaxpasajeros()){                                
                                echo "Este viaje posee lugar.\n";
                                $objPasas->setObjViaje($objViaje);
                                $bool = false;
                            }else{
                                echo "No hay lugar.\n";
                            } 
                         }else{
                            echo "Elija un viaje existente\n";
                        }
                    }
                    if ($objPasas->AgregarPasajero()) {
                        echo "SE ingreso Correctamente.\n";
                    } else {
                        echo "Error al ingresar.\n";
                    }
                    
                }
                break;

            case '6':
                $bool = false;
                break;

            default:
                break;
        }
    }

}


function MenuViaje(){  

    $bool = true;
    while ($bool) {
        echo "Menu viaje.\n
        1. Ver\n
        2. Buscar\n
        3. Modificar\n
        4. Eliminar\n
        5. Crear\n
        6. Salir\n";
        $opc = trim(fgets(STDIN));
        switch ($opc) {
            case '1':// Opcion para ver los Viajes
                $objViaje=new viaje();            
                $colViajes = $objViaje->Listar();
                if (count($colViajes) == 0) {
                    echo "No hay viajes.\n";
                } else {                    
                    $lista = "";
                    foreach ($colViajes as $key => $value) {
                        echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";
                        echo  $value;
                        echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";
                    }
                   
                }
                break;

            case '2':// Opcion para Buscar los Viajes
                
                echo "Ingrese el número de viaje: \n";
                $idV = trim(fgets(STDIN));
                $objViaje = new Viaje();
                if($objViaje->BuscarViaje($idV)) {
                    echo $objViaje;
                } else {
                    echo "No se encontró dicho viaje.\n";
                }
                break;

            case '3':// Opcion para Modificar los Viajes               
                echo "Ingrese id del viaje: \n";
                $idV = trim(fgets(STDIN));
                $objViaje = new Viaje();
                if ($objViaje->BuscarViaje($idV)) {
                    echo $objViaje;
                    echo "Modificar\n1) Destino\n2) Importe\n3) Cantidad Maxima de Pasajero\n4) Tipo de Asiento\n5) Ida y Vuelta\n6) Empresa\n7) Responsable";
                    $bool = true;
                    $opc=trim(fgets(STDIN));
                    switch ($opc) {
                        case '1':
                            echo "Ingrese el destino: \n";
                            $destino = trim(fgets(STDIN));
                            if($destino != ''){
                                $objViaje->setVdestino($destino);
                                if($objViaje->ModificarViaje()){
                                    echo "Se realizo la Modificacion";
                                }
                            }else{
                                echo "\nNo se realizo la modificacion\n";
                            }                           
                            break;
                        case '2':                            
                            echo "Ingrese el importe: \n";
                            $importe = trim(fgets(STDIN));
                            if($importe != 0){
                                $objViaje->setVimporte($importe);
                                if($objViaje->ModificarViaje()){
                                    echo "\nSe realizo la modificacion\n";
                                }
                            }
                            
                            break;
                        case '3':
                            echo "\Ingrese la nueva cantidad maxima de pasajeros\n";
                            $cantPas = trim(fgets(STDIN));
                            if($cantPas > 0){
                                $objPaasas= new pasajero;
                                $colP = $objPaasas->Listar("idviaje=".$idV);
                                if ($cantPas < count($colP)){
                                    $objViaje->setVcantmaxpasajeros($cantPas);
                                    $objViaje->ModificarViaje();
                                    echo "\nSe realizo la Modificacion\n";
                                }
                            }
                            
                            break;
                        case '4':
                            echo "Ingrese el tipo de asiento: \n";
                            $tAsiento = trim(fgets(STDIN));
                            if($tAsiento != ''){
                                $objViaje->setTipoasiento($tAsiento);
                                $objViaje->ModificarViaje();
                                echo " \nSe realizo la Modificacion\n";
                            }
                           
                            break;

                        case '5':
                            echo "Es ¿ida o vuelta?.\n";
                            $idaOvuelta = trim(fgets(STDIN));
                            if($idaOvuelta != ''){
                                $objViaje->setIdayvuelta($idaOvuelta);
                                $objViaje->ModificarViaje();
                                echo " \nSe realizo la Modificacion\n";
                            }
                            break;
                        case '6':
                           
                            $colEmp=$objViaje->getobjEmpresa()->Listar();
                            echo "\nCual Empresa\n";
                            foreach ($colEmp as $value) {
                                echo "-------------------------------------------------------------\n";
                                echo $value;
                                echo "-------------------------------------------------------------\n";
                            }
                            echo "Ingres el ID de la Empresa : \n";
                            $idE = trim(fgets(STDIN));
                            $objEmp = new Empresa();
                            if ($objEmp->BuscarEmpresa($idE)) {
                                $objViaje->setobjEmpresa($objEmp);
                                $objViaje->ModificarViaje();
                                echo " \nSe realizo la Modificacion\n";                                
                            }
                            break;
                        case '7':
                           $colRes=$objViaje->getobjResponsable()->Listar();
                           echo "\nElija al responsable\n";
                           foreach ($colRes as $value) {
                            echo "-------------------------------------------------------------\n";
                            $value;
                            echo "-------------------------------------------------------------\n";                            
                           }
                           echo "\nIngrese N° identificatorio del Responsable\n";
                           $idR = trim(fgets(STDIN));
                           $objRes = new responsable();
                           if ($objRes->BuscarResponsable($idR)){
                            $objViaje->setobjResponsable($objRes);
                            $objViaje->ModificarViaje();
                            echo " \nSe realizo la Modificacion\n"; 
                           }
                            break;
                        
                            default:
                           
                            break;
                    }

                }
                break;           

            case '4':// Opcion para eliminar un Viaje

                echo "Al borrar un viaje se eliminaran todos los datos referentes a este\n";
                echo "Desea Continuar (S / N)\n";
                $opto= trim(fgets(STDIN));

                if ($opto == "S"){
                    $objViaje= new viaje();
                    $colViajes= $objViaje->Listar();
                    foreach ($colViajes as $value) {
                        echo "\n********************************************\n";
                        $value;
                        echo "\n********************************************\n";                        
                    }
                    echo "Ingrese el número de viaje: \n";
                    $numViaje= trim(fgets(STDIN));
                   
                    if ($objViaje->BuscarViaje($numViaje)){
                        if($objViaje->EliminarViaje()){
                            echo "\nSe elimino correctamente\n";
                        }
                    }else{
                        echo "\nIngrese un vaije Correcto\n";
                    }
                }
                
          
            case '5': //Opcion Para crear un viaje
                
               
                    echo "Ingrese el id del viaje: \n";
                    $idV = trim(fgets(STDIN));
                    $objViaje = new Viaje();
                    if($objViaje->BuscarViaje($idV)){
                        echo "El id ya existe\n";
                    }else{
                        $objViaje->setId($idV);                     
                    }
                    echo "Ingrese el destino: \n";
                    $destino = trim(fgets(STDIN));
                    $objViaje->setVdestino($destino);
                    echo "Ingrese la cantidad máxima de pasajeros: \n";
                    $vcantmaxpasajeros = trim(fgets(STDIN));
                    $objViaje->setVcantmaxpasajeros($vcantmaxpasajeros);
                    
                    $colemp= $objViaje->getobjEmpresa()->Listar();

                    foreach ($colemp as $value) {

                        echo "\n********************************************\n";
                        $value;
                        echo "\n********************************************\n";
                    }                    
                        echo "Ingrese el id de una empresa\n";
                        $idE = trim(fgets(STDIN));
                        $objEmp = new empresa();
                        if($objEmp->BuscarEmpresa($idE)){                           
                            $objViaje->setobjEmpresa($objEmp);                           
                        } 
                     
                    $colRep= $objViaje->getobjResponsable()->Listar();

                    foreach ($colRep as $value) {
    
                         echo "\n********************************************\n";
                         $value;
                         echo "\n********************************************\n";
                    }                                
                   
                        echo "Ingrese el número de un responsable.\n";
                        $rnumeroempleado = trim(fgets(STDIN));
                        $objResponsable = new responsable();
                        if($objResponsable->BuscarResponsable($rnumeroempleado)){
                            $objViaje->setobjResponsable($objResponsable);
                        }
                    
                    echo "Ingrese el importe: \n";
                    $vimporte = trim(fgets(STDIN));
                    $objViaje->setVimporte($vimporte);

                    echo "Ingrese el tipo de asiento: \n";
                    $tipoasiento = trim(fgets(STDIN));
                    $objViaje->setTipoasiento($tipoasiento);

                    echo "Es ¿ida o vuelta?.\n";
                    $idaovuelta = trim(fgets(STDIN));
                    $objViaje->setIdayvuelta($idaovuelta);

                    echo $objViaje;
                    if($objViaje->IngresarViaje()){
                        echo "El viaje se ha insertado.\n";

                    }else{
                        echo "El viaje no se ha insertado.\n";
                        
                    };
              
                break;

            case '6':
                $bool = false;
                break;

            default:
                
                break;
        }
    }

}

function MenuResposable(){

    
    //Menu responsable 

    $bool = true;
    while ($bool) {
        echo "Menu responsable.\n 1. Ver .\n 2. Buscar .\n 3. Modificar.\n 4. Eliminar .\n 5. Crear \n 6. Salir\n";
        $opc = trim(fgets(STDIN));
        switch ($opc) {
            case '1':// Opcion para ver los Responsables 
                $objRes= new responsable();               
                $colResponsables =$objRes->Listar();
                if (count($colResponsables) == 0) {
                    echo "No hay responsables.\n";
                } else {
                                     
                    foreach ($colResponsables as $key => $value) {
                        echo "\n→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→\n";
                        echo $value;
                        echo "\n→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→\n";
                    }
                   
                }
                break;

            case '2'://Opcion para Buscar un Responsable
               
                echo "Ingrese el número de empleado: \n";
                $numero = trim(fgets(STDIN));
                $objRes = new responsable();
                if ($objRes->BuscarResponsable($numero)) {
                    echo $objRes;
                } else {
                    echo "No se ha encontrado al responsable.\n";
                }
                break;

            case '3':// Opcion para Modificar un Responsable
                
                echo "Ingrese el número de empleado: \n";
                $numero = trim(fgets(STDIN));
                $objRes = new responsable();
                if ($objRes->BuscarResponsable($numero)) {
                    echo $objRes;

                    echo "Modificar :\n1)Numero de Licencio\n2) Nombre\n3) Apellido ";
                    $opc=trim(fgets(STDIN));
                    switch ($opc) {
                        case '1':
                            echo "Ingrese el número de licencia: \n";
                            $numlicencia = intval(trim(fgets(STDIN)));
                            if ($numlicencia != '') {
                                $objRes->setrnumerolicencia($numlicencia);
                                if ($objRes->ModificarResponsable()) {
                                    echo "Se han modificado los datos.\n";
                                }
                            }
                            break;
                        case '2':
                            echo "Ingrese el nombre: \n";
                            $nombre = trim(fgets(STDIN));
                            if ($nombre != '') {
                                $objRes->setRnombre($nombre);
                                if ($objRes->ModificarResponsable()) {
                                    echo "Se han modificado los datos.\n";
                                }
                            }
                        case '3':
                            echo "Ingrese el apellido: \n";
                            $apellido = trim(fgets(STDIN));
                            if ($apellido != '') {
                                $objRes->setRapellido($apellido);
                                if ($objRes->ModificarResponsable()) {
                                    echo "Se han modificado los datos.\n";
                                }
                            }
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                }
                break;

            case '4':// OPcion para eliminar un Responsable
                
                echo "Ingrese el número de empleado: \n";
                $numero = trim(fgets(STDIN));
                $objRes = new responsable();
                if ($objRes->BuscarResponsable($numero)) {
                    if ($objRes->EliminarResponsable()) {
                        echo "Se ha eliminado Correctamente.\n";
                    } else {
                        echo "error no se elimino.\n";                       
                    }
                } else {
                    echo "No se  encontro responsable.\n";
                }
                break;

            case '5':// opcion para crear un responsable
                
                echo "Ingrese el número de empleado: \n";
                $numero = trim(fgets(STDIN));
                $objRes = new responsable();
                if ($objRes->BuscarResponsable($numero)) {
                    echo "Ya se encunetra el empleado.\n";
                } else {
                    $objRes->setId($numero);
                    echo "Ingrese el número de licencia: \n";
                    $numlicencia = trim(fgets(STDIN));
                    $objRes->setrnumerolicencia($numlicencia);
                    echo "Ingrese el nombre: \n";
                    $nombre = trim(fgets(STDIN));
                    $objRes->setrnombre($nombre);
                    echo "Ingrese el apellido: \n";
                    $apellido = trim(fgets(STDIN));
                    $objRes->setrapellido($apellido);
                    if ($objRes->AgregarResponsable()) {
                        echo "Se cargo Correctamente.\n";
                    } else {
                        echo "El responsable no ha sido cargado1.\n";
                       
                    }
                }
                break;

            case '6':
                $bool = false;
                break;

            default:
                # code...
                break;
        }
    }

}



?>