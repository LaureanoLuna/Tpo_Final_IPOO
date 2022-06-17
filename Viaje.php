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

    public function __construct($id,$destino,$cantMaxPasajeros,$documento,$importe,$tipoAsiento,$idayvuelta)
    {
        $this->idviaje = $id;
        $this->vdestino = $destino;
        $this->vcantmaxpasajeros = $cantMaxPasajeros;
        $this->rdocumento = $documento;
        $this->vimporte = $importe;
        $this->tipoAsiento = $tipoAsiento;
        $this->idayvuelta = $idayvuelta;
        $this->idempresa;
        $this->rnumeroempleado;
    }

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

    public function __toString()
    {
        $str = "\n{$this->getIdviaje()}.\n{$this->getVdestino()}.\n{$this->getVcantmaxpasajeros()}.\n{$this->getRdocumento()}.\n{$this->getIdempresa()}.
        \n{$this->getRnumeroempleado()}.\n{$this->getVimporte()}.\n{$this->getTipoAsiento()}.\n{$this->getIdayvuelta()}.\n";
        return $str;
    }
}