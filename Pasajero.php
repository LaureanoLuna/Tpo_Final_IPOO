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
    
            /**Implementamos el metodo Constructor del objeto
             * @param string $nomPers
             * @param string $apellidoPers
             * @param atring $dniPersona
             * 
             */

        public function __construct($nomPers, $apellidoPers, $dniPersona, $numTelefono, $idViaje)
        {
           $this->pnombre = $nomPers;
           $this->papellido = $apellidoPers;
           $this->rdocumento = $dniPersona;
           $this->ptelefono = $numTelefono;
           $this->idviaje = $idViaje;
        }

           //Implementamos los metodos de acceso a los atributos
        
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

     

       
        /**Metodo implemetado para poder mostrar los datos de dicho objeto */
        public function __toString()
        {
            $str = " Nombre: ".$this->getPnombre().
            "\n Apellido: ".$this->getPapellido().
            "\n Numero de DNI: ".$this->getRdocumento().
            "\n Numero de Telefono: ".$this->getPtelefono()."\n";
            return $str;
        }
}