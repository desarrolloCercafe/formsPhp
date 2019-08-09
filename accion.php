<?php

include_once("conexion.php");

class Acciones{

    private $conexion;

    function __construct(){
        $this->conexion = new Conn();
    }

    public function CountColumns($nameTable){

	$sql = "SELECT id FROM ".$nameTable."";

        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();

        $count = $consulta->rowCount();

        return $count;
    }

    public function InsertColumns($data, $cantidadCiclos, $nameFields,  $nameTable){

//	echo "'".implode($nameFields, "','")."'\r\n";
//	echo "'".utf8_decode(implode($data[0], "','"))."'";
	for($i=0; $i<$cantidadCiclos; $i++){

            $sql = "INSERT INTO ".$nameTable."(".implode($nameFields, ",").") VALUES ('".utf8_decode(implode($data[$i], "','"))."')";

	    $consulta = $this->conexion->prepare($sql);

      	    $consulta->execute();
//		echo implode($nameFields, ',')."";
//		echo $sql;
	}
	return true;
    }
}

?>
