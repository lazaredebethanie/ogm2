<?php

include "../actions/FamillesAchatActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$famillesAchat = new FamillesAchatActions($db);
$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$result = $famillesAchat->getAll(array(
		"code" => $_GET["code"],
		"designation" => $_GET["designation"],
		));
		break;
		
	case "POST":
		$result = $famillesAchat->insert(array(
		"code" => $_POST["code"],
		"designation" => $_POST["designation"],
		));
		break;
		
	case "PUT":
		parse_str(file_get_contents("php://input"), $_PUT);
		
		$result = $famillesAchat->update(array(
				"id" => intval($_PUT["id"]),
				"code" => $_PUT["code"],
				"designation" => $_PUT["designation"],
		));
		break;
		
	case "DELETE":
		parse_str(file_get_contents("php://input"), $_DELETE);
		
		$result = $famillesAchat->remove(intval($_DELETE["id"]));
		break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>

