<?php

include "../actions/BusinessUnitsActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$businessUnits = new BusinessUnitsActions($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$result = $businessUnits->getAll(array(
		"acronym" => $_GET["acronym"],
		"nameBU" => $_GET["nameBU"],
		));
		break;
		
	case "POST":
		$result = $businessUnits->insert(array(
		"acronym" => $_POST["acronym"],
		"nameBU" => $_POST["nameBU"],
		));
		break;
		
	case "PUT":
		parse_str(file_get_contents("php://input"), $_PUT);
		
		$result = $businessUnits->update(array(
				"id" => intval($_PUT["id"]),
				"acronym" => $_PUT["acronym"],
				"nameBU" => $_PUT["nameBU"],
		));
		break;
		
	case "DELETE":
		parse_str(file_get_contents("php://input"), $_DELETE);
		
		$result = $businessUnits->remove(intval($_DELETE["id"]));
		break;
}



header("Content-Type: application/json");
echo json_encode($result);


?>

