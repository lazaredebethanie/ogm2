<?php

include "../actions/PaidByActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$paidBy = new PaidByActions($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$paidByEntity= isset($_GET['paidByEntity']) ? $_GET['paidByEntity'] : NULL;
		$longName= isset($_GET['longName']) ? $_GET['longName'] : NULL;
		$result = $paidBy->getAll(array(
				"paidByEntity" => $paidByEntity,
				"longName" => $longName,
		));
		break;
		
	case "POST":
		$result = $paidBy->insert(array(
		"paidByEntity" => $_POST["paidByEntity"],
		"longName" => $_POST["longName"],
		));
		break;
		
	case "PUT":
		parse_str(file_get_contents("php://input"), $_PUT);
		
		$result = $paidBy->update(array(
				"id" => intval($_PUT["id"]),
				"paidByEntity" => $_PUT["paidByEntity"],
				"longName" => $_PUT["longName"],
		));
		break;
		
	case "DELETE":
		parse_str(file_get_contents("php://input"), $_DELETE);
		
		$result = $paidBy->remove(intval($_DELETE["id"]));
		break;
}



header("Content-Type: application/json");
echo json_encode($result);


?>

