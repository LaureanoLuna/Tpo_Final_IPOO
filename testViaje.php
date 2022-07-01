<?php
include('BaseDatoss.php');
include('ResponsableV.php');
include('Empresa.php');
include('Pasajero.php');
include('Viaje.php');
 /****************************************************************************/
        /******************** TEST DE PRUEBA ***********************/
 /****************************************************************************/

function ValidarViaje($obj, $dato){
    $cObj = $obj->Listar();
    $bool = true;
    $i = 0;
    while ($bool && $i < count($cObj)) {
      
        if($cObj[$i]->getVdestino() == $dato) {
            
            $bool = false;
         } 
         $i++;
    }
    return $bool;
}

function EncontrarDato($obj , $dato){
    $cObj = $obj->Listar();
    $bool = true;
    $i=0; 
    while ($bool && $i < count($cObj)) {
        if($cObj[$i]->getVdestino() == $dato) {
            $dato = $cObj[$i]; 
            $bool = false;
         } 
         $i++;
    }

    return $dato;
}




/*********************************************************** */
/****************/ /* Menu Principal  */ /***************** */
/*********************************************************** */

echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";

echo "\n1) Ingresar un nuevo viaje \n";// Inicializamos un nuevo objeto Persona y ViajeFeliz 
echo "\n2) Vender Pasaje \n"; // inicializamos al objeto Pasajero 
echo "\n3) Ver los datos del viaje y los Pasajeros \n";// una ves el objeto creado se pueden visualizar sus datos
echo "\n4) Modificar los datos ya generados \n";// en esta opvion se puede tener acceso a todos los atributos para settearlos

echo "\n5) Salir\n";

echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";

$opc = trim(fgets(STDIN));
do{

    switch ($opc) {
        /** 
         * Menu Principal
         *  1) Ingresar un nuevo viaje
         */
        case '1':
            echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";
    
            $destino = Interaccion("Ingrese el Destino");
    
            $capacidadViaje = Interaccion("Capacidad de pasajeros");
    
            $importe = Interaccion("Ingrese el importe");
            
            $tipoAsiento = Interaccion("¿Cama o Semi Cama?");
    
            $idayVuelta = Interaccion("¿Solo Ida?");
    
                
                $objEmpresa = new empresa();
                $opcEmpresa = MostrarOpciones($objEmpresa);
                $objResponsable = new responsable();
                $opcRespo = MostrarOpciones($objResponsable);
                $objViaje = new viaje(); 
                
            
                    if(ValidarViaje($objViaje,$destino)){ // Corroboramos que no se mismo Destino el Viaje
    
                        $objViaje->Cargar($destino, $capacidadViaje,$importe,$tipoAsiento, $idayVuelta);
                        $id = $objViaje->IngresarViaje();
                        //$objViaje->setobjEmpresa($opcEmpresa);
                       // $objViaje->setobjResponsable($opcRespo);
                       // echo $objViaje;
                       // $objViaje->ModificarViaje();
    
                        $objViaje->setId($id);
                        $objEmpresa->BuscarEmpresa($opcEmpresa);
                    
                        $objViaje->setobjEmpresa($objEmpresa);
                        $objResponsable->BuscarResponsable($opcRespo);
                        $objViaje->setobjResponsable($objResponsable);
                        
                        echo $objViaje;
                
                    }else{
                        echo "\nYa existe un Viaje con ese Destino\n ";
    
                        $objVRepetido = EncontrarDato($objViaje, $destino);// Mostramos el Viaje con ese mismo destino
                        $c=$objVRepetido->getobjEmpresa();
                        $objEmpresa->BuscarEmpresa($c);
                        $$objVRepetido->setobjEmpresa($objEmpresa);
                        $objResponsable->BuscarResponsable($objVRepetido->getobjResponsable());
    
                    }
            break;  
            
    
        /**
         * Menu Principal
         *   2) Vender Pasaje
         */
        case '2':
            
            $objViaje = new viaje(); //generamos el obj Viaje
            $objE = new empresa();
            $objR = new responsable();
            $arregloObj = $objViaje->Listar();
            foreach ($arregloObj as $x ) {
                $idEmpresa = $x->getobjEmpresa();
                $idResp = $x->getobjResponsable();
                $objE->BuscarEmpresa($idEmpresa);
                $objR->BuscarResponsable($idResp);
                $x->setobjEmpresa($objE);
                $x->setobjResponsable($objR);
        
                echo "-------------------------------------------------------------\n";
                echo $x;
            }
            
            //$opc = Mostrar($objViaje); // llamamos a la funcion que muestra todos los datos de la tabla
            echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";
            echo "\nIngresar los datos del Pasajero\n";
            echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";
    
    
            // Pedimos los datos del  Pasajero
            $nomPasajero =Interaccion("Nombre");
    
            $apellidoPasajero =Interaccion("Apellido");
    
            $dniPasajero =Interaccion("Numero de DNI");
        
            $numTelefono =Interaccion("Numero de Telefono");
           
    
            //Creamos el obj Pasajero
            $objPasajero = new pasajero();
            
            if (Comparar($objPasajero,$dniPasajero)){// Verificamos que el pasajero no este ya Cargado.
    
                //Le setteamos los valores al obj Pasajero
                $objPasajero->Cargar($nomPasajero, $apellidoPasajero, $dniPasajero, $numTelefono);
                $objPasajero->setIdviaje($opc);
                echo $objPasajero;
                if($objPasajero->AgregarPasajero()){ //Agregamos al pasajero a la BD
                    echo "\nEl pasajero se cargo correctamente\n";
                }
                
            }else{
                echo "\n El Pasajero ya fue registrado";
                $objPasajero->Buscar($dniPasajero); // Buscamos el Pasajero para saber en que Viaje esta asignado
                $idviaje= $objPasajero->getIdviaje();
                
                if ( $idviaje != ""){
                    echo "\n En el viaje \n";
                     $objViaje->BuscarViaje($idviaje);//Mostramos en el Viaje que esta asignado
                     echo $objViaje;
                }
                else{
                    echo "\nNo tiene un viaje asignado\n";
                }
    
             
            }
            break;
    
            /**
             * Menu Principal
             *  3) Ver los datos Cargados
             */
        case '3':
            // Creamos un obj de cada clase para manipularlos
            $repo = new responsable();
            $objEmpresa=new empresa();
            $viaje= new viaje();
            $pasajero=new pasajero();
    
          /*  
            $arregloObj = $viaje->Listar();
            foreach ($arregloObj as $x ) {
                $idEmpresa = $x->getobjEmpresa();
                $idResp = $x->getobjResponsable();
                $objEmpresa->BuscarEmpresa($idEmpresa);
                $repo->BuscarResponsable($idResp);
                $x->setobjEmpresa($objEmpresa);
                $x->setobjResponsable($repo);
        
             
            } */
    
            $eleccion = Interaccion("Que Viaje quiere Visualizar(Ingrese el id / Enter para todos?");/*Pedimos que id de viaje se quiere visualizar */
           
            if($eleccion != null){ // Corroboro que la eleccion no sea nula para mostrar el Viaje solicitado
                $arreViaje = $viaje->Listar("idviaje=".$eleccion);// Generamos un arreglo con la tupla elegida de la tabla Viaje
            }else{           
                $arreViaje = $viaje->Listar();// Generamos un arreglo con todas las tupla la tabla Viaje
                echo "\nVeamos todos los Viajes\n";
            }   
           
    
            // Mostramos por pantalla los datos solicitados
            foreach ($arreViaje as $key => $value) {
    
               
               
                echo "\n********************************************\n";
                // por cada objeto tomamod el id de Empresa
                $idEmpresa = $value->getobjEmpresa();
                $objEmpresa->BuscarEmpresa($idEmpresa);// buscamos la empresa
                $value->setobjEmpresa($objEmpresa); // setteamos el atributo de objEmpresa en la clase viaje
                
                // por cada objeto tomamod el id de Responsable
                $idResp = $value->getobjResponsable();
                $repo->BuscarResponsable($idResp);// buscamos al responsable
                $value->setobjResponsable($repo);// setteamos el atributo de objResponsable en la clase viaje
    
                $arregloPasajeros = $pasajero->Listar('idviaje='.$value->getId());// generamos un arreglo listando de la BD de los pasajeros con cada objViaje 
               
    
                $value->setColObjPasajero($arregloPasajeros); // Setteamos el arreglo de ObjPasajeros por cada objViaje
                
                echo $value; //Mostramos el Obj Viaje
    
                foreach ($value->getColObjPasajero() as $key => $valor) {
                    echo "\n→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→\n";
                    echo $valor; // Mostramos cada ObjPasajero de cada Viaje
                    echo "\n→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→\n";
                }
               
                echo "\n********************************************\n";
    
            } 
            break;
    
        /**
             * Menu Principal
             *  4) Modificar/ Borrar los datos ya generados 
             */
    
        case '4':
    
            echo "\n1) Datos de la Empresa\n";
            echo "\n2) Datos de la Viajes\n";
            echo "\n3) Datos de la Responsable\n";
            echo "\n4) Datos de la Pasajeros\n";
            $opc = trim(fgets(STDIN));
            // Menu Para Modificar cada clase
          do {
            switch ($opc) {
                case '1'://Opcion de Modificar Empresa
                    $opc = Interaccion("1) Modificar\n2) Borrar");
                  
                    do {
                        switch ($opc) {
                            case '1'://Menu para Modificar
        
                                echo "\n1) Datos de la Nombre\n";
                                echo "\n2) Datos de la Direccion\n";
                                echo "\n3) Datos de la ID Empresa\n";                        
                                $opc = trim(fgets(STDIN));
                                $objEmpresa = new empresa();
                                do {
                                    switch ($opc) {
                                        case '1'://Modificamos Nombre de Empresa
                                            $idEmp = Interaccion("¿ Que Empresa Modificar ?");
                                            $newData = Interaccion("Ingrese el nuevo Nombre de la Empresa");
                                            if (ValidarNombre($objEmpresa, $newData)){                                    
                                            $objEmpresa->BuscarEmpresa($idEmp);
                                            $objEmpresa->setEnombre($newData);
                                            $objEmpresa->ModificarEmpresa();
                                            echo $objEmpresa;
                                        }else{
                                            echo "\nYa existe una Empresa con ese nombre \n";
                                        }                         
                                            break;
                                        case '2':
                                            $idEmp = Interaccion("¿ Que Empresa Modificar ?");
                                            $newData = Interaccion("Ingrese la nueva Direccion de la Empresa");
                                            $objEmpresa->BuscarEmpresa($idEmp);
                                            $objEmpresa->setEdireccion($newData);
                                            $objEmpresa->ModificarEmpresa();
                                            echo $objEmpresa;
                                           
                                            break;
                                       
                                        default:
                                           
                                            break;
                                    }
                                } while ($opc<4);
                                
                                break;
                            case '2':// Menu para Borrar
                                $objEmpresa = new empresa();
                                $obj=new viaje;
                                $idEmp = Interaccion("¿ Que Empresa Eliminar ?");
                                $colViaje = $obj->Listar('idempresa='. $idEmp);
                                foreach ($colViaje as $key => $value) {
                                    echo $value;
                                    $value->setobjEmpresa();
                                    $value->ModificarViaje();
                                }
                                $objEmpresa->BuscarEmpresa($idEmp);
                                $objEmpresa->EliminarEmpresa();
                                        echo $objEmpresa;
                                break;   
                            
                            default:
                                # code...
                                break;
                        }
                    } while ($opc<5);
                  
                    break;
                case '2'://Opcion de Modificar Viaje
                    $opc = Interaccion("1) Modificar\n2) Borrar");
                   do {
                    switch ($opc) {
                        
                        case '1':
                           
                            $viaje = new viaje();
    
                                echo "\n1) Datos de la Destino\n";
                                echo "\n2) Datos de la Capacidad Maxima\n";
                                echo "\n3) Datos de la ID Empresa\n";
                                echo "\n4) Datos de la Responsable del Viaje\n";
                                echo "\n5) Datos de la Importe\n";
                                echo "\n6) Datos de la Tipo de Asiento\n";
                                echo "\n7) Datos de la Ida y Vuetos\n";
                                $opc = trim(fgets(STDIN));
    
                                do {
                                    switch ($opc) {//Menu para modificar la tabla del Viaje
                                        case '1':
                                            $objViaje= new viaje();
                                            $idvia = Interaccion("¿ Que Viaje Modificar ?");
                                            $newData = Interaccion("Ingrese el nuevo Destino de la Viaje");
                                            
                                            
                                            /* if(ValidarDestino($objViaje,$newData)){ */
                                                $objViaje->BuscarViaje($idvia);
                                                $objViaje->setVdestino($newData);
                                                $objViaje->ModificarViaje();
                                           /*  }else{ */
                                                echo "YA hay un viaje con ese destino";
                                        /*     } */
                                          
                                            break;
                                        case '2': //Datos de la Capacidad Maxima
                                            $objViaje= new viaje();
                                            $idvia = Interaccion("¿ Que Viaje Modificar ?");
                                            $newData = Interaccion("Ingrese la Nueva Capacidad del Viaje");
                                            
                                            $objViaje->BuscarViaje($idvia);
                                            $objViaje->setVcantmaxpasajeros($newData);
                                            $objViaje->ModificarViaje();
                                            break;
                                        case '3': // Datos de la ID Empresa
                                            
                                            $objViaje= new viaje();
                                            $objEmpresa= new empresa();
                                            $idvia = Interaccion("¿ Que Viaje Modificar ?");
                                            $newData = Interaccion("Ingrese la Nueva Capacidad del Viaje");
                                           
                                            $objViaje->BuscarViaje($idvia);
                                            $x =$objViaje->getobjEmpresa();
                                            if ($objEmpresa->BuscarEmpresa($x)){
                                                $objViaje->setobjEmpresa($newData);
                                                $objViaje->ModificarViaje();
                                                echo $objViaje;
                                            }
                                           
                                            break;
                                        case '4': //Datos de la Responsable del Viaje
                                            $objViaje= new viaje();
                                            $objEmpresa= new responsable();
                                            $idvia = Interaccion("¿ Que Viaje Modificar ?");
                                            $newData = Interaccion("Ingrese el id  del Responable");
                                           
                                            $objViaje->BuscarViaje($idvia);
                                            $x =$objViaje->getobjResponsable();
                                           // if ($objEmpresa->BuscarResponsable($x)){
                                                $objViaje->setobjEmpresa($newData);
                                                $objViaje->ModificarViaje();
                                                echo $objViaje;
                                            //}
                                            break;
                                        case '5':// Datos de la Importe
                                            $objViaje= new viaje();
                                            
                                            $idvia = Interaccion("¿ Que Viaje Modificar ?");
                                            $newData = Interaccion("Ingrese NUevo valor del Viaje");
                                           
                                            $objViaje->BuscarViaje($idvia);
                                            
                                           // if ($objEmpresa->BuscarResponsable($x)){
                                            $objViaje->setVimporte($newData);
                                            $objViaje->ModificarViaje();
                                                echo $objViaje;
                                           
                                            break;
                                        case '6':// Datos de la Tipo de Asiento
                                            $objViaje= new viaje();
                                            
                                            $idvia = Interaccion("¿ Que Viaje Modificar ?");
                                            $newData = Interaccion("Ingrese Tipo de asiento Viaje");
                                           
                                            $objViaje->BuscarViaje($idvia);
                                            
                                          
                                            $objViaje->setTipoAsiento($newData);
                                            $objViaje->ModificarViaje();
                                                echo $objViaje;
                                            break;
                                        case '7':// Datos de la Ida y Vuetos
                                            $objViaje= new viaje();
                                            
                                            $idvia = Interaccion("¿ Que Viaje Modificar ?");
                                            $newData = Interaccion("Ingrese el si es de Ida solo Viaje");
                                           
                                            $objViaje->BuscarViaje($idvia);
                                            
                                          
                                            $objViaje->setIdayvuelta($newData);
                                            echo $objViaje;
                                            $objViaje->ModificarViaje();
                                                echo $objViaje;
                                            break;
                                        
                                        default:
                                            # code...
                                            break;
                                    }
                                } while ($opc<8);
                           
                            break;
                        case '2'://Borrar n viaje
                            $objViaje= new viaje();
                            $objPasajero = new pasajero;
                            $idvia = Interaccion("¿ Que Viaje Eliminar ?");
                            $objViaje->BuscarViaje($idvia);                        
                            $colViaje= $objViaje->Listar();
                            foreach ($colViaje as $key => $value) {
                                $id = $value->getId();
                                $colPasa=$objPasajero->Listar();
                                foreach ($colPasa as $key => $valor) {
                                    $valor->EliminarPasajero();
                                }
                                $objViaje->EliminarViaje();
                            }
    
                            
                             break;
                        
                        default:
                            # code...
                            break;
                    }
                   } while ($opc<3);
                      
                    break;
                case '3'://Opcion de Modificar Responsable
                    $opc = Interaccion("1) Modificar\n2) Borrar");
                   do {
                    switch ($opc) {
                        case '1':
                            echo "\n1) Modificar Licencia \n";
                            echo "\n2) Modificar Nombre\n";
                            echo "\n3) Modificar Apellido\n";
                            do {
                                switch ($opc=trim(fgets(STDIN))) {
                                    case '1':
                                        $objRespo= new responsable();
                                        $esRes= Interaccion("Numero de empleado Responsable");
                                        $newData= Interaccion("Ingrese nueva Licencia");
                                        $objRespo->BuscarResponsable($esRes);
                                        $objRespo->setrnumerolicencia($newData);
                                        $objRespo->ModificarResponsable();
                                        echo $objRespo;
                                        break;
                                    case '2':
                                        $objRespo= new responsable();
                                        $esRes= Interaccion("Numero de empleado Responsable");
                                        $newData= Interaccion("Ingrese dato del Nombre");
                                        $objRespo->BuscarResponsable($esRes);
                                        $objRespo->setrnombre($newData);
                                        $objRespo->ModificarResponsable();
                                        echo $objRespo;
                                    case '3':
                                        $objRespo= new responsable();
                                        $esRes= Interaccion("Numero de empleado Responsable");
                                        $newData= Interaccion("Ingrese dato del apellido");
                                        $objRespo->BuscarResponsable($esRes);
                                        $objRespo->setrapellido($newData);
                                        $objRespo->ModificarResponsable();
                                        echo $objRespo;
                                        break;
        
                                    
                                    default:
                                        # code...
                                        break;
                                    }
                                
                                break;
                            } while ($opc<4);
                        case '2'://Borrado de REsponasable
                            $objRespo= new responsable();
                            $esRes= Interaccion("Numero de empleado Responsable");                      
                            $objRespo->BuscarResponsable($esRes);
                            $objRespo->EliminarResponsable();
                            echo $objRespo;
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                   } while ($opc<3);
                    break;
                case '4'://Opcion de Modificar Pasajero
                    $opc = Interaccion("1) Modificar\n2) Borrar");
                    do {
                        switch ($opc) {
                            case '1': //Modificamos Pasajero
                                echo "\n1) Modificar Nombre\n";
                                echo "\n2) Modificar Apellido\n";
                                echo "\n3) Modificar Telefono\n";
                                echo "\n4) Modificar n° Viaje\n";
                                do {
                                    switch ($opc=trim(fgets(STDIN))) {
                                        case '1':
                                            $objPAsa= new pasajero();
                                            $dniPasa= Interaccion("Ingrese el numeros de identificacion del pasajero");
                                            $newData = Interaccion("Ingrese el Nombre");
                                            $objPAsa->Buscar($dniPasa);
                                            $objPAsa->setPnombre($newData);
                                            $objPAsa->ModificarPasajero();
                                            echo $objPAsa;
                                            break;
                                        case '2':
                                            $objPAsa= new pasajero();
                                            $dniPasa= Interaccion("Ingrese el numeros de identificacion del pasajero");
                                            $newData = Interaccion("Ingrese el Apellido");
                                            $objPAsa->Buscar($dniPasa);
                                            $objPAsa->setPapellido($newData);
                                            $objPAsa->ModificarPasajero();
                                            echo $objPAsa;
                                            
                                            break;
                                        case '3':
                                            $objPAsa= new pasajero();
                                            $dniPasa= Interaccion("Ingrese el numeros de identificacion del pasajero");
                                            $newData = Interaccion("Ingrese el Telefono");
                                            $objPAsa->Buscar($dniPasa);
                                            $objPAsa->setPtelefono($newData);
                                            $objPAsa->ModificarPasajero();
                                            echo $objPAsa;
                                            break;
                                        case '4':
                                            $objPAsa= new pasajero();
                                            $objViaje= new viaje();                                
                                            $dniPasa= Interaccion("Ingrese el numeros de identificacion del pasajero");
                                            $newData = Interaccion("Ingrese el nro Viaje");
                                            $objPAsa->Buscar($dniPasa);
                                            $objPAsa->setIdviaje($newData);
                                            $objPAsa->ModificarPasajero();
                                            echo $objPAsa;
                                            break;
                                        
                                        default:
                                            # code...
                                            break;
                                    }
                                } while ($opc<5);
                                break;
                            case '2':// Borrar Un pasajero
                                $objPasa= new pasajero();
                                $dniPasa= Interaccion("Ingrese el numeros de identificacion del pasajero");
                                $objPAsa->Buscar($dniPasa);
                                $objPasa->EliminarPasajero();
        
                                break;
                            
                            default:
                                # code...
                                break;
                        }
                    } while ($opc<3);
                    break;
                    
                default:
                    # code...
                    break;
            }
    
          } while ($opc < 5);
    
    
        default:
         echo "\n Seleccione una opcion correcta\n";
        break;
    

}}while($opc < 5);
        

function ValidarDestino($obj, $data){
    $colObj = $obj->Listar();
    $i=0;
    $bool = true;
    while($bool && $i < count($colObj)){
        echo $colObj[$i];
        if($data == $colObj[$i]->getVdestino()){
            $bool= false;
        }
        $i++;
    }

    return $bool;    
}



function ValidarNombre($obj, $data){
    $colObj = $obj->Listar();
    $i=0;
    $bool = true;
    while($bool && $i < count($colObj)){
        if ($data == $colObj[$i]->getEnombre()){
            $bool= false;
        }
        $i++;
    }

    return $bool;    
}



function Comparar($obj,$dato){
    $arreg = $obj->Listar();
    $bool = true;
    $i = 0;
    while ($bool && $i < count($arreg)) {
        
        if($arreg[$i]->getId() == $dato){
            $bool = false;
        }
        $i++;
    }

    return $bool;

}




function Interaccion($tipoSolicitud)
{
                       
    echo "\n".$tipoSolicitud . ": ";                   
    $valorRetorno = trim(fgets(STDIN));
    echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";
    return $valorRetorno;
}

function MostrarOpciones($obj){
    $arreglo =$obj->Listar();
    foreach($arreglo as $x){
        echo "-------------------------------------------------------------\n";
        echo $x;
    }
    echo "\n/////////////////////////////////////////////////////\n";
    $opc = Interaccion("Elija una opcion");

    
    return $opc;   
}



function Mostrar($obj)
{
    $objE = new empresa();
    $objR = new responsable();
    $arregloObj = $obj->Listar();
    foreach ($arregloObj as $x ) {
        $idEmpresa = $x->getobjEmpresa();
        $idResp = $x->getobjResponsable();
        $objE->BuscarEmpresa($idEmpresa);
        $objR->BuscarResponsable($idResp);
        $x->setobjEmpresa($objE);
        $x->setobjResponsable($objR);

        echo "-------------------------------------------------------------\n";
        echo $x;
    }
   
}

function Coleccion($obj , $id)
{
    $arregloObj = $obj->Listar($id);
    return $arregloObj;
}


