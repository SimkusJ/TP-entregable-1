<?php


class Viaje {

    private $pasajeros;
    private $maxPasajeros;
    private $destino;
    private $codigoViaje;





    public function __construct($pasajeros, $maxPasajeros, $destino, $codigoViaje)
    {
        $this->pasajeros=$pasajeros;
        $this->maxPasajeros=$maxPasajeros;
        $this->destino=$destino;
        $this->codigoViaje=$codigoViaje;

    }


    // seteo y get de parametros //


    // ----Pasajeros---- //
    public function setPasajeros ($valor) {
        $this->pasajeros=$valor;
    }
    public function getPasajeros (){
        return $this->pasajeros;
    }
    public function cargarViajero ($viajero){
        array_push($this->pasajeros, $viajero);
    }
      // ---- funcion cargarViajeros ---- //


    // ----maxPasajeros--- //
    public function setmaxPasajeros ($valor) {
        $this->maxPasajeros=$valor;
    }
    public function getmaxPasajeros () {
        return $this->maxPasajeros;
    }

    // ----Destino---- //
    public function setDestino ($valor) {
        $this->destino=$valor;
    }
    public function getDestino () {
        return $this->destino;
    }


    // ---- coodigoViaje ---- //
    public function setCodigoViaje ($valor){
        $this->codigoViaje=$valor;
    }
    public function getCodigoViaje (){
        return $this->codigoViaje;
    }




    // ------------ funcion para eliminar una posicion del arreglo pasajeros ------------//


        public function eliminarPasajero ($dni){

            $posicion=array_search($dni, array_column($this->pasajeros,"DNI"));
            if (empty($posicion)){
            unset($this->pasajeros[$posicion]);
            }
        }



        public function __toString () {
            $mensaje= "========== INFORMACION BASICA ========== \n" ;
            $mensaje.= "Codigo de viaje:". $this->codigoViaje ."\n";
            $mensaje.= "Destino del viaje:". $this->destino. "\n";
            $mensaje.= "Cantidad maxima de personas:". $this->maxPasajeros. "\n";
            $mensaje.="Cantidad de pasajeros actual:". count($this->pasajeros). "\n";
            $mensaje.="===================================== \n";

            $mensaje.= $this->mostrarPasajeros(); 
            

            return $mensaje;  
        }

        public function mostrarPasajeros () {

            $mensaje = "========== SECCION DE PASAJEROS ========== \n";;


            if (count($this->pasajeros) > 0) {

               foreach($this->pasajeros as $i=>$pasajero ){


                $mensaje.="========== Pasajero  $i  ========== \n";
                $mensaje.= "Nombre:". $pasajero["nombre"] . "\n" ;
                $mensaje.="Apellido:". $pasajero["apellido"] . "\n";
                $mensaje.="DNI:". $pasajero["DNI"] . "\n";   
                $mensaje.="===================================== \n";
                }

            }else{

                $mensaje="============================================= \n";
                $mensaje.= "No se cargo informacion sobre los pasajeros. \n";
                $mensaje.="============================================= \n";
            }

            return $mensaje;
        }


      
    }



