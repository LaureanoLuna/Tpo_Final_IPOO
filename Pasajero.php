<?php 

    /** Clase Persona , tiene un atributo el cual es un arreglo con las claves: nombre, apellido, DNI.
    * correspondiendo a los datos ingresados para identificar al objeto Persona
    */
    class pasajero{

        private $nombre;
        private $apellido;
        private $dni;
        private $telefono;    
    
            /**Implementamos el metodo Constructor del objeto
             * @param string $nomPers
             * @param string $apellidoPers
             * @param atring $dniPersona
             * 
             */

        public function __construct($nomPers, $apellidoPers, $dniPersona, $numTelefono,)
        {
           $this->nombre = $nomPers;
           $this->apellido = $apellidoPers;
           $this->dni = $dniPersona;
           $this->telefono = $numTelefono;
        }

        //Implementamos los metodos de acceso a los atributos
        
        // Getters y Setters

             /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

        }

        /**
         * Get the value of apellido
         */ 
        public function getApellido()
        {
                return $this->apellido;
        }

        /**
         * Set the value of apellido
         *
         * @return  self
         */ 
        public function setApellido($apellido)
        {
                $this->apellido = $apellido;

        }

        /**
         * Get the value of dni
         */ 
        public function getDni()
        {
                return $this->dni;
        }

        /**
         * Set the value of dni
         *
         * @return  self
         */ 
        public function setDni($dni)
        {
                $this->dni = $dni;

        }

        /**
         * Get the value of telefono
         */ 
        public function getTelefono()
        {
                return $this->telefono;
        }

        /**
         * Set the value of telefono
         *
         * @return  self
         */ 
        public function setTelefono($telefono)
        {
                $this->telefono = $telefono;

        }
       
        /**Metodo implemetado para poder mostrar los datos de dicho objeto */
        public function __toString()
        {
            $str = " Nombre: ".($this->getNombre())."\n Apellido: ".$this->getApellido()."\n Numero de DNI: ".($this->getDni())."\nNumero de Telefono: ".($this->getTelefono())."\n";
            return $str;
        }

       



   

       
}
?>