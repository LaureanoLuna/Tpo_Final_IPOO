<?php

class empresa{

    private $idempresa;
    private $enombre;
    private $edireccion;

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

    public function __toString()
    {
        $str = "\n{$this->getEnombre()}.\n{$this->getIdempresa()}.\n{$this->getEdireccion()}.\n";
        
        return $str;
    }
}