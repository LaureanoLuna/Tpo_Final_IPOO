<?php

class responsable{

    private $rnumeroempleado;
    private $rnumerolicencia;
    private $rnombre;
    private $rapellido;
    private $mensajeoperacion;

    public function __construct($rnumeroempleado, $rnumerolicencia, $nomEmpleado, $rapellidoEmpleado)
    {
        $this->rnumeroempleado = $rnumeroempleado;
        $this->rnumerolicencia = $rnumerolicencia;
        $this->rnombre = $nomEmpleado;
        $this-> rapellido = $rapellidoEmpleado;
        $this->mensajeoperacion = "";
    }

    //Metodos de accese a los atributos



    public function getrnumeroempleado()
    {
        return $this->rnumeroempleado;
    }

    public function getrnumerolicencia()
    {
        return $this->rnumerolicencia;
    }

    public function getrnombre()
    {
        return $this->rnombre;
    }

    public function getrapellido()
    {
        return $this->rapellido;
    }

    public function setrnumeroempleado($rnumeroempleado)
    {
        $this->rnumeroempleado = $rnumeroempleado;
        return $this;
    }
    
    public function setrnumerolicencia($rnumerolicencia)
    {
        $this->rnumerolicencia = $rnumerolicencia;
        return $this;
    }

    public function setrnombre($rnombre)
    {
        $this->rnombre = $rnombre;
        return $this;
    }

    public function setrapellido($rapellido)
    {
        $this->rapellido = $rapellido;
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
        $str = "\nDatos del Responsable de Viaje: \n
                rnombre: ".$this->getrnombre()."\n
                rapellido: ". $this->getrapellido()."\n
                Legajo: ". $this->getrnumerolicencia()."\n
                Numero Identificatorio del Empleado: ". $this->getrnumeroempleado()."\n\n";

        return $str;
    }


    public function BuscarResponsable($id)
{
    $base = new BaseDatos();
    $consulta = "select * from responsable where  rnumeroempleado = ".$id;
    $resp = false;
    if($base->Iniciar()){
       if($base->Ejecutar($consulta)){
        if($fila2 = $base->Registro()){
            $this->setrnumeroempleado($id);
            $this->setrnombre($fila2['rnombre']);
            $this->setrapellido($fila2['rapellido']);
            $this->setrnumerolicencia($fila2['rnumerolicencia']);
            $resp = true;
        }

       }else{
            $this->setMensajeoperacion($base->getError());
       }
    }else{
        $this->setMensajeoperacion($base->getError());
   }
   return $resp;
}

public function AgregarResponsable(){
    $base = new BaseDatos();
    $bool = false;
    $consulta = "INSERT INTO responsable(rnumeroempleado,rnumerolicencia,rnombre,rapellido) VALUES (33,3543,'Laureano','Luna')";
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

}
   
?>