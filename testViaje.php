<?php
include_once "BaseDatos.php";
include_once "Viaje.php";
include_once "Pasajero.php";
include_once "ResponsableV.php";
include_once "Empresa.php";

function menuPrincipal(){
    echo "\n••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••\n";
    echo "•••••••••••••••••••|Bienvenido al menú|•••••••••••••••••••••\n";
    echo "••••••••••••••••••••••••••••••••••••••••••••••••••••••••••••\n";
    echo "••••••••••••••••••|Seleccione una opción|•••••••••••••••••••\n";
    echo "\n1: Opciones de modificado. \n";
    echo "2: Opciones de borrado. \n";
    echo "3: Opciones de inserción. \n";
    echo "4: Opciones de listado. \n";
    $opcion = trim(fgets(STDIN));
    switch ($opcion){
        case 1:
            menuModificar(); //Linea 38
            break;
        case 2:
            menuBorrar(); //Linea
            break;
        case 3:
            menuInsertar();  //Linea
            break;
        case 4:
            menuListar();  //Linea
            break;
        default:
            echo "Número inválido. Ingrese otro: \n";
            menuPrincipal();
            break;
    }
}

function menuModificar(){
    echo "\n♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦ |Menú de modificaciones| ♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦ |Seleccione una opción| ♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "\n1: Modificar una empresa. \n";
    echo "2: Modificar un viaje. \n";
    echo "3: Modificar un pasajero. \n";
    echo "4: Modificar un responsable. \n";
    $opcion = trim(fgets(STDIN));
    switch ($opcion){
        case 1:
            modificarEmpresa();
            break;
        case 2:
            modificarViaje();
            break;
        case 3:
            modificarPasajero();
            break;
        case 4:
            modificarResponsable();
            break;
        default:
            echo "Número inválido. Ingrese otro: \n";
            menuModificar();
            break;
    }
}

function menuBorrar(){
    echo "\n♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦ |Menú de borrado| ♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦ |Seleccione una opción| ♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "\n1: Eliminar una empresa. \n";
    echo "2: Eliminar un viaje. \n";
    echo "3: Eliminar un pasajero. \n";
    echo "4: Eliminar un responsable. \n";
    $opcion = trim(fgets(STDIN));
    switch ($opcion){
        case 1:
            eliminarEmpresa();
            break;
        case 2:
            eliminarViaje();
            break;
        case 3:
            eliminarPasajero();
            break;
        case 4:
            eliminarResponsable();
            break;
        default:
            echo "Número inválido. Ingrese otro: \n";
            menuBorrar();
            break;
    }
}

function menuInsertar(){
    echo "\n♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦|Menú de inserciones|♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦|Seleccione una opción|♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "\n1: Insertar una empresa. \n";
    echo "2: Insertar un viaje. \n";
    echo "3: Insertar un pasajero. \n";
    echo "4: Insertar un responsable. \n";
    $opcion = trim(fgets(STDIN));
    switch ($opcion){
        case 1:
            insertarEmpresa();
            break;
        case 2:
            insertarViaje();
            break;
        case 3:
            insertarPasajero();
            break;
        case 4:
            insertarResponsable();
            break;
        default:
            echo "Número inválido. Ingrese otro: \n";
            menuInsertar();
            break;
    }
}

function menuListar(){
    echo "\n♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦ |Menú de listado| ♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦ |Seleccione una opción| ♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦♦\n";
    echo "\n1: Mostrar el listado de empresas cargadas. \n";
    echo "2: Mostrar el listado de viajes cargados. \n";
    echo "3: Mostrar el listado de pasajeros cargados. \n";
    echo "4: Mostrar el listado de responsables cargados. \n";
    $opcion = trim(fgets(STDIN));
    switch ($opcion){
        case 1:
            listarEmpresas();
            break;
        case 2:
            listarViajes();
            break;
        case 3:
            listarPasajeros();
            break;
        case 4:
            listarResponsables();
            break;
        default:
            echo "Número inválido. Ingrese otro: ";
            menuListar();
            break;
    }
}

//Métodos de modificaciones

function modificarEmpresa(){
    $idempresa = "";
    $empresa = new Empresa();
    echo "Empresas cargadas: \n";
    $condicion = "";
    tipoListadoEmpresas($condicion);
    echo "\nIngrese el ID de la empresa: ";
    $idempresa = trim(fgets(STDIN));
    while (!is_numeric($idempresa) || $idempresa <= 0){
        echo "Debe ingresar un ID válido.\n";
        $idempresa = trim(fgets(STDIN));
    }
    if($empresa->buscar($idempresa)){
        echo "Ingrese el nuevo nombre de la empresa: ";
        $enombre = trim(fgets(STDIN));
        while(is_numeric($enombre)){
            echo "Debe ingresar un nombre válido.\n";
            $enombre = trim(fgets(STDIN));
        }
        echo "Ingrese la nueva direccion de la empresa: ";
        $edireccion = trim(fgets(STDIN));
        while(is_numeric($edireccion)){
            echo "Debe ingresar una dirección válida.\n";
            $edireccion = trim(fgets(STDIN));
        }
        $empresa->cargar($idempresa, $enombre, $edireccion);
        if($empresa->modificar()){
            echo "\nLa empresa se ha modificado correctamente.\n";
            echo "Listado actual de las empresas: \n";
            tipoListadoEmpresas($condicion);
            menuPrincipal();
        } else{
            echo "Ha ocurrido un error al modificar la empresa: " . $empresa->getmensajeoperacion();
            menuPrincipal();
        }
    } else{
        echo "No existe ninguna empresa con el ID especificado\n";
        menuPrincipal();
    }
}

function modificarViaje(){
    echo "Viajes cargados: \n";
    $condicion = "";
    tipoListadoViajes($condicion);
    echo "\nIngrese el ID del viaje: ";
    $idviaje = trim(fgets(STDIN));
    while(!is_numeric($idviaje) || $idviaje <= 0){
        echo "Ingrese un ID válido. \n";
        $idviaje = trim(fgets(STDIN));
    }
    $viaje = new Viaje();
    if($viaje->buscar($idviaje)){
        echo "Lista de responsables disponibles: \n";
        tipoListadoResponsables($condicion);
        echo "\nIngrese el numero del responsable del viaje: ";
        $rnumeroempleado = trim(fgets(STDIN));
        while(!is_numeric($rnumeroempleado) || $rnumeroempleado <= 0){
            echo "Ingrese un número válido. \n";
            $rnumeroempleado = trim(fgets(STDIN));
        }
        $responsable = new ResponsableV();
        if($responsable->buscar($rnumeroempleado)){
            echo "Lista de empresas disponibles:\n";
            tipoListadoEmpresas($condicion);
            echo "\nIngrese el ID de la empresa del viaje: ";
            $idempresa = trim(fgets(STDIN));
            while(!is_numeric($idempresa) || $idempresa <= 0){
                echo "Ingrese un ID válido. \n";
                $idempresa = trim(fgets(STDIN));
            }
            $empresa = new Empresa();
            if($empresa->buscar($idempresa)){
                // $idviaje, $vdestino, $vcantmaxpasajeros, $empresa, $responsable, $vimporte
                echo "Ingrese el nuevo destino del viaje: ";
                $vdestino = trim(fgets(STDIN));
                while(is_numeric($vdestino)){
                    echo "Este destino no es válido. \n";
                    $vdestino = trim(fgets(STDIN));
                }
                echo "Ingrese la cantidad maxima de pasajeros: ";
                $vcantmaxpasajeros = trim(fgets(STDIN));
                while(!is_numeric($vcantmaxpasajeros) || $vcantmaxpasajeros <= 0){
                    echo "Ingrese una cantidad de pasajeros válida. \n";
                    $vcantmaxpasajeros = trim(fgets(STDIN));
                }
                echo "Ingrese el nuevo importe del viaje: ";
                $vimporte = trim(fgets(STDIN));
                while(!is_numeric($vcantmaxpasajeros) || $vimporte <= 0){
                    echo "Ingrese un importe válido. \n";
                    $vimporte = trim(fgets(STDIN));
                }
                $viaje->cargar($idviaje, $vdestino, $vcantmaxpasajeros, $empresa, $responsable,
                $vimporte);
                if($viaje->modificar()){
                    echo "\nEl viaje se ha modificado correctamente.\n";
                    echo "Lista actual de viajes:\n";
                    tipoListadoViajes($condicion);
                    menuPrincipal();
                } else{
                    echo "Ha ocurrido un error al modificar el viaje: " . $viaje->getMensajeOperacion();
                    menuPrincipal();
                }
            } else{
                echo "Se ha producido un error al buscar la empresa:\n" . $empresa->getmensajeoperacion();
                menuPrincipal();
            }
        } else{
            echo "se ha producido un error al buscar al responsable:\n" . $responsable->getmensajeoperacion();
            menuPrincipal();
        }
    } else{
        echo "Se ha producido un error al buscar el viaje:\n" . $viaje->getMensajeOperacion();
        menuPrincipal();
    }
}

function modificarPasajero(){
    $pdocumento;
    $pasajero = new Pasajero();
    echo "Lista de pasajeros actuales: \n";
    $condicion = "";
    tipoListadoPasajeros($condicion);
    echo "\nIngrese el documento del pasajero a modificar: ";
    $pdocumento = trim(fgets(STDIN));
    if($pasajero->buscar($pdocumento)){
        echo "Ingrese el nuevo nombre del pasajero: ";
        $pnombre = trim(fgets(STDIN));
        while(is_numeric($pnombre)){
            echo "Ingrese un nombre válido. \n";
            $pnombre = trim(fgets(STDIN));
        }
        echo "Ingrese el nuevo apellido del pasajero: ";
        $papellido = trim(fgets(STDIN));
        while(is_numeric($papellido)){
            echo "Ingrese un apellido válido. \n";
            $papellido = trim(fgets(STDIN));
        }
        echo "Ingrese el nuevo telefono del pasajero: ";
        $ptelefono = trim(fgets(STDIN));
        while(!is_numeric($ptelefono) || $ptelefono <= 0){
            echo "Ingrese un número de teléfono válido. \n";
            $ptelefono = trim(fgets(STDIN));
        }
        $pasajero->cargar($pnombre, $papellido, $pdocumento, $ptelefono, $pasajero->getViaje());
        if($pasajero->modificar()){
            echo "\nEl pasajero se ha modificado correctamente.\n";
            echo "Listado actual de los pasajeros:\n";
            tipoListadoPasajeros($condicion);
            menuPrincipal();
        } else{
            echo "Ha ocurrido un error al modificar el pasajero: " . $pasajero->getmensajeoperacion();
            menuPrincipal();
        }
    } else{
        echo "No existe ningun pasajero con el documento especificado\n";
        menuPrincipal();
    }
}


function modificarResponsable(){
    $responsable = new ResponsableV();
    echo "Lista de responsables: \n";
    $condicion = "";
    tipoListadoResponsables($condicion);
    echo "\nIngrese el numero de empleado a modificar: ";
    $rnumeroempleado = trim(fgets(STDIN));
    while(!is_numeric($rnumeroempleado) || $rnumeroempleado <= 0){
        echo "Ingrese un número de empleado válido. \n";
        $rnumeroempleado = trim(fgets(STDIN));
    }
    if($responsable->buscar($rnumeroempleado)){
        echo "Ingrese el nuevo numero de licencia del responsable: ";
        $rnumerolicencia = trim(fgets(STDIN));
        while(!is_numeric($rnumerolicencia) || $rnumerolicencia <= 0){
            echo "Ingrese un número de licencia válido. \n";
            $rnumerolicencia = trim(fgets(STDIN));
        }
        echo "Ingrese el nuevo nombre del responsable: ";
        $rnombre = trim(fgets(STDIN));
        while(is_numeric($rnombre)){
            echo "Ingrese un nombre válido. \n";
            $rnombre = trim(fgets(STDIN));
        }
        echo "Ingrese el nuevo apellido del responsable: ";
        $rapellido = trim(fgets(STDIN));
        $responsable->cargar($rnumeroempleado, $rnumerolicencia, $rnombre,
        $rapellido);
        if($responsable->modificar()){
            echo "\nEl responsable se ha modificado correctamente.\n";
            echo "Lista actual de los responsables: \n";
            tipoListadoResponsables($condicion);
            menuPrincipal();
        } else{
            echo "Ha ocurrido un error al modificar el responsable: " . $responsable->getmensajeoperacion();
            menuPrincipal();
        }
    } else{
        echo "No existe ningun responsable con el ID especificado\n";
        menuPrincipal();
    }
}

//Métodos de borrado

function eliminarEmpresa(){
    $empresa = new Empresa();
    echo "Listado de empresas actuales: \n";
    $condicion = "";
    tipoListadoEmpresas($condicion);
    echo "\nIngrese el ID de la empresa a eliminar: ";
    $idempresa = trim(fgets(STDIN));
    while(!is_numeric($idempresa)){
        echo "Debe ingresar un ID válido. \n";
        $idempresa = trim(fgets(STDIN));
    }
    if($empresa->buscar($idempresa)){
        if($empresa->eliminar()){
            echo "\nLa eliminacion se ha hecho correctamente\n";
            echo "Listado actual de las empresas: \n";
            tipoListadoEmpresas($condicion);
            menuPrincipal();
        } else{
            echo "Ha ocurrido un error al eliminar la empresa: " . $empresa->getmensajeoperacion();
            menuPrincipal();
        }
    } else{
        echo "Ha ocurrido un error al buscar la empresa: " . $empresa->getmensajeoperacion();
        menuPrincipal();
    }
}

function eliminarViaje(){
    $viaje = new Viaje();
    echo "Listado de viajes: \n";
    $condicion ="";
    tipoListadoViajes($condicion);
    echo "\nIngrese el ID del viaje a eliminar: ";
    $idViaje = trim(fgets(STDIN));
    while(!is_numeric($idViaje)){
        echo "Debe ingresar un ID válido. \n";
        $idViaje = trim(fgets(STDIN));
    }
    if($viaje->buscar($idViaje)){
        if($viaje->eliminar()){
            echo "La eliminacion se ha hecho correctamente\n";
            echo "Listado actual de los viajes: \n";
            tipoListadoViajes($condicion);
            menuPrincipal();
        } else{
            echo "Ha ocurrido un error al eliminar el viaje: " . $viaje->getMensajeOperacion();
            menuPrincipal();
        }
    } else{
        echo "Ha ocurrido un error al buscar el viaje: " . $viaje->getMensajeOperacion();
        menuPrincipal();
    }
}

function eliminarPasajero(){
    echo "Listado de pasajeros: \n";
    $condicion = "";
    tipoListadoPasajeros($condicion);
    echo "\nIngrese el documento del pasajero que quiera eliminar: ";
    $pdocumento = trim(fgets(STDIN));
    while(!is_numeric($pdocumento)){
        echo "Debe ingresar un DNI válido. \n";
        $pdocumento = trim(fgets(STDIN));
    }
    $pasajero = new Pasajero();
    if($pasajero->buscar($pdocumento)){
        if($pasajero->eliminar()){
            echo "La eliminacion se ha hecho correctamente.\n";
            echo "Listado actual de los pasajeros: \n";
            tipoListadoPasajeros($condicion);
            menuPrincipal();
        } else{
            echo "Ha ocurrido un error al eliminar el pasajero:\n" . $pasajero->getmensajeoperacion();
            menuPrincipal();
        }
    } else{
        echo "Ha ocurrido un error al buscar el pasajero:\n" . $pasajero->getmensajeoperacion();
        menuPrincipal();
    }
}

function eliminarResponsable(){
    echo "Listado de responsables: \n";
    $condicion = "";
    tipoListadoResponsables($condicion);
    echo "\nIngrese el numero de empleado que quiera eliminar: ";
    $rnumeroempleado = trim(fgets(STDIN));
    while(!is_numeric($rnumeroempleado)){
        echo "Debe ingresar un número de empleado válido. \n";
        $rnumeroempleado = trim(fgets(STDIN));
    }
    $responsable = new ResponsableV();
    if($responsable->buscar($rnumeroempleado)){
        if($responsable->eliminar()){
            echo "\nLa eliminacion se ha hecho correctamente.\n";
            echo "Listado actual de los responsables: \n";
            tipoListadoResponsables($condicion);
            menuPrincipal();
        } else{
            echo "Ha ocurrido un error al eliminar al responsable:\n" . $responsable->getmensajeoperacion();
            menuPrincipal();
        }
    } else{
        echo "El ID ingresado no se encuentra en la base de datos\n";
        menuPrincipal();
    }
}

//Métodos de inserción

function insertarEmpresa(){
    $enombre = "";
    $edireccion = "";
    $empresa = new Empresa();
    echo "Ingrese el nombre de la empresa: ";
    $enombre = trim(fgets(STDIN));
    while(is_numeric($enombre)){
        echo "El nombre no es válido. Intente de nuevo.\n";
        $enombre = trim(fgets(STDIN));
    }
    echo "Ingrese la direccion de la empresa: ";
    $edireccion = trim(fgets(STDIN));
    while(is_numeric($edireccion)){
        echo "La dirección no es válida. Intentelo de nuevo.\n";
        $edireccion = trim(fgets(STDIN));
    }
    $empresa->cargar(0, $enombre, $edireccion);
    if($empresa->insertar()){
        echo "La insercion se ha hecho correctamente.\n";
        echo "Listado actual de las empresas: \n";
        $condicion = "";
        tipoListadoEmpresas($condicion);
        menuPrincipal();
    } else{
        echo "Ha ocurrido un error: " . $empresa->getmensajeoperacion();
        menuPrincipal();
    }
}

function insertarViaje(){
    echo "Listado de empresas: \n";
    $condicion = "";
    tipoListadoEmpresas($condicion);
    echo "\nIngrese el ID de la empresa del viaje: ";
    $idempresa = trim(fgets(STDIN));
    while(!is_numeric($idempresa) || $idempresa <= 0){
        echo "Ingrese un ID de empresa válido. \n";
        $idempresa = trim(fgets(STDIN));
    }
    $empresa = new Empresa();
    if($empresa->buscar($idempresa)){
        echo "Listado de responsables: \n";
        tipoListadoResponsables($condicion);
        echo "\nIngrese el numero de responsable del viaje: ";
        $rnumeroempleado = trim(fgets(STDIN));
        while(!is_numeric($rnumeroempleado) || $rnumeroempleado <= 0){
            echo "Ingrese un número válido. \n";
            $rnumeroempleado = trim(fgets(STDIN));
        }
        $responsable = new ResponsableV();
        if($responsable->buscar($rnumeroempleado)){
            $vdestino; $vcantmaxpasajeros; $vimporte;
            echo "Ingrese el destino del viaje: ";
            $vdestino = trim(fgets(STDIN));
            while(is_numeric($vdestino)){
                echo "Ingrese un destino válido.\n";
                $vdestino = trim(fgets(STDIN));
            }
            echo "Ingrese la cantidad maxima de pasajeros: ";
            $vcantmaxpasajeros = trim(fgets(STDIN));
            while(!is_numeric($vcantmaxpasajeros) || $vcantmaxpasajeros <= 0){
                echo "Ingrese una cantidad de pasajeros válida.\n";
                $vcantmaxpasajeros = trim(fgets(STDIN));
            }
            echo "Ingrese el importe del viaje: ";
            $vimporte = trim(fgets(STDIN));
            while($vimporte <= 0){
                echo "Ingrese un importe válido. \n";
                $vimporte = trim(fgets(STDIN));
            }
            $viaje = new Viaje();
            $viaje->cargar(0, $vdestino, $vcantmaxpasajeros, $empresa, $responsable, $vimporte);
            if($viaje->insertar()){
                echo "\nLa insercion se ha hecho correctamente\n";
                echo "Listado actual de los viajes: \n";
                $condicion = "";
                tipoListadoViajes($condicion);
                menuPrincipal();
            } else{
                echo "Ha ocurrido un error: " . $viaje->getMensajeOperacion();
                menuPrincipal();
            }
        } else{
            echo "el numero de responsable ingresado no se encuentra en la base de datos\n";
            menuPrincipal();
        }
    } else{
        echo "El ID ingresado no se encuentra en la base de datos\n";
        menuPrincipal();
    }
}

function insertarPasajero(){
    echo "Listado de viajes:\n";
    $condicion = "";
    tipoListadoViajes($condicion);
    echo "\nIngrese el ID del viaje al que desea insertar al pasajero: ";
    $idviaje = trim(fgets(STDIN));
    while(!is_numeric($idviaje) || $idviaje <= 0){
        echo "El ID debe ser numerico y positivo\n";
        $idviaje = trim(fgets(STDIN));
    }
    $viaje = new Viaje();
    if($viaje->buscar($idviaje)){
        echo "Ingrese el numero de documento del pasajero: ";
        $pdocumento = trim(fgets(STDIN));
        while(!is_numeric($pdocumento) || $pdocumento <= 0){
            echo "El ID debe ser numerico y positivo\n";
            $pdocumento = trim(fgets(STDIN));
        }
        echo "Ingrese el nombre del pasajero: ";
        $pnombre = trim(fgets(STDIN));
        while(is_numeric($pnombre)){
            echo "El nombre no debe ser numerico\n";
            $pnombre = trim(fgets(STDIN));
        }
        echo "Ingrese el apellido del pasajero: ";
        $papellido = trim(fgets(STDIN));
        while(is_numeric($papellido)){
            echo "El apellido no debe ser numerico\n";
            $papellido = trim(fgets(STDIN));
        }
        echo "Ingrese el telefono del pasajero: ";
        $ptelefono = trim(fgets(STDIN));
        while(!is_numeric($ptelefono) || $ptelefono <= 0){
            echo "El telefono debe ser numerico y positivo\n";
            $ptelefono = trim(fgets(STDIN));
        }
        $pasajero = new Pasajero();
        $pasajero->cargar($pnombre, $papellido, $pdocumento, $ptelefono, $viaje);
            if($pasajero->insertar()){
            echo "\nEl pasajero ha sido insertado correctamente.\n";
            echo "Listado actual de los pasajeros: \n";
            tipoListadoPasajeros($condicion);
            menuPrincipal();
            }
    } else {
        echo "Se ha producido un error al buscar el viaje:\n" . $viaje->getMensajeOperacion();
        menuPrincipal();
    }
}

function insertarResponsable(){
    echo "Ingrese el numero de licencia: ";
    $rnumerolicencia = trim(fgets(STDIN));
    while(!is_numeric($rnumerolicencia) || $rnumerolicencia <= 0){
        echo "Ingrese un número válido.\n";
        $rnumerolicencia = trim(fgets(STDIN));
    }
    echo "Ingrese el nombre: ";
    $rnombre = trim(fgets(STDIN));
    while(is_numeric($rnombre)){
        echo "Ingrese un nombre válido.\n";
        $rnombre = trim(fgets(STDIN));
    }
    echo "Ingrese el apellido: ";
    $rapellido = trim(fgets(STDIN));
    while(is_numeric($rapellido)){
        echo "Ingrese un apellido válido. \n";
        $rapellido = trim(fgets(STDIN));
    }
    $responsable = new ResponsableV();
    $responsable->cargar(0, $rnumerolicencia, $rnombre, $rapellido);
    if($responsable->insertar()){
        echo "\nLa insercion se ha hecho correctamente.\n";
        echo "Listado actual de los responsables: \n";
        $condicion = "";
        tipoListadoResponsables($condicion);
        menuPrincipal();
    } else{
        echo "ha ocurrido un error:\n" . $responsable->getmensajeoperacion();
        menuPrincipal();
    }
}

//Métodos de listado.

function listarEmpresas(){
    echo "Escriba una condición para el listado o presione enter para hacer un listado completo: \n";
    $condicion = trim(fgets(STDIN));
    tipoListadoEmpresas($condicion);
    menuPrincipal();
}

function listarViajes(){
    echo "Escriba una condición para el listado o presione enter para hacer un listado completo: \n";
    $condicion = trim(fgets(STDIN));
    tipoListadoViajes($condicion);
    menuPrincipal();
}

function listarPasajeros(){
    echo "Escriba una condición para el listado o presione enter para hacer un listado completo: \n";
    $condicion = trim(fgets(STDIN));
    tipoListadoPasajeros($condicion);
    menuPrincipal();
}

function listarResponsables(){
    echo "Escriba una condición para el listado o presione enter para hacer un listado completo: \n";
    $condicion = trim(fgets(STDIN));
    tipoListadoResponsables($condicion);
    menuPrincipal();
}

function tipoListadoEmpresas($condicion){
    $empresa = new Empresa();
    if($listaEmpresas = $empresa->listar($condicion)){
          for($i = 0 ; $i < count($listaEmpresas); $i++){
              echo "\nEmpresa " . $listaEmpresas[$i]->getIdempresa() . ":\n";
              echo $listaEmpresas[$i]->__toString();
          }
      } else{
          echo "Se ha producido un error:\n" . $empresa->getmensajeoperacion();
      }
  }
  
   function tipoListadoResponsables($condicion) {
      $responsable = new ResponsableV();
      if($listaResponsables = $responsable->listar($condicion)){
           for($i = 0 ; $i < count($listaResponsables); $i++){
           echo "\nResponsable " . $listaResponsables[$i]->getNroEmpleado() . ":\n";
           echo $listaResponsables[$i]->__toString();
      }
      } else{
       echo "Ha ocurrido un error:\n" . $responsable->getmensajeoperacion();
       menuPrincipal();
      }
  }
  
  function tipoListadoPasajeros($condicion) {
      $pasajero = new Pasajero();
      if($listaPasajeros = $pasajero->listar($condicion)){
          for($i = 0 ; $i < count($listaPasajeros); $i++){
              echo "\nPasajero " . $listaPasajeros[$i]->getPdocumento() . ":\n";
              echo $listaPasajeros[$i]->__toString();
          }
      } else{
          echo "Ha ocurrido un error:\n" . $pasajero->getmensajeoperacion();
          menuPrincipal();
      }
  }
  
  function tipoListadoViajes($condicion) {
      $viaje = new Viaje();
      if($listaViajes = $viaje->listar($condicion)){
          for($i = 0 ; $i < count($listaViajes); $i++){
              echo "\nViaje " . $listaViajes[$i]->getIdViaje() . ":\n";
              echo $listaViajes[$i]->__toString();
          }
      } else{
          echo "Ha ocurrido un error:\n" . $viaje->getMensajeOperacion();
          menuPrincipal();
      }
  }

menuPrincipal();