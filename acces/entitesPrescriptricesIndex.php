<?php

include "../actions/EntitesPrescriptricesActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$entitesPrescriptrices = new EntitesPrescriptricesActions($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$result = $entitesPrescriptrices->getAll(array(
		"acronyme" => $_GET["acronyme"],
		"nom" => $_GET["nom"],
		));
		break;
		
	case "POST":
		$result = $entitesPrescriptrices->insert(array(
		"acronyme" => $_POST["acronyme"],
		"nom" => $_POST["nom"],
		));
		break;
		
	case "PUT":
		parse_str(file_get_contents("php://input"), $_PUT);
		
		$result = $entitesPrescriptrices->update(array(
				"id" => intval($_PUT["id"]),
				"acronyme" => $_PUT["acronyme"],
				"nom" => $_PUT["nom"],
		));
		break;
		
	case "DELETE":
		parse_str(file_get_contents("php://input"), $_DELETE);
		
		$result = $entitesPrescriptrices->remove(intval($_DELETE["id"]));
		break;
}



header("Content-Type: application/json");
echo json_encode($result);


?>

