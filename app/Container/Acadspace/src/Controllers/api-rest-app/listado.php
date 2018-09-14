<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/html; charset=utf-8');

include_once 'database.php';
/*
$dns = "mysql:host=localhost;dbname=acadspace";
$user = "root";
$pass = "";*/

try {
  $database = new Database();
  $con = $database->getConnection("acadspace");
	//$con = new PDO($dns, $user, $pass);

	if(!$con){
		echo "No se puede conectar a la base de datos";
	}

	$query = $con->prepare('SELECT ESP_Nombre_Espacio, PK_ESP_id_Espacio FROM tbl_espacios');

		$query->execute();

		$registros = "[";

		while($result = $query->fetch()){
			if ($registros != "[") {
				$registros .= ",";
			}
			$registros .= '{"id": "'.$result["PK_ESP_id_Espacio"].'",';
			$registros .= '"name": "'.$result["ESP_Nombre_Espacio"].'",';
			$registros .= '"price": "'.$result["ESP_Nombre_Espacio"].'"}';
		}
		$registros .= "]";
		echo $registros;



} catch (Exception $e) {
	echo "Erro: ". $e->getMessage();
};
