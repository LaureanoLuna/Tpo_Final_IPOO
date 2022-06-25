<?php 

    /** Clase Persona , tiene un atributo el cual es un arreglo con las claves: nombre, apellido, DNI.
    * correspondiendo a los datos ingresados para identificar al objeto Persona
    */
    class pasajero{

        private $pnombre;
        private $papellido;
        private $rdocumento;
        private $ptelefono;  
        private $idviaje; 

    
            /**
             * Implementamos el metodo Constructor del objeto
             * @param string $pnombre
             * @param string $papellido
             * @param int $rdocumento
             * @param string $ptelefono
             * @param int $idviaje             * 
             */

        public function __construct($nomPers, $apellidoPers, $dniPersona, $numTelefono)
        {
           $this->pnombre = $nomPers;
           $this->papellido = $apellidoPers;
           $this->rdocumento = $dniPersona;
           $this->ptelefono = $numTelefono;
           $this->idviaje ;
        }

          
        //***********************************************
        // Metodos de acceso a los atributos de la clase
        //************************************************
        
        // Getters y Setters

        /**
         * Get the value of pnombre
         */ 
        public function getPnombre()
        {
                return $this->pnombre;
        }

        /**
         * Set the value of pnombre
         *
         * @return  self
         */ 
        public function setPnombre($pnombre)
        {
                $this->pnombre = $pnombre;

                return $this;
        }

        /**
         * Get the value of papellido
         */ 
        public function getPapellido()
        {
                return $this->papellido;
        }

        /**
         * Set the value of papellido
         *
         * @return  self
         */ 
        public function setPapellido($papellido)
        {
                $this->papellido = $papellido;

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
         * Get the value of ptelefono
         */ 
        public function getPtelefono()
        {
                return $this->ptelefono;
        }

        /**
         * Set the value of ptelefono
         *
         * @return  self
         */ 
        public function setPtelefono($ptelefono)
        {
                $this->ptelefono = $ptelefono;

                return $this;
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

        
	public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

        
	public function getmensajeoperacion(){
		return $this->mensajeoperacion;
	}

     

       
        /**Metodo implemetado para poder mostrar los datos de dicho objeto */
        public function __toString()
        {
            $str = " Nombre: ".$this->getPnombre().
            "\n Apellido: ".$this->getPapellido().
            "\n Numero de DNI: ".$this->getRdocumento().
            "\n Numero de Telefono: ".$this->getPtelefono()."\n";
            return $str;
        }


        public function AgregarPasajero()
        {
                $base = new BaseDatos;
                $bool = false;
                $consulta ="INSERT INTO pasajero(rdocumento,pnombre,papellido,ptelefono) 
                VALUES (".$this->getRdocumento().",'".$this->getPnombre()."','".$this->getPapellido()."','".$this->getPtelefono()."')";
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


        public function ModificarPasajero()
        {
                $base = new BaseDatos;
                $bool = false;
                $consulta = "UPDATE pasajero SET papellido='".$this->getPapellido()."',pnombre='".$this->getPnombre()."',ptelefono='".$this->getPtelefono()."',idviaje='".$this->getIdviaje()."' WHERE rdocumento=". $this->getRdocumento();
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

        public function eliminar(){
                $base = new BaseDatos();
                $resp = false;
                if ($base->Iniciar()){
                        $consulta = "DELETE FROM pasajero WHERE rdocumento= ". $this->getRdocumento();
                        if($base->Ejecutar($consulta)){
                                $resp = true;
                        }else{
                                $this->setmensajeoperacion($base->getError());
                        }
                }else{
                        $this->setmensajeoperacion($base->getError());
                }
                return $resp;
        }

        public function Listar($condicion=""){
                $arregloPasajero = null;
                $objBase = new BaseDatos();
                $consulta="SELECT * FROM pasajero ";
                if ($condicion != ""){
                        $consulta.=' WHERE '. $condicion;
                }
                $consulta+="ORDER BY apellido ";
                if ($objBase->Iniciar()){
                        if($objBase->Ejecutar($consulta)){
                                $arregloPasajero=[];
                                while($fila=$objBase->Registro()){

                                        $dni=$fila['rdocumento'];
                                        $nombre=$fila['pnombre'];
                                        $apellido=$fila['papellido'];
                                        $tel=$fila['ptelefono'];
                                        $idviaje=$fila['idviaje'];
                                        $pasajero=new pasajero($nombre,$apellido,$dni,$tel);
                                        $pasajero->setIdviaje($idviaje);
                                        $arregloPasajero[] = $pasajero;
                                }
                        }else {
                                $this->setmensajeoperacion($objBase->getError());
                        }
                }else {
                        $this->setmensajeoperacion($objBase->getError());
                }

                return $arregloPasajero;
        }

        public function Buscar($dni)
        {
                $base = new BaseDatos();
                $consulta = "SELECT * FROM pasajero WHERE rdocumento=".$dni;
                $resp = false;
                if ($base->Iniciar()){
                        if($base->Ejecutar($consulta)){
                                if($fila=$base->Registro()){
                                        $this->setRdocumento($dni);
                                        $this->setPnombre($fila['pnombre']);
                                        $this->setPapellido($fila['papellido']);
                                        $this->setPtelefono($fila['ptelefono']);
                                        $this->setIdviaje($fila['idviaje']);
                                        $resp = true;
                                }else {
                                        $this->setmensajeoperacion($base->getError());
                                }
                        }else {
                                $this->setmensajeoperacion($base->getError());
                        }

                }
                
                return $resp;
        }
}