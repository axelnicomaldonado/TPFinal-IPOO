<?php
include_once "BaseDatos.php";
include_once "Empresa.php";
include_once "ResponsableV.php";
include_once "Pasajero.php";

class Viaje {

    //Atributos
    private $idViaje;
    private $destino;
    private $cantMaxPasajeros;
    private $empresa;
    private $responsableV;
    private $costoViaje;
    private $mensajeOperacion;

    //Métodos

    public function __construct(){
            $this->destino = "";
            $this->cantMaxPasajeros = "";
            $this->empresa = new Empresa();
            $this->responsableV = new ResponsableV();
            $this->costoViaje = "";
    }


    public function getIdViaje(){
        return $this->idViaje;
    }

    public function getDestino(){
        return $this->destino;
    }

    public function getcantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }

    public function getEmpresa(){
        return $this->empresa;
    }

    public function getResponsableV(){
        return $this->responsableV;
    }

    public function getCostoViaje(){
        return $this->costoViaje;
    }

    public function getMensajeOperacion(){
       return $this->mensajeOperacion;
    }

    //Seteo de valores

    public function setIdViaje($idViaje){
        $this->idViaje=$idViaje;
    }

    public function setDestino($destino){
        $this->destino=$destino;
    }

    public function setcantMaxPasajeros($cantMaxPasajeros){
        $this->cantMaxPasajeros=$cantMaxPasajeros;
    }

    public function setEmpresa($empresa){
        $this->empresa=$empresa;
    }

    public function setResponsableV($responsableV){
        $this->responsableV=$responsableV;
    }

    public function setCostoViaje($costoViaje){
        $this->costoViaje=$costoViaje;
    }

    public function setMensajeOperacion($mensajeOperacion){
        $this->mensajeOperacion=$mensajeOperacion;
    }

    public function __toString(){
        $pasajero = new Pasajero();
        $arregloPasajeros = $pasajero->listar("idviaje=".$this->getIdViaje());
        $cadenaPasajeros = "";
        for($i = 0 ; $i < count($arregloPasajeros) ; $i++){
            $cadenaPasajeros = $cadenaPasajeros . "\nPasajero " . $i . ":\n"
            . $arregloPasajeros[$i]->__toString();
        }
        $cadena = "ID del viaje: " .$this->getIdViaje(). 
        ".\nDestino: " .$this->getDestino(). 
        ".\nCantidad máxima de pasajeros: " .$this->getcantMaxPasajeros().
        ".\nImporte: " .$this->getCostoViaje().
        ".\nPasajeros:\n" .$cadenaPasajeros;
        return $cadena;
    }


    //Función para cargar los atributos de la clase.
    public function cargar(
        $idViaje,
        $destino,
        $cantMaxPasajeros,
        $empresa,
        $responsableV,
        $costoViaje
        ) {
            $this->setIdViaje($idViaje);
            $this->setDestino($destino);
            $this->setcantMaxPasajeros($cantMaxPasajeros);
            $this->setEmpresa($empresa);
            $this->setResponsableV($responsableV);
            $this->setCostoViaje($costoViaje);
        }

    //Función para buscar un viaje a través del código/id del viaje.
    public function Buscar($idViaje){
        $base = new BaseDatos();
        $consultaViaje = "select * from viaje where idviaje=" .$idViaje;
        $resp = false;
        if ($base->Iniciar()){
            if ($base->Ejecutar($consultaViaje)){
                if ($row2 = $base->Registro()){
                    $busquedaResponsable = new ResponsableV();
                    $busquedaResponsable->Buscar($row2["rnumeroempleado"]);

                    $busquedaEmpresa = new Empresa();
                    $busquedaEmpresa->buscar($row2["idempresa"]);
                    $this->cargar($idViaje, $row2['vdestino'], $row2['vcantmaxpasajeros'], $busquedaEmpresa, $busquedaResponsable, $row2['vimporte']);
					$resp= true;
                }
            } else {
                $this->setMensajeOperacion($base->getError());  
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $base = new BaseDatos();
        $resp = false;
        $consultaMod = "UPDATE viaje
                        SET idempresa=" .$this->getEmpresa()->getIdEmpresa().",
                        vdestino='" .$this->getDestino(). "',
                        vcantmaxpasajeros=" .$this->getcantMaxPasajeros(). ",
                        vimporte=" .$this->getCostoViaje(). ",
                        rnumeroempleado=" .$this->getResponsableV()->getNroEmpleado(). "
                        WHERE idviaje=" .$this->getIdViaje();
        if ($base->Iniciar()){
            if($base->Ejecutar($consultaMod)){
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function insertar(){
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO viaje(vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte)
                            VALUES ('" .$this->getDestino(). "',"
                            .$this->getcantMaxPasajeros(). ", "
                            .$this->getEmpresa()->getIdEmpresa(). ", "
                            .$this->getResponsableV()->getNroEmpleado(). ", "
                            .$this->getCostoViaje(). ")";
        if ($base->Iniciar()){
            $id = $base->devuelveIDInsercion($consultaInsertar);
            if ($id != null) {
                 $this->setIdViaje($id);
                 $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
         return $resp;
    }



    public function eliminar(){
        $base = new BaseDatos();
        $resp = false;
        $pasajero = new Pasajero();
        $pasajerosViaje = $pasajero->listar("idviaje=" .$this->getIdViaje());
        for ($i = 0; $i < count($pasajerosViaje); $i++){
            $pasajerosViaje[$i]->eliminar();
        }
        if ($base->Iniciar()){
            $consultaEliminar = "DELETE FROM viaje WHERE idviaje=" .$this->getIdViaje();
            if ($base->Ejecutar($consultaEliminar)){
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public static function listar($condicion=""){
        $arregloViajes = null;
		$base = new BaseDatos();
		$consultaViaje = "select * from viaje";
		if ($condicion != ""){
		    $consultaViaje .= ' where '.$condicion;
		}
		$consultaViaje.=" order by idviaje ";
		if($base->Iniciar()){
		    if($base->Ejecutar($consultaViaje)){				
			    $arregloViajes = array();
				while($row2 = $base->Registro()){
					$viaje = new Viaje();
                    $viaje->buscar($row2['idviaje']);
					array_push($arregloViajes,$viaje);
				}
		 	}	else {
		 			$this->setMensajeOperacion($base->getError());
			}
		 }	else {
		 		$this->setMensajeOperacion($base->getError());
		 }	
		 return $arregloViajes;
    }
}