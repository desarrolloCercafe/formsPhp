<?php

include_once("accion.php");
include_once("id_forms.php");

$accion = new Acciones();
//$forms = new Formulario();

//$PosicionInicio = $accion->CountUsers();

require __DIR__ . '/vendor/autoload.php';

$client = new \Google_Client();
$client->setApplicationName('Google Sheets and Php');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__.'/credentials.json');
$service = new Google_Service_Sheets($client);

$cantidadForms = Count($formularios);

for($i=0; $i<$cantidadForms; $i++){

	$finForm = array(
			'A','B','C','D','E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
			'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV',
			'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE',
		);

	$posicionInicio = $accion->CountColumns($formularios[$i]['nombreTable']);
	$range = "!B".($posicionInicio+2).":".$finForm[($formularios[$i]['cantidadCampos'] + 1)]."";
	$response = $service->spreadsheets_values->get($formularios[$i]['id'], $range);
	$values = $response->getValues();

//	echo $finForm[$formularios[$i]['cantidadCampos'] + 1]."\r\n";

	if(empty($values)){
		echo "No hay nueva información.\n";
	}else{
	    $data = [];
	    foreach ($values as $row) {
		for($j=0;$j<$formularios[$i]['cantidadCampos'];$j++){
			if($row[$j] == ""){
				//echo "esta vacío\r\n";
				//array_push($data, "0");
				$row[$j]="NULL";
			}
		}

		array_push($data, $row);

	    }

//	    var_dump($data);
	    $cantidadCiclos = Count($data);

//Esto esta bueno, no borrarlo
	    $responseServer = $accion->InsertColumns($data, $cantidadCiclos, $formularios[$i]['nameFields'], $formularios[$i]['nombreTable']);

	        if($responseServer){
		        echo "Los datos han sido ingresados correctamente\r\n";
    		}else{
		        echo "Ha ocurrido un error\r\n";
    		}
	}
}
?>
