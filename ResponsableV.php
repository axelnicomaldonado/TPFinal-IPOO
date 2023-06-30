<?php
include_once "BaseDatos.php";

class ResponsableV{
    //Atributos
    private $nroEmpleado;
    private $nroLicencia;
    private $nombre;
    private $apellido;
    private $mensajeoperacion;

    //Método
    public function __construct() {
        $this->nroEmpleado = 0;
        $this->nroLicencia = "";
        $this->nombre = "";
        $this->apellido = "";
    }

    //Retorno de métodos
    public function getNroEmpleado(){
        return $this->nroEmpleado;
    }

    public function getNroLicencia(){
        return $this->nroLicencia;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getmensajeoperacion(){
		return $this->mensajeoperacion;
	}

    //Seteo de valores
    public function setNroEmpleado($nroEmpleado){
        $this->nroEmpleado=$nroEmpleado;
    }

    public function setNroLicencia($nroLicencia){
        $this->nroLicencia=$nroLicencia;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function setApellido($apellido){
        $this->apellido=$apellido;
    }

    public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

    public function __toString(){
        $cadena = "\nNombre: " .$this->getNombre(). 
        ".\nApellido: " .$this->getApellido(). 
        ".\nNúmero de licencia: " .$this->getNroLicencia(). 
        ".\nNúmero de empleado: " .$this->getNroEmpleado(). "\n";
        return $cadena;
    }
    
    public function cargar($nroEmpleado, $nroLicencia, $nombre, $apellido){
        $this->setNroEmpleado($nroEmpleado);
        $this->setNroLicencia($nroLicencia);
        $this->setNombre($nombre);
        $this->setApellido($apellido);
    }

    public function Buscar($nroEmpleado){
		$base=new BaseDatos();
		$consulta="SELECT * FROM responsable WHERE rnumeroempleado=".$nroEmpleado;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consulta)){
				if($row2=$base->Registro()){
					$this->cargar($nroEmpleado, $row2['rnumerolicencia'], $row2['rnombre'], $row2['rapellido']);
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
	    $arregloResponsable = null;
		$base=new BaseDatos();
		$consultaResponsables="SELECT * from responsable ";
		if ($condicion != ""){
		    $consultaResponsables=$consultaResponsables.' WHERE '.$condicion;
		}
		$consultaResponsables.=" ORDER BY rnumeroempleado ";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaResponsables)){				
				$arregloResponsable= array();
				while($row2=$base->Registro()){
				    $nroEmpleado=$row2['rnumeroempleado'];
					$nroLicencia=$row2['rnumerolicencia'];
					$nombre=$row2['rnombre'];
					$apellido=$row2['rapellido'];
					$responsable=new ResponsableV();
					$responsable->cargar($nroEmpleado,$nroLicencia,$nombre,$apellido);
                    //$rnumeroempleado, $vdestino, $vcantmaxpasajeros, $empresa, $responsable, $vimporte
					array_push($arregloResponsable,$responsable);
	
				}
				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }	
		 return $arregloResponsable;
	}
    
    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO responsable(rnumerolicencia, rnombre, rapellido) 
				VALUES ('".$this->getNroLicencia().
                "','".$this->getNombre()."','".
                $this->getApellido()."')";
		if($base->Iniciar()){

			if($id = $base->devuelveIDInsercion($consultaInsertar)){
                $this->setNroEmpleado($id);
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
		$consultaModifica="UPDATE responsable SET rnumerolicencia='".$this->getNroLicencia().
        "',rnombre='".$this->getNombre()."',rapellido='".
        $this->getApellido()."' WHERE rnumeroempleado=".$this->getNroEmpleado();
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
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM responsable WHERE rnumeroempleado="
                .$this->getNroEmpleado();
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