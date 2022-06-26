<?php
include('BaseDatoss.php');
include('ResponsableV.php');
include('Empresa.php');
include('Pasajero.php');
include('Viaje.php');
 /****************************************************************************/
        /******************** TEST DE PRUEBA ***********************/
 /****************************************************************************/

function Menu()
{
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
    return $opc;
}





switch (Menu()) {
    case '1':
        echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";

        $codViaje = Interaccion("Codigo identificatorio de Viaje");

        $destino = Interaccion("Ingrese el Destino");

        $capacidadViaje = Interaccion("Capacidad de pasajeros");

        $doc = Interaccion("Ingrese la documentacion");

        $importe = Interaccion("Ingrese el importe");
        
        $tipoAsiento = Interaccion("¿Cama o Semi Cama?");

        $idayVuelta = Interaccion("¿Solo Ida?");

        
        $objEmpresa = new empresa();
        $opcEmpresa = MostrarOpciones($objEmpresa);
        $objResponsable = new responsable();
        $opcRespo = MostrarOpciones($objResponsable); 
       
       
        if(!$objViaje->BuscarViaje($codViaje)){

            if ($objViaje->IngresarViaje()){
               
                $objViaje = new viaje();
                $objViaje->Cargar($codViaje, $destino, $capacidadViaje,$doc,$importe,$tipoAsiento, $idayVuelta);
                $objViaje->setIdempresa($opcEmpresa);
                $objViaje->setRnumeroempleado($opcRespo);
            
                echo "\n El viaje se guardo correctamente \n";
              
            }
        }
        break;
    case '2':
        
        $objViaje = new viaje();
        
        $opc = MostrarOpciones($objViaje);
        echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";
        echo "\nIngresar los datos del Pasajero\n";
        echo "\n○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•○•\n";

        $nomPasajero =Interaccion("Nombre");

        $apellidoPasajero =Interaccion("Apellido");

        $dniPasajero =Interaccion("Numero de DNI");
    
        $numTelefono =Interaccion("Numero de Telefono");
       

        
        $objPasajero = new pasajero();
        
        if (Comparar($objPasajero,$dniPasajero)){

            
            $objPasajero->Cargar($nomPasajero, $apellidoPasajero, $dniPasajero, $numTelefono);
            $objPasajero->setIdviaje($opc);
            echo $objPasajero;
            if($objPasajero->AgregarPasajero()){
                echo "\nEl pasajero se cargo correctamente\n";
            }
            
        }else{
            echo "\n El Pasajero ya fue registrado";
            $objPasajero->Buscar($dniPasajero);
            $idviaje= $objPasajero->getIdviaje();
            
            if ( $idviaje != ""){
                echo "\n En el viaje \n";
                 $objViaje->BuscarViaje($idviaje);
                 echo $objViaje;
            }
            else{
                echo "\nNo tiene un viaje asignado\n";
            }

         
        }
        

        
        break;
    default:
        # code...
        break;
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



function MostrarOpciones($obj)
{
    $arregloObj = $obj->Listar();
    foreach ($arregloObj as $x ) {
        echo "-------------------------------------------------------------\n";
        echo $x;
    }
    echo "\n/////////////////////////////////////////////////////\n";
    $opc = Interaccion("Elija una opcion");

    
    return $opc;   
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