<?php

class empresa{

    private $idempresa;
    private $enombre;
    private $edireccion;
    private $mensajeoperacion;

    /**
     * Implementamos el metodo constructor de la clase
     * @param int $id
     * @param string $nombre
     * @param string $direccion
     */

    public function __construct($id,$nombre,$direccion)
    {
        $this->idempresa = $id;
        $this->enombre = $nombre;
        $this->edireccion = $direccion;        
    }

    
    //***********************************************
    // Metodos de acceso a los atributos de la clase
    //************************************************

    // Getters y Setters

    /**
     * Get the value of idempresa
     */ 
    public function getIdempresa()
    {
        return $this->idempresa;
    }

    /**
     * Set the value of idempresa
     */ 
    public function setIdempresa($idempresa)
    {
        $this->idempresa = $idempresa;
    }

    /**
     * Get the value of enombre
     */ 
    public function getEnombre()
    {
        return $this->enombre;
    }

    /**
     * Set the value of enombre
     */ 
    public function setEnombre($enombre)
    {
        $this->enombre = $enombre;
    }

    /**
     * Get the value of edireccion
     */ 
    public function getEdireccion()
    {
        return $this->edireccion;
    }

    /**
     * Set the value of edireccion
     */ 
    public function setEdireccion($edireccion)
    {
        $this->edireccion = $edireccion;
    }

    /**
     * get the value of mensajeoperacion
     */
    public function getmensajeoperacion(){
		return $this->mensajeoperacion ;
	}

    /**
     * Se the value of mensajeoperacion
     */
    public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

    public function __toString()
    {
        $str = "\n{$this->getEnombre()}.\n{$this->getIdempresa()}.\n{$this->getEdireccion()}.\n";
        
        return $str;
    }

    // Metodo para ingresar una nueva tupla a la tabla Empresa
    /**
     * @return bool
     */
    public function IngresarEmpresa()
    {
        $base = new BaseDatos;
        $bool = true;
        $consulta= "INSERT INTO empresa (idempresa,enombre,edireccion) VALUES (".$this->getIdempresa().",'".$this->getEnombre()."','".$this->getEdireccion()."')";
        if ($base->Iniciar()){
            if ($base->Ejecutar($consulta)){
                $bool = true;
            }else{
                $this->setmensajeoperacion($base->getError());
            }
        }else{
            $this->setmensajeoperacion($base->getError());
        }

        return $bool;
    }

    /**
     * Metodo para modificar una tupla de la tabla de Empresa
     * @return bool
     */
    public function ModificarEmpresa()
    {
        $base = new BaseDatos;
        $bool = false;
        $consulta = "UPDATE empresa SET idempresa='".$this->getIdempresa()."',enombre='".$this->getEnombre()."',edireccion='".$this->getEdireccion()."' WHERE idempresa=". $this->getIdempresa();
        if ($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $bool = true;
            }else{
                $this->setmensajeoperacion($base->getError());
            }
        }else{
            $this->setmensajeoperacion($base->getError());
        }
        return $bool;
    }

    /**
     * Metodo para eliminar una tupla de la tabla de Empresa
     * @return bool
     */

    public function EliminarEmpresa()
    {
        $base = new BaseDatos;
        $bool = false;
        $consulta = "DELETE FROM empresa WHERE idempresa=". $this->getIdempresa();
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $bool = true;
            }else{
                $this->setmensajeoperacion($base->getError());
            }
        }else{
            $this->setmensajeoperacion($base->getError());
        }

        return $bool;
    }

    /**
     * Metodo para buscar una tupla en la tabla de Empresa, esto es por medio de la clave primaria que es ingresa por parametro
     * @param int $idEmpresa (PRIMARY KEY de al tupla a buscar)
     * @return bool
     */
    public function BuscarEmpresa($idEmpresa)
    {
        $base= new BaseDatos();
        $consulta = "SELECT * FROM empresa WHERE idempresa=" .$idEmpresa;
        $resp = false;
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                if($fila=$base->Registro()){
                    $this->setIdempresa($idEmpresa);
                    $this->setEnombre($fila['enombre']);
                    $this->setEdireccion($fila['edireccion']);
                    $resp = true;
                }

            }else{
                $this->setmensajeoperacion($base->getError());
            }
        }else{
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    /**
     * Metodo para en listar todas las tuplas de la tabla de Empresa
     * puede realizarla de manera completa o por medio de una condicion ingresada por parametro
     * retornadolas en un arreglo
     * @param string $condicion
     * @return array 
     */

    public function ListarEmpresa($condicion = "")
    {
        $arregloEmpresa = null;
        $base = new BaseDatos();
        $consulta = "SELECT * FROM empresa";
        if ($condicion != ""){
            $consulta.= " WHERE ". $condicion;
        }
         $consulta .= "ORDER BY enombre";

         if ($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $arregloEmpresa = array();
                while($fila=$base->Registro()){                    
                    $arregloEmpresa[]= new empresa($fila['idempresa'],$fila['enombre'],$fila['edireccion']);
                }
            } else{
                $this->setmensajeoperacion($base->getError());
            }

         }else{
            $this->setmensajeoperacion($base->getError());
         }
         return $arregloEmpresa;
    }
   
}