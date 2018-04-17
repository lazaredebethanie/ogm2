<?php

include "../actions/TypesEvolutionsActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$typesEvolutions = new TypesEvolutionsActions($db);
//$_SERVER["REQUEST_METHOD"]="POST";

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$result = $typesEvolutions->getAll(array(
		"type" => $_GET["type"]
		));
		break;
		
	case "POST":
		$result = $typesEvolutions->insert(array(
		"type" => $_POST["type"]
		));
		break;
		
	case "PUT":
		parse_str(file_get_contents("php://input"), $_PUT);
		
		$result = $typesEvolutions->update(array(
				"id" => intval($_PUT["id"]),
				"type" => $_PUT["type"]
		));
		break;
		
	case "DELETE":
		parse_str(file_get_contents("php://input"), $_DELETE);
		
		$result = $typesEvolutions->remove(intval($_DELETE["id"]));
		break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>

