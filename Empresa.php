<?php

class empresa{

    private $idempresa;
    private $enombre;
    private $edireccion;
    private $mensajeoperacion;

    public function __construct($id,$nombre,$direccion)
    {
        $this->idempresa = $id;
        $this->enombre = $nombre;
        $this->edireccion = $direccion;        
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
     * Get the value of enombre
     */ 
    public function getEnombre()
    {
        return $this->enombre;
    }

    /**
     * Set the value of enombre
     *
     * @return  self
     */ 
    public function setEnombre($enombre)
    {
        $this->enombre = $enombre;

        return $this;
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
     *
     * @return  self
     */ 
    public function setEdireccion($edireccion)
    {
        $this->edireccion = $edireccion;

        return $this;
    }

    public function getmensajeoperacion(){
		return $this->mensajeoperacion ;
	}

    public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

    public function __toString()
    {
        $str = "\n{$this->getEnombre()}.\n{$this->getIdempresa()}.\n{$this->getEdireccion()}.\n";
        
        return $str;
    }


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
                if($fila=$base->Registro()){                    
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