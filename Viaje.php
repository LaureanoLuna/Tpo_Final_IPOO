<?php

class viaje{

    private $idviaje;
    private $vdestino;
    private $vcantmaxpasajeros;
    private $rdocumento;
    private $idempresa;
    private $rnumeroempleado;
    private $vimporte;
    private $tipoAsiento;
    private $idayvuelta;
    private $mensajeoperacion;

    public function __construct($id,$destino,$cantMaxPasajeros,$documento,$importe,$tipoAsiento,$idayvuelta)
    {
        $this->idviaje = $id;
        $this->vdestino = $destino;
        $this->vcantmaxpasajeros = $cantMaxPasajeros;
        $this->rdocumento = $documento;
        $this->vimporte = $importe;
        $this->tipoAsiento = $tipoAsiento;
        $this->idayvuelta = $idayvuelta;
        $this->idempresa = null;
        $this->rnumeroempleado = null;
    }

    //***********************************************
    // Metodos de acceso a los atributos de la clase
    //************************************************

    // Getters y Setters

    /**
     * Get the value of idviaje
     */ 
    public function getIdviaje()
    {
        return $this->idviaje;
    }

    /**
     * Set the value of idviaje
     *
     * @return  self
     */ 
    public function setIdviaje($idviaje)
    {
        $this->idviaje = $idviaje;

        return $this;
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

        return $this;
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

        return $this;
    }

    /**
     * Get the value of rdocumento
     */ 
    public function getRdocumento()
    {
        return $this->rdocumento;
    }

    /**
     * Set the value of rdocumento
     *
     * @return  self
     */ 
    public function setRdocumento($rdocumento)
    {
        $this->rdocumento = $rdocumento;

        return $this;
    }

    /**
     * Get the value of idempresa
     */ 
    public function getIdempresa()
    {
        return $this->idempresa;
    }

    /**
     * Set the value of idempresa
     *
     * @return  self
     */ 
    public function setIdempresa($idempresa)
    {
        $this->idempresa = $idempresa;

        return $this;
    }

    /**
     * Get the value of rnumeroempleado
     */ 
    public function getRnumeroempleado()
    {
        return $this->rnumeroempleado;
    }

    /**
     * Set the value of rnumeroempleado
     *
     * @return  self
     */ 
    public function setRnumeroempleado($rnumeroempleado)
    {
        $this->rnumeroempleado = $rnumeroempleado;

        return $this;
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

        return $this;
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

        return $this;
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

        return $this;
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

        return $this;
    }

    public function __toString()
    {
        $str = "\n{$this->getIdviaje()}.\n{$this->getVdestino()}.\n{$this->getVcantmaxpasajeros()}.\n{$this->getRdocumento()}.\n{$this->getIdempresa()}.
        \n{$this->getRnumeroempleado()}.\n{$this->getVimporte()}.\n{$this->getTipoAsiento()}.\n{$this->getIdayvuelta()}.\n";
        return $str;
    }

    /**
     * Metodo para ingresar una nueva tupla a la tabla Viaje
     * @return bool
     */

    public function IngresarViaje()
    {
        $base = new BaseDatos();
        $consulta = "INSERT INTO viaje (idviaje,vdestino,vcantmaxpasajero,rdocumento,vimporte,tipoAsiento,idayvuelta) VALUES ({$this->getIdviaje()},{$this->getVdestino()},{$this->getVcantmaxpasajeros()},{$this->getRdocumento()},{$this->getVimporte()},{$this->getTipoAsiento()},{$this->getIdayvuelta()})";
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
        $consulta = "UPDATE viaje SET vdestino ={$this->getVdestino()},vcantmaxpasajero={$this->getVcantmaxpasajeros()},rdocumento={$this->getRdocumento()},vimporte={$this->getVimporte()},tipoAsiento={$this->getTipoAsiento()},idayvuelta={$this->getIdayvuelta()},idempresa={$this->getIdempresa()},rnumeroempleado={$this->getRnumeroempleado()} WHERE idviaje={$this->getIdviaje()}";
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
            $consulta = "DELETE FROM viaje WHERE idviaje={$this->getIdviaje()}";
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

    public function ListarViaje($condicion="")
    {
        $arregloViaje=null;
        $base = new BaseDatos;
        $consulta = "SELECT * FROM viaje ";
        if($condicion != ""){
            $consulta.="WHERE ". $condicion;
        }
        $consulta .= "ORDER BY vdestino";
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $arregloViaje=array();
                while($fila=$base->Registro()){
                    $objViaje = new viaje($fila['idviaje'],$fila['vdestino'],$fila['vcantmaxpasajeros'],$fila['rdocumento'],$fila['vimporte'],$fila['tipoAsiento'],$fila['idayvuelta']);
                    if($fila['idempresa'] != null){
                        $objViaje->setIdviaje($fila['idempresa']);
                    }
                    if($fila['rnumeroempleado'] != null){
                        $objViaje->setRnumeroempleado($fila['rnumeroempleado']);
                    }
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
     * @param int $idviaje
     * @return bool
     */
    public function BuscarViaje($idViaje)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM viaje WHERE idviaje={$this->getIdviaje()}";
        $bool = false;

        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                if($fila=$base->Registro()){
                    $this->setIdviaje($idViaje);
                    $this->setVdestino($fila['vdestino']);
                    $this->setVcantmaxpasajeros($fila['vcantmaxpasajeros']);
                    $this->setRdocumento($fila['rdocumento']);
                    $this->setVimporte($fila['vimporte']);
                    $this->setTipoAsiento($fila['tipoAsiento']);
                    $this->setIdayvuelta($fila['idayvuelta']);
                    $this->setIdempresa($fila['idempresa']);
                    $this->setRnumeroempleado($fila['rnumeroempleado']);
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