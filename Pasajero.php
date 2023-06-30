<?php
include_once "BaseDatos.php";

class Pasajero{
    //Atributos
    private $papellido;
    private $pnombre;
    private $pdocumento;
    private $ptelefono;
    private $viaje;
    private $mensajeoperacion;

    //Métodos
    public function __construct() {
        $this->pnombre = "";
        $this->papellido = "";
        $this->pdocumento = 0;
        $this->ptelefono= "";
        $this->viaje = "";
    }
        
    //Retorno de métodos
    public function getPnombre(){
        return $this->pnombre;
    }

    public function getPapellido(){
        return $this->papellido;
    }

    public function getPdocumento(){
        return $this->pdocumento;
    }

    public function getPtelefono(){
        return $this->ptelefono;
    }

    public function getViaje(){
        return $this->viaje;
    }
    //Seteo de valores
    public function setPnombre($pnombre){
        $this->pnombre=$pnombre;
    }

    public function setPapellido($papellido){
        $this->papellido=$papellido;
    }

    public function setPdocumento($pdocumento){
        $this->pdocumento=$pdocumento;
    }

    public function setPtelefono($ptelefono){
        $this->ptelefono=$ptelefono;
    }

    public function setViaje($viaje){
        $this->viaje=$viaje;
    }

    public function __toString(){
        $cadena = "\nNombre: " .$this->getPnombre().
                ".\nApellido: " .$this->getPapellido().
                ".\nDNI: " .$this->getPdocumento().
                ".\nNúmero de teléfono: " .$this->getPtelefono(). "\n";
        return $cadena;
    }

    public function cargar($pnombre, $papellido, $pdocumento, $ptelefono, $viaje){
        $this->setPnombre($pnombre);
        $this->setPapellido($papellido);
        $this->setPdocumento($pdocumento);
        $this->setPtelefono($ptelefono);
		$this->setViaje($viaje);
    }

    public function Buscar($pdocumento){
		$base=new BaseDatos();
		$consulta="SELECT * FROM pasajero WHERE pdocumento=".$pdocumento;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){
                    $viajeBusqueda = new Viaje();
                    $viajeBusqueda->buscar($row2["idviaje"]);

					$this->cargar($row2['pnombre'], $row2['papellido'], $pdocumento, $row2['ptelefono'], $viajeBusqueda);
					//$pnombre, $papellido, $pdocumento, $ptelefono, $viaje
					$resp= true;
				}
		 	} else {
		 		$this->setmensajeoperacion($base->getError());
			}
		} else {
				$this->setmensajeoperacion($base->getError());
		    }
		return $resp;
	}

    public static function listar($condicion=""){
	    $arregloPasajero = null;
		$base=new BaseDatos();
		$consultaPasajeros="Select * from pasajero ";
		if ($condicion != ""){
		    $consultaPasajeros=$consultaPasajeros.' where '.$condicion;
		}
		$consultaPasajeros.=" order by pdocumento ";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPasajeros)){				
				$arregloPasajero= array();
				while($row2=$base->Registro()){
				    $pdocumento=$row2['pdocumento'];
					$pnombre=$row2['pnombre'];
					$papellido=$row2['papellido'];
					$ptelefono=$row2['ptelefono'];
                    
                    $viaje=new Viaje();
                    $viaje->buscar($row2["idviaje"]);
				
					$pasajero = new pasajero();
					$pasajero->cargar($pnombre, $papellido, $pdocumento, $ptelefono, $viaje);
                    //$idviaje, $vdestino, $vcantmaxpasajeros, $empresa, $responsable, $vimporte
					array_push($arregloPasajero,$pasajero);
	
				}
				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloPasajero;
	}

    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO pasajero(pdocumento, pnombre, papellido, ptelefono, idviaje)
				VALUES ('".$this->getPdocumento()."','".$this->getPnombre().
                "','".$this->getPapellido()."','".
                $this->getPtelefono()."','".
                $this->getViaje()->getIdViaje()."')";
		if($base->Iniciar()){

			if($base->Ejecutar($consultaInsertar)){
			    $resp = true;

			} else {
					$this->setmensajeoperacion($base->getError());
					
			}

		} else {
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}

    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM pasajero WHERE pdocumento="
                .$this->getPdocumento();
				if($base->Ejecutar($consultaBorra)){
				    $resp=  true;
				}else{
						$this->setmensajeoperacion($base->getError());
					
				}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp; 
	}

    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consultaModifica="UPDATE pasajero SET pnombre='".$this->getPnombre().
        "',papellido='".$this->getPapellido()."',ptelefono='".
        $this->getPtelefono()."',idViaje=". 
        $this->getViaje()->getIdViaje()." WHERE pdocumento=".$this->getPdocumento();
		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $resp=  true;
			}else{
				$this->setmensajeoperacion($base->getError());
				
			}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}
}