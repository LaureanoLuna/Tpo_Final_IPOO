<?php

class responsable{

    private $idresponsable;
    private $rnumerolicencia;
    private $rnombre;
    private $rapellido;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idresponsable;//$id;
        $this->rnumerolicencia ="";
        $this->rnombre ="";
        $this->rapellido ="";
        $this->mensajeoperacion = "";
    }

    public function Cargar($idresponsable, $rnumerolicencia, $nomEmpleado, $rapellidoEmpleado)
    {
        $this->setIdresponsable($idresponsable);
        $this->setrnumerolicencia($rnumerolicencia);
        $this->setrnombre($nomEmpleado);
        $this->setrapellido($rapellidoEmpleado);
    }

    
    //***********************************************
    // Metodos de acceso a los atributos de la clase
    //************************************************

    // Getters y Setters



    public function getIdresponsable()
    {
        return $this->idresponsable;
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

    public function setIdresponsable($idresponsable)
    {
        $this->idresponsable = $idresponsable;
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
        $str = 
        "\nDatos del Responsable de Viaje: \n
         Nombre: ".$this->getrnombre()."\n
         Apellido: ". $this->getrapellido()."\n
         Legajo: ". $this->getrnumerolicencia()."\n
         Numero Identificatorio del Empleado: ". $this->getIdresponsable()."\n\n";

        return $str;
    }

/**
 * Metodo para buscar una tupla de la tabla de Responsable, esto es por medio de la clave primaria ingresada por parametro
 * @param int $id (PRIMARY KEY de la tupla a buscar)
 * @return bool
 */
    public function BuscarResponsable($id)
{
    $base = new BaseDatos();
    $consulta = "select * from responsable where rnumeroempleado = ".$id;
    $resp = false;
    if($base->Iniciar()){
       if($base->Ejecutar($consulta)){
        if($fila2 = $base->Registro()){
            $this->setIdresponsable($id);
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

/**
 * Metodo para ingresar una nueva tupla a la tabla Responsable
 * @return bool
 */
public function AgregarResponsable(){
    $base = new BaseDatos();
    $bool = false;
    $consulta = "INSERT INTO responsable(rnumeroempleado,rnumerolicencia,rnombre,rapellido) VALUES (".$this->getIdresponsable().",'".$this->getrnumerolicencia()."','".$this->getrnombre()."','".$this->getrapellido()."')";
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


/**
 * Metodo para modificar una tupla de la tabla Responsable 
 * @return bool
 */
public function ModificarResponsable(){
    $bool = false;
    $base = new BaseDatos();
    $consulta="UPDATE responsable SET rapellido='".$this->getrapellido()."',rnombre='".$this->getrnombre()."',rnumerolicencia='".$this->getrnumerolicencia()."' WHERE rnumeroempleado=". $this->getIdresponsable();
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


/**
 * Metodo para eliminar una tupla de la tabla Responsable 
 * @return bool
 */
public function EliminarResponsable()
{
    $base= new BaseDatos;
    $bool = false;
    if($base->Iniciar()){
        $consulta = "DELETE FROM responsable WHERE rnumeroempleado=". $this->getIdresponsable();      
        if ($base->Ejecutar($consulta)){
            $bool = true;
        }else{
            $this->setMensajeoperacion($base->getError());
           
        }
    }else{
        $this->setMensajeoperacion($base->getError()); 
    }

    return $bool;
}

/**
 * Metodo para listar todas las tuplas de la tabla Responsable
 * puede ser de manera completa o limitada por una condicion ingresada por parametro
 * retornandolas en un arreglo
 * @param string $condicion
 * @return array
 */
public function Listar($condicion = "")
{
    $base = new BaseDatos();
    $arregloResponsable = null;
    $consulta = "SELECT * FROM responsable ";
    if($condicion !=""){
        $consulta.= "WHERE ".$condicion;
    }
    $consulta.=" ORDER BY rapellido";
    if($base->Iniciar()){
        if($base->Ejecutar($consulta)){
            $arregloResponsable = array();
            while($fila = $base->Registro()){
                $obj = new responsable();
                $obj->Cargar($fila['rnumeroempleado'],$fila['rnumerolicencia'],$fila['rnombre'],$fila['rapellido']);
                $arregloResponsable[]=$obj;
            }
        }else{
            $this->setMensajeoperacion($base->getError());
        }
    }else{
        $this->setMensajeoperacion($base->getError());
    }
    return $arregloResponsable;
}


}
   
?>