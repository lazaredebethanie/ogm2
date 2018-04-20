<?php

include "../actions/BusinessUnitsActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$businessUnits = new BusinessUnitsActions($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$acronym= isset($_GET['acronym']) ? $_GET['acronym'] : NULL;
		$nameBU= isset($_GET['nameBU']) ? $_GET['nameBU'] : NULL;
		$result = $businessUnits->getAll(array(
				"acronym" => $acronym,
				"nameBU" => $nameBU,
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

