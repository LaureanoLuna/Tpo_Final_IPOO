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
echo "\n5) Guardar los datos del viaje \n";// guarda el objeto Viaje Feliz en un arreglo con una clave que es el atributo codigo de viaje
echo "\n6) Ver los viajes ya guardados \n";// visualizamos los datos de los objetos ViajeFeliz ya creados y guardados
echo "\n7) Salir\n";

echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";

$opc = trim(fgets(STDIN));
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
        switch ($opc) {
            case '1'://Opcion de Modificar Empresa
                $opc = Interaccion("1) Modificar\n2) Borrar");
              
                switch ($opc) {
                    case '1'://Menu para Modificar

                        echo "\n1) Datos de la Nombre\n";
                        echo "\n2) Datos de la Direccion\n";
                        echo "\n3) Datos de la ID Empresa\n";                        
                        $opc = trim(fgets(STDIN));
                        $objEmpresa = new empresa();
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
              
                break;
            case '2'://Opcion de Modificar Viaje
                $opc = Interaccion("1) Modificar\n2) Borrar");
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
                                case '5':
                                   
                                    break;
                                case '6':
                                    # code...
                                    break;
                                case '7':
                                    # code...
                                    break;
                                case '8':
                                    # code...
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                       
                        break;
                    case '2':
                        # code...
                         break;
                    
                    default:
                        # code...
                        break;
                }
                  
                break;
            case '3'://Opcion de Modificar Responsable
                     
                break;
            case '4'://Opcion de Modificar Pasajero
              
                break;
                
            default:
                # code...
                break;
        }



    break;

        echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";

        echo "\nQue modificacion desea realizar \n";
        echo "\n1)Modificar los datos de los pasajeros ya ingresados \n";// ingresa a el siguente menu para poder modificar valores especificos del objeto Persona
        echo "\n2)Borrar algun pasajero ya ingresado \n";// borra y reacomoda los elementos del atributo para que no queden huecos
        echo "\n3)Modificar los datos del responsable del viaje.\n";
        echo "\n4)Cambiar destino del viaje \n";// settea el atributo setDestino con un valor ingresado por teclado 
        echo "\n5)Cambiar la capacidad del viaje \n";// settea el atributo setCapMaxPers con un valor ingresado por teclado
        echo "\n6)Volver al menu anterior \n";// regresa al menu anterior
        
        echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";

        echo "\n1) Datos de la Empresa\n";
        echo "\n) Datos de la Viajes\n";
        echo "\n1) Datos de la Responsable\n";
        echo "\n1) Datos de la Pasajeros\n";
         switch(Interaccion("Que desea Modificar")){
            case '1':
                $num = Interaccion("Indique el numero Identificador");
                $empresa = new empresa();
                if(Comparar($empresa,$num)){
                    
                    echo "\n1) Datos de la Nombre\n";
                    echo "\n2) Datos de la Direccion\n";
                    echo "\n3) Datos de la ID Empresa\n";
                    $opc = trim(fgets(STDIN));
                  while ($opc < 4)
                  { switch ($opc) {
                        case '1':                            
                           $empresa->setEnombre(Interaccion("Ingrese el nuevo dato"));
                           if($empresa->ModificarEmpresa()){
                            echo $empresa;
                           }
                            break;
                        case '2':
                           $empresa->setEdireccion(Interaccion("Ingrese el nuevo dato"));
                           if($empresa->ModificarEmpresa()){
                            echo $empresa;
                           }
                            break;
                        case '3':
                            
                           $empresa->setId(Interaccion("Ingrese el nuevo dato"));
                           $empresa->Cargar($empresa->getId(),$empresa->getEnombre(),$empresa->getEdireccion());
                           $empresa->setId($num);
                           $empresa->EliminarEmpresa();
                            break;
                        
                        default:
                           echo "Ingrese una opcion Valida";
                            break;
                        }
                    }
                    
                }               
            
                break;
            case '2':
                $num = Interaccion("Indique el numero Identificador");
                $viaje = new viaje();
                if(!Comparar($viaje,$num)){
                    
                    echo "\n1) Datos de la ID Viaje\n";
                    echo "\n2) Datos de la Destino\n";
                    echo "\n3) Datos de la Capacidad Maxima\n";
                    echo "\n4) Datos de la Documentos\n";
                    echo "\n5) Datos de la ID Empresa\n";
                    echo "\n6) Datos de la Responsable del Viaje\n";
                    echo "\n7) Datos de la Importe\n";
                    echo "\n8) Datos de la Tipo de Asiento\n";
                    echo "\n9) Datos de la Ida y Vuetos\n";
                    $opc = trim(fgets(STDIN));
                  while ($opc < 10)
                  { switch ($opc) {
                        case '2':                            
                           $viaje->setVdestino(Interaccion("Ingrese el nuevo dato"));
                           if($viaje->ModificarViaje()){
                            echo $viaje;
                           }
                            break;
                        case '3':
                           $viaje->setVcantmaxpasajeros(Interaccion("Ingrese el nuevo dato"));
                           if($viaje->ModificarViaje()){
                            echo $viaje;
                           }
                            break;
                        case '1':
                            
                           $viaje->setId(Interaccion("Ingrese el nuevo dato"));
                           $dataViaje = $viaje->getobjResponsable();
                           $dataViaje2= $viaje->getobjEmpresa();
                           $viaje->Cargar($viaje->getId(),$viaje->getVdestino(),$viaje->getVcantmaxpasajeros(),$viaje->getVimporte(),$viaje->getTipoAsiento(),$viaje->getIdayvuelta());
                           
                           $viaje->setobjEmpresa($dataViaje2);
                           $viaje->setId($num);
                           $viaje->EliminarViaje();
                            break;
                        case '4':
                         
                           break;
                        case '5':
                            $viaje->setobjEmpresa(Interaccion("Ingrese el nuevo dato"));
                           if($viaje->ModificarViaje()){
                            echo $viaje;
                           }break;
                           case '6':
                            $viaje->setobjResponsable(Interaccion("Ingrese el nuevo dato"));
                           if($viaje->ModificarViaje()){
                            echo $viaje;
                           }
                            break;
                        case '7':
                            $viaje->setVimporte(Interaccion("Ingrese el nuevo dato"));
                           if($viaje->ModificarViaje()){
                            echo $viaje;
                           }
                            break;
                        case '8':
                            $viaje->setTipoAsiento(Interaccion("Ingrese el nuevo dato"));
                           if($viaje->ModificarViaje()){
                            echo $viaje;
                           }
                            break;
                        case '9':
                            $viaje->setIdayvuelta(Interaccion("Ingrese el nuevo dato"));
                           if($viaje->ModificarViaje()){
                            echo $viaje;
                           }
                            break;
                        
                        
                        default:
                           echo "Ingrese una opcion Valida";
                            break;
                        }
                    }
                    
                }
                
                break;
         }

        $numPasajero = Interaccion("Indique el numero Identificador");
        if(!Comparar($pasajero,$numPasajero)){
            echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";

            echo "\nDato que desea modificar \n";
            echo "\n1) Modificar nombre \n";//Permite settear el atributo con la clave correspondiente al nombre del objeto
            echo "\n2) Modificar apellido \n";//Permite settear el atributo con la clave correspondiente al apellido del objeto
            echo "\n3) Modificar numero de DNI \n";//Permite settear el atributo con la clave correspondiente al DNI del objeto
            echo "\n4) Modificar numero de Telefono \n";//Permite settear el atributo con la clave correspondiente al Numero de telefono del objeto
            echo "\n5) Volver al menu anterior \n";
            $opcModificacion =trim(fgets(STDIN));  
            switch ($opcModificacion) {
                case '1':
                    # code...
                    break;
                
                default:
                    # code...
                    break;
            }  

        }


        switch ($opc) {
            case '1':
                echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";

                echo "\nDato que desea modificar \n";
                echo "\n1) Modificar nombre \n";//Permite settear el atributo con la clave correspondiente al nombre del objeto
                echo "\n2) Modificar apellido \n";//Permite settear el atributo con la clave correspondiente al apellido del objeto
                echo "\n3) Modificar numero de DNI \n";//Permite settear el atributo con la clave correspondiente al DNI del objeto
                echo "\n4) Modificar numero de Telefono \n";//Permite settear el atributo con la clave correspondiente al Numero de telefono del objeto
                echo "\n5) Volver al menu anterior \n";
                $opcModificacion =trim(fgets(STDIN));                       
      
            switch ($opcModificacion) 
                {
                    case '1':
                        echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";
          
                        $numPasajero = Interaccion("Indique el numero del dni del pasajero");
                            
                        $nuevoNombre = Interaccion("Ingrese el nuevo Nombre");
                        $pasajero = new pasajero();
                       if(!Comparar($pasajero,$numPasajero)){
                            $pasajero->setPnombre($nuevoNombre);
                            if($pasajero->ModificarPasajero()){
                            echo $pasajero;
                            }else{
                            echo $pasajero->getmensajeoperacion();
                            }

                        }else{ 
                            echo"\n No esta ese pasajero\n";
                        }


                      
                      

                       
                                                                  
                        break;
                    case '2':
                        echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";
          
                        $numPasajero = Interaccion("Indique el numero del pasajero");
        
                        $nuevoApellido =Interaccion("Ingrese el nuevo Apellido");

                        //$objPasajero = $objViaje->getObjPersona()[$numPasajero - 1]; 

                        if($objPasajero->CambiarDatos("apellido",$nuevoApellido)){
                            echo "\n La modificacion se realiazo con exito\n";
                        }
                        
                    
                        break;
                    case '3':
                        echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";
      
                        $numPasajero = Interaccion("Indique el numero del pasajero");

                        $nuevoDNI = Interaccion("Ingrese el nuevo numero de DNI");

                       // $objPasajero = $objViaje->getObjPersona()[$numPasajero - 1]; 

                        if($objPasajero->CambiarDatos("DNI",$nuevoDNI)){
                            echo "\n La modificacion se realiazo con exito\n";
                        }
                            
                        break;
                    
                    case '4':
                        echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";
      
                        $numPasajero = Interaccion("Indique el numero del pasajero");
           
                        $nuevoPhonePasajero = Interaccion("Ingrese el nuevo numero de Telefono");

                       // $objPasajero = $objViaje->getObjPersona()[$numPasajero - 1]; 

                        if($objPasajero->CambiarDatos("Telefono",$nuevoPhonePasajero)){
                            echo "\n La modificacion se realiazo con exito\n";
                        }
                        break;
                    case '5':
                        $opcModificacion = 6;
                        break;    
                        
                    default:
                        echo "\nIngrese una opcion correcta\n";
                        break; 
                
          
        }

        break;
    default:
        # code...
        break;
    }
}

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


/* foreach($x as $empresa){
    $arreglo = Coleccion(new viaje(),$empresa->getId());
    $empresa->setColObj($arreglo); 
    echo "-------------------------------------\n";
    echo $empresa;
} */