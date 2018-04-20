<?php

include "../actions/TypesMaintenanceActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$typesMaintenance = new TypesMaintenanceActions($db);
//$_SERVER["REQUEST_METHOD"]="POST";

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$type= isset($_GET['type']) ? $_GET['type'] : NULL;
		$result = $typesMaintenance->getAll(array(
				"type" => $type
		));
		break;
		
	case "POST":
		$result = $typesMaintenance->insert(array(
		"type" => $_POST["type"]
		));
		break;
		
	case "PUT":
		parse_str(file_get_contents("php://input"), $_PUT);
		
		$result = $typesMaintenance->update(array(
				"id" => intval($_PUT["id"]),
				"type" => $_PUT["type"]
		));
		break;
		
	case "DELETE":
		parse_str(file_get_contents("php://input"), $_DELETE);
		
		$result = $typesMaintenance->remove(intval($_DELETE["id"]));
		break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>

