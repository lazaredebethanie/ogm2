<?php

include "../actions/LifeCyclesActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$cyclesLife = new LifeCyclesActions($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$state= isset($_GET['state']) ? $_GET['state'] : NULL;
		$rank= isset($_GET['rank']) ? $_GET['rank'] : NULL;
		
		$result = $cyclesLife->getAll(array(
				"state" => $state,
				"rank" => $rank,
		));
		break;
		
	case "POST":
		$result = $cyclesLife->insert(array(
		"state" => $_POST["state"],
		"rank" => $_POST["rank"],
		));
		break;
		
	case "PUT":
		parse_str(file_get_contents("php://input"), $_PUT);
		
		$result = $cyclesLife->update(array(
				"id" => intval($_PUT["id"]),
				"state" => $_PUT["state"],
				"rank" => $_PUT["rank"],
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

