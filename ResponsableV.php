<?php

include_once ('BaseDatoss.php');

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


    /**
	 * Recupera los datos de una persona por dni
	 * @param int $dni
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($legajo){
		$base=new BaseDatos();
		$consultaPersona="Select rnombre from responsable where id=".$legajo;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){					
				    $this->setrnumerolicencia($legajo);
					$this->setrnombre($row2['nombre']);
					$this->setrapellido($row2['apellido']);
					$this->setrnumeroempleado($row2['dni']);
					$resp= true;
				}else {
		 			$this->setmensajeoperacion($base->getError()); 
                }
		 		
			}else {
		 		$this->setmensajeoperacion($base->getError()); 
            }
	
         		
		 return $resp;

        }
    }

}

$obj= new responsable(15,1555,'Laurea','Luna');

$x = $obj->Buscar(1555);
echo $x;

?>