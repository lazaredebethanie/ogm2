<?php

include "../actions/FamillesAchatActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$cyclesLife = new FamillesAchatActions($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$state= isset($_GET['code']) ? $_GET['code'] : NULL;
		$order= isset($_GET['designation']) ? $_GET['designation'] : NULL;
		
		$result = $cyclesLife->getAll(array(
				"code" => $state,
				"designation" => $order,
		));
		break;
		
	case "POST":
		$result = $cyclesLife->insert(array(
		"code" => $_POST["code"],
		"designation" => $_POST["designation"],
		));
		break;
		
	case "PUT":
		parse_str(file_get_contents("php://input"), $_PUT);
		
		$result = $cyclesLife->update(array(
				"id" => intval($_PUT["id"]),
				"code" => $_PUT["code"],
				"designation" => $_PUT["designation"],
		));
		break;
		
	case "DELETE":
		parse_str(file_get_contents("php://input"), $_DELETE);
		
		$result = $cyclesLife->remove(intval($_DELETE["id"]));
		break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>

