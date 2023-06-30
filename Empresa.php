<?php
include_once "BaseDatos.php";
class Empresa {
    private $idempresa;
    private $enombre;
    private $edireccion;
    private $mensajeoperacion;

    public function __construct(){
        $this->idempresa = 0;
        $this->enombre = "";
        $this->edireccion = "";
    }

    public function getIdempresa(){
        return $this->idempresa;
    }

    public function getEnombre(){
        return $this->enombre;
    }

    public function getEdireccion(){
        return $this->edireccion;
    }

    public function getmensajeoperacion(){
		return $this->mensajeoperacion ;
	}

    public function setIdempresa($idempresa){
        $this->idempresa=$idempresa;
    }

    public function setEnombre($enombre){
        $this->enombre=$enombre;
    }

    public function setEdireccion($edireccion){
        $this->edireccion=$edireccion;
    }

    public function setMensajeOperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

    public function __toString(){
        $cadena = "\nID de la empresa: " .$this->getIdempresa().
		"\nNombre de la empresa: " . $this->getEnombre().
        "\nDireccion de la empresa: " . $this->getEdireccion() . "\n";
        return $cadena;
    }

	public function cargar($idempresa, $enombre, $edireccion){
        $this->setIdempresa($idempresa);
        $this->setEnombre($enombre);
        $this->setEdireccion($edireccion);
    }

    public function Buscar($idempresa){
		$base = new BaseDatos();
		$consulta = "SELECT * FROM empresa WHERE idempresa=".$idempresa;
		$resp = false;
		if($base->Iniciar()){
			if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){
					$this->cargar($idempresa, $row2['enombre'], $row2['edireccion']);
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
	    $arregloEmpresa = null;
		$base=new BaseDatos();
		$consultaEmpresas="Select * from empresa ";
		if ($condicion != ""){
		    $consultaEmpresas=$consultaEmpresas.' where '.$condicion;
		}
		$consultaEmpresas.=" order by idempresa ";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaEmpresas)){				
				$arregloEmpresa= array();
				while($row2=$base->Registro()){
				    $idempresa=$row2['idempresa'];
					$enombre=$row2['enombre'];
					$edireccion=$row2['edireccion'];
					$empresa=new Empresa();
					$empresa->cargar($idempresa,$enombre,$edireccion);
					array_push($arregloEmpresa,$empresa);
	
				}
				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloEmpresa;
	}	

    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO empresa(enombre, edireccion) 
				VALUES ('".$this->getEnombre()."','".
                $this->getEdireccion()."')";
		if($base->Iniciar()){

			if($id = $base->devuelveIDInsercion($consultaInsertar)){
                $this->setIdempresa($id);
			    $resp = true;

			} else {
					$this->setmensajeoperacion($base->getError());
					
			}

		} else {
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}

    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consultaModifica="UPDATE empresa SET enombre='".$this->getEnombre().
        "',edireccion='".$this->getEdireccion()."' WHERE idempresa=".$this->getIdempresa();
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

    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		$viaje = new Viaje();
		$viajesEmpresa = $viaje->listar("idempresa=" .$this->getIdempresa());
		for ($i = 0; $i < count($viajesEmpresa); $i++) {
			$viajesEmpresa[$i]->eliminar(); 
		}
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM empresa WHERE idempresa="
                .$this->getIdempresa();
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
}