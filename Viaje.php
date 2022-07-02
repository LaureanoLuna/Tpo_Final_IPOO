<?php

class viaje{

    private $id;
    private $vdestino;
    private $vcantmaxpasajeros;
    private $vimporte;
    private $tipoAsiento;
    private $idayvuelta;  
    private $colObjPasajero;
    private $objEmpresa;
    private $objResponsable;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->id = "";
        $this->vdestino = "";
        $this->vcantmaxpasajeros = "";       
        $this->vimporte = "";
        $this->tipoAsiento = "";
        $this->idayvuelta = "";        
        $this->objEmpresa = new empresa;
        $this->colObjPasajero=[];
        $this->objResponsable = new responsable;
    }

    public function Cargar($destino,$cantMaxPasajeros,$importe,$tipoAsiento,$idayvuelta)
    {
        
        $this->setVdestino($destino);
        $this->setVcantmaxpasajeros($cantMaxPasajeros);
        $this->setVimporte($importe);
        $this->setTipoAsiento($tipoAsiento);
        $this->setIdayvuelta($idayvuelta);
    }

    //***********************************************
    // Metodos de acceso a los atributos de la clase
    //************************************************

    // Getters y Setters

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of vdestino
     */ 
    public function getVdestino()
    {
        return $this->vdestino;
    }

    /**
     * Set the value of vdestino
     *
     * @return  self
     */ 
    public function setVdestino($vdestino)
    {
        $this->vdestino = $vdestino;
    }

    /**
     * Get the value of vcantmaxpasajeros
     */ 
    public function getVcantmaxpasajeros()
    {
        return $this->vcantmaxpasajeros;
    }

    /**
     * Set the value of vcantmaxpasajeros
     *
     * @return  self
     */ 
    public function setVcantmaxpasajeros($vcantmaxpasajeros)
    {
        $this->vcantmaxpasajeros = $vcantmaxpasajeros;
    }

    

    /**
     * Get the value of objEmpresa
     */ 
    public function getobjEmpresa()
    {
        return $this->objEmpresa;
    }

    /**
     * Set the value of objEmpresa
     *
     * @return  self
     */ 
    public function setobjEmpresa($objEmpresa)
    {
        $this->objEmpresa = $objEmpresa;
    }

    /**
     * Get the value of objResponsable
     */ 
    public function getobjResponsable()
    {
        return $this->objResponsable;
    }

    /**
     * Set the value of objResponsable
     *
     * @return  self
     */ 
    public function setobjResponsable($objResponsable)
    {
        $this->objResponsable = $objResponsable;
    }

    /**
     * Get the value of vimporte
     */ 
    public function getVimporte()
    {
        return $this->vimporte;
    }

    /**
     * Set the value of vimporte
     *
     * @return  self
     */ 
    public function setVimporte($vimporte)
    {
        $this->vimporte = $vimporte;
    }

    /**
     * Get the value of tipoAsiento
     */ 
    public function getTipoAsiento()
    {
        return $this->tipoAsiento;
    }

    /**
     * Set the value of tipoAsiento
     *
     * @return  self
     */ 
    public function setTipoAsiento($tipoAsiento)
    {
        $this->tipoAsiento = $tipoAsiento;
    }

    /**
     * Get the value of idayvuelta
     */ 
    public function getIdayvuelta()
    {
        return $this->idayvuelta;
    }

    /**
     * Set the value of idayvuelta
     *
     * @return  self
     */ 
    public function setIdayvuelta($idayvuelta)
    {
        $this->idayvuelta = $idayvuelta;
    }

     /**
     * Get the value of colObjPasajero
     */ 
    public function getColObjPasajero()
    {
        return $this->colObjPasajero;
    }

    /**
     * Set the value of colObjPasajero
     *
     * @return  self
     */ 
    public function setColObjPasajero($colObjPasajero)
    {
        $this->colObjPasajero = $colObjPasajero;
     }

     /**
     * Get the value of mensajeoperacion
     */ 
    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    /**
     * Set the value of mensajeoperacion
     *
     * @return  self
     */ 
    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function __toString()
    {
        $str = "\nN° Viaje ".$this->getId()."\nDestino ".$this->getVdestino()."\nCapacidad Max ".$this->getVcantmaxpasajeros().
        "\nValor pasaje ".$this->getVimporte()."\nButacas ".$this->getTipoAsiento()."\nTipo Viaje ".$this->getIdayvuelta()."\n\nEmpresa: ".$this->getobjEmpresa()."\n\n N° Reponsable ".$this->getobjResponsable();
        return $str;
    }

    /**
     * Metodo para ingresar una nueva tupla a la tabla Viaje
     * @return bool
     */

    public function IngresarViaje()
    {
        $base = new BaseDatos();
        $consulta = "INSERT INTO viaje(vdestino, vcantmaxpasajeros, vimporte, tipoAsiento, idayvuelta, idempresa, rnumeroempleado) VALUES ('".$this->getVdestino()."','".$this->getVcantmaxpasajeros()."','".$this->getVimporte()."','".$this->getTipoAsiento()."','".$this->getIdayvuelta()."','".$this->getobjEmpresa()->getId()."','".$this->getobjResponsable()->getId().")";
        $bool = false;
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $bool = true;
            }else{
                $this->setMensajeoperacion($base->getError());
            }
        }else{
            $this->setMensajeoperacion($base->getError());
        }
        return $bool;
    }   

    // Metodo para modificar la una tupla de la tabla Viaje

    /**
     * @return bool
     */

    public function ModificarViaje()
    {
        $base = new BaseDatos();
        $bool = false;
        $consulta = "UPDATE viaje SET vdestino='".$this->getVdestino()."',vcantmaxpasajeros='". $this->getVcantmaxpasajeros()."',vimporte='". $this->getVimporte()."',tipoAsiento='". $this->getTipoAsiento()."',idayvuelta='". $this->getIdayvuelta()."'idempresa='".$this->getobjEmpresa()->getId()."'rnumeroempleado='".$this->getobjResponsable()->getId()."' WHERE idviaje=". $this->getId();
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){               
                $bool = true;            
            }else{
                $this->setMensajeoperacion($base->getError());
            }
        }else{
            $this->setMensajeoperacion($base->getError());
        }
        return $bool;
    }


    //Metodo para eliminar un tupla de la tabla Viaje
    /**
     * @return bool
     */
    public function EliminarViaje()
    {       
        $base= new BaseDatos();
        $bool = false;
        if($base->Iniciar()){
            $consulta = "DELETE FROM viaje WHERE idviaje=".$this->getId();
            if($base->Ejecutar($consulta)){
                $bool = true;
            }else{
                $this->setMensajeoperacion($base->getError());
            }
        }else{
            $this->setMensajeoperacion($base->getError());
        }

        return $bool;
    }


    //Metodo para listar todas las tuplas que cumplan una condicion o todas las tuplas si es que no hay condicion alguna
    /**
     * @param string $condicion
     * @return array
     */ 

    public function Listar($condicion="")
    {
        $arregloViaje=null;
        $base = new BaseDatos;
        $consulta = "SELECT * FROM viaje ";
        if($condicion != ""){
            $consulta.=" WHERE ". $condicion;
        }
        /* $consulta .= "ORDER BY idviaje"; */
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
               
                while($fila=$base->Registro()){
                    $objViaje = new viaje();
                    $objEmp = new empresa();
                    $objRes = new responsable();
                    $objViaje->setId($fila['idviaje']);
                    $objViaje->Cargar($fila['vdestino'],$fila['vcantmaxpasajeros'],$fila['vimporte'],$fila['tipoAsiento'],$fila['idayvuelta']);
                    $objViaje->setobjEmpresa($objEmp->BuscarEmpresa($fila['idempresa']));
                    $objViaje->setobjResponsable($objRes->BuscarResponsable($fila['rnumeroempleado']));
                
                    $arregloViaje[]= $objViaje;
                }
            }else{
                $this->setMensajeoperacion($base->getError());
            }
        }else{
            $this->setMensajeoperacion($base->getError());
        }

        return $arregloViaje;
    }

    // Metodo para buscar una tupla con la clave primaria de la tabla Viaje
    /**
     * @param int $id
     * @return bool
     */
    public function BuscarViaje($id)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM viaje WHERE idviaje= ".$id;
        $bool = false;

        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                if($fila=$base->Registro()){
                    $objEmp = new empresa();
                    $objRes = new responsable();
                    $this->setId($id);
                    $this->setVdestino($fila['vdestino']);
                    $this->setVcantmaxpasajeros($fila['vcantmaxpasajeros']);                   
                    $this->setVimporte($fila['vimporte']);
                    $this->setTipoAsiento($fila['tipoAsiento']);
                    $this->setIdayvuelta($fila['idayvuelta']);
                    $this->setobjEmpresa($objEmp->BuscarEmpresa($fila['idempresa']));
                    $this->setobjResponsable($objRes->BuscarResponsable($fila['rnumeroempleado']));
                    $bool = true;
                }
            }else{
                $this->setMensajeoperacion($base->getError());
            }
        }else{
            $this->setMensajeoperacion($base->getError());
        }

        return $bool;
    }

    
   

   

   
}