<?php 

    
    class pasajero{

        private $pnombre;
        private $papellido;
        private $idpasajero;
        private $ptelefono;  
        private $objViaje; 

    
          

        public function __construct()
        {
           $this->pnombre ="";
           $this->papellido = "";
           $this->idpasajero = "";
           $this->ptelefono ="";
           $this->objViaje = new viaje();
        }

          /**
             * Implementamos el metodo Cargar del objeto
             * @param string $pnombre
             * @param string $papellido
             * @param int $id
             * @param string $ptelefono
             * @param int $idviaje             
             */

        public function Cargar($nomPers, $apellidoPers, $dniPersona, $numTelefono)
        {
               $this->setPnombre($nomPers);
               $this->setPapellido($apellidoPers);
               $this->setIdpasajero($dniPersona);
               $this->seTptelefono($numTelefono);
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
         * Get the value of id
         */ 
        public function getIdpasajero()
        {
                return $this->idpasajero;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setIdpasajero($idpasajero)
        {
                $this->idpasajero = $idpasajero;

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
        public function getObjViaje()
        {
                return $this->objViaje;
        }

        /**
         * Set the value of idviaje
         *
         * @return  self
         */ 
        public function setObjViaje($objViaje)
        {
                $this->objViaje = $objViaje;
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
            $str = "****************************************
                \nNombre: ".$this->getPnombre().
                "\n Apellido: ".$this->getPapellido().
                "\n Numero de DNI: ".$this->getIdpasajero().
                "\n Numero de Telefono: ".$this->getPtelefono().
                "\n Viaje N?? ". $this->getObjViaje();
            return $str;
        }

        /**
         * Metodo para ingresar una nueva tupla a la tabla Pasajero
         * @return bool
         */
        public function AgregarPasajero()
        {
                $base = new BaseDatos;
                $bool = false;
                $consulta ="INSERT INTO pasajero(rdocumento,pnombre,papellido,ptelefono,idviaje) 
                VALUES ({$this->getIdpasajero()},'{$this->getPnombre()}','{$this->getPapellido()}',{$this->getPtelefono()},{$this->getObjViaje()->getIdviaje()})";
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
         * Metodo para modificar una tupla de la tabla Pasajero
         * @return bool
         */
        public function ModificarPasajero()
        {
                $base = new BaseDatos;
                $bool = false;
                
                $consulta = "UPDATE pasajero SET papellido='{$this->getPapellido()}',pnombre='{$this->getPnombre()}',ptelefono={$this->getPtelefono()},idviaje={$this->getObjViaje()->getIdviaje()} WHERE rdocumento=". $this->getIdpasajero();
                
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
         * Metodo para eliminar una tupla de la tabla de Pasajeros
         * @return bool
         */

        public function EliminarPasajero(){
                $base = new BaseDatos();
                $resp = false;
                if ($base->Iniciar()){
                        $consulta = "DELETE FROM pasajero WHERE rdocumento= ". $this->getIdpasajero();
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

        /**
         * Metodo para listar todas las tuplas de la Pasajero 
         * puede realizarla de manera completa o por medio de una condicion ingresada por parametro
         * retornadolas en un arreglo
         * @param string $condicion
         * @return array
         */

        public function Listar($condicion=""){
                $arregloPasajero = null;
                $objBase = new BaseDatos();
                $consulta="SELECT * FROM pasajero ";
                if ($condicion != ""){
                        $consulta.=' WHERE '. $condicion;
                }
                //$consulta.='ORDER BY rdocumento ';
                if ($objBase->Iniciar()){
                        if($objBase->Ejecutar($consulta)){
                                $arregloPasajero=[];
                                while($fila=$objBase->Registro()){
                                        $objViaje=new viaje;
                                        $pasajero=new pasajero;
                                        $dni=$fila['rdocumento'];
                                        $nombre=$fila['pnombre'];
                                        $apellido=$fila['papellido'];
                                        $tel=$fila['ptelefono'];
                                        $idviaje=$fila['idviaje'];
                                        $pasajero->Cargar($nombre,$apellido,$dni,$tel);
                                        $objViaje->BuscarViaje($idviaje);
                                        $pasajero->setObjViaje($objViaje);
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

        /**
         * Metodo para buscar un tupla de la tabla Pasajero, esto es por medio de la clave primaria ingresada por parametro
         * @param int $dni (PRIMARY KEY de la tupla a buscar)
         * @return bool
         * */

        public function Buscar($dni)
        {
                $base = new BaseDatos();
                $consulta = "SELECT * FROM pasajero WHERE rdocumento=".$dni;
                $resp = false;
                if ($base->Iniciar()){
                        
                        if($base->Ejecutar($consulta)){
                               
                                if($fila=$base->Registro()){
                                       
                                        $this->setIdpasajero($dni);
                                        $this->setPnombre($fila['pnombre']);
                                        $this->setPapellido($fila['papellido']);
                                        $this->setPtelefono($fila['ptelefono']);
                                        $objViaj = new viaje();
                                        $objViaj->BuscarViaje($fila['idviaje']);
                                        $this->setObjViaje($objViaj);
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

        public function BorrarMasivo($condicion)
        {
                $col = $this->Listar($condicion);

                foreach ($col as $key => $value) {
                        $value->EliminarPasajero();
                }
                
        }

        public function ValidadEsta($valor){
                $bool = true;
                $i = 0;
                $objPas = $this->Listar();
                while ($bool) {
                        if ($objPas[$i]->getIdpasajero() == $valor){
                                $bool = false;
                        }                     
                        $i++;   
                }
                return $bool;
        }
       
}