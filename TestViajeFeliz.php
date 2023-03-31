<?php


require_once "Viaje.php";





//==========================================================

function cargarVariosViajeros ($cantidadP, $viaje){

    for($i=0; $i < $cantidadP; $i++){
  
      $arreglo= cargarPersona();
      $viaje->cargarViajero($arreglo);
      // esta secuencia simplemente repite el proceso de cargar informacion a la seccion de pasajeros.
        }
    }


//==========================================================

/** @param Viaje $viaje
 * 
 * 
 */


function modificarInformacionPasajeros ($viaje) {

    echo "Ingrese el DNI de la persona a modificar \n";
    $dni=trim(fgets(STDIN));
    $viaje->eliminarPasajero($dni);
    cargarVariosViajeros(1, $viaje);
}


//==========================================================
 function agregarPasajero ($viaje){
            
    if (count($viaje->getPasajeros()) < $viaje->getmaxPasajeros()){
        cargarVariosViajeros(1, $viaje);
      } else {
        echo "Se alcanzo la cantidad maxima de pasajeros para el viaje \n";
      }
 }

//==========================================================

/** Esta funcion carga y comprueba los datos cargados de cada pasajero, crea un arreglo */
 function cargarPersona () {

    // seccion de nombre //
    echo "Ingrese el nombre del pasajero. \n";
    $nombreV=trim(fgets(STDIN));
    while (!ctype_alpha($nombreV)) {
        echo "El nombre ingresado no es valido, vuelva a intentarlo! \n";
        $nombreV=trim(fgets(STDIN));
    }

    // seccion de apellido //
    echo "Ingrese el apellido del pasajero. \n";
    $apellidoV=trim(fgets(STDIN) );
    while (!ctype_alpha($apellidoV)) {
        echo "El apellido ingresado no es valido, vuelva a intentarlo! \n";
        $apellidoV=trim(fgets(STDIN));
    }

    // seccion de DNI //
    echo "Ingrese el dni del pasajero \n";
    $dniV=trim(fgets(STDIN));
    while (!ctype_alnum($dniV)) {
        echo "El DNI ingresado no es valido, vuelva a intentarlo! \n";
        $dniV=trim(fgets(STDIN));
    }

    $pasajero =  ["nombre"=> $nombreV, "apellido"=> $apellidoV, "DNI"=> $dniV] ;
    return $pasajero;
    }



//==========================================================

/** Esta funcion remplaza los datos cargados dentro del objeto, espesificamente el codigo, destiny y cantidad maxima
 * de personas que pueden ser añadidas al viaje 
 * @param Viaje $viaje
 */

    function cargarDatosViaje ($viaje) {
            

        echo "Ingrese su destino \n";
        $destinoV=trim(fgets(STDIN));

        echo "Ingrese la cantidad maxima de personas para este viaje \n";
        $cantidadMaxima=trim(fgets(STDIN));
        while (!ctype_alnum($cantidadMaxima) or $cantidadMaxima <= 50 ) {
            echo "Valor ingresado no valido! vuelva a intentarlo! \n";
            $cantidadMaxima=trim(fgets(STDIN));
        }

        echo "Ingrese el codigo del viaje \n";
        $codigoDeViaje=trim(fgets(STDIN));

        $viaje->setmaxPasajeros($cantidadMaxima);
        $viaje->setCodigoViaje($codigoDeViaje);
        $viaje->setDestino($destinoV);
    }


//==========================================================

/** Esta funcion remplaza los datos de ejemplo que tiene cargados de manera predeterminada el objeto viaje
 * @param Viaje $viaje
 */

     function crearViaje ($viaje) {


        echo "Bienvenido a la seccion de crear un viaje! Iniciemos! \n";
        cargarDatosViaje($viaje);

        echo "Desea cargar los datos de los pasajeros ahora? \n";
        $sino = trim(fgets(STDIN));
        $sino = strtoupper($sino);
        while ($sino == "SI")  {

            cargarVariosViajeros(1, $viaje);
            echo "Desea ingresar los datos de otro pasajero? \n";
            $sino = trim(fgets(STDIN));
            $sino = strtoupper($sino);

            if ( count($viaje->getPasajeros()) == $viaje->getmaxPasajeros() ) {
                echo "Se alcanzo el numero maximo de pasajeros! ya no puede ingresar mas! \n";
                $sino= "NO";
            }

        }
        echo "Los datos disponibles para el viaje ya fueron cargados! \n";

        }



//==========================================================

/** la funcion menu simplemente le permite al usuario utilizar las funciones del programa */

 function menuViajeFeliz () {

  

    $viaje = new Viaje( 0 , 50, "Neuquen", 0000 );
    $example= [["nombre"=> "conductor", "apellido"=> "pasajero", "DNI"=> "00000000"]];
    $viaje->setPasajeros($example);

    echo "Bienvenido al menu! estas son las siguentes funciones: \n";

do {

    echo " 1.Programar un nuevo viaje \n
    2. Mostrar la informacion del viaje actual \n
    3. Agregar un pasajero \n
    4. Eliminar y cargar un pasajero nuevo \n
    5. Eliminar a un pasajero \n
    6. Salir \n";


    $opcion = trim(fgets(STDIN));

    switch ($opcion){
        case 1: 
            crearViaje($viaje);
            break;
        case 2: 

            echo $viaje;

            break;
        case 3: 
            
            agregarPasajero($viaje);
            break;

        case 4: 

            modificarInformacionPasajeros($viaje);
            echo "Los datos fueron remplazados \n";
            break;

        case 5: 

            echo "Ingrese el dni del pasajero que desea eliminar \n";
            $dni=trim(fgets(STDIN));
            $viaje->eliminarPasajero($dni);
            echo "El pasajero fue eliminado de la lista. \n";

            break;

        case 6:
            echo "Nos vemos en el proximo viaje! \n \n";
            break;

        default:
             echo "la opcion es incorrecta, vuelva a ingresar un numero \n";
             break;

                    }
    } while ($opcion != 6);
  }




  menuViajeFeliz();

