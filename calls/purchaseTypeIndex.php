<?php

include "../actions/PurchaseTypeActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$purchaseType = new PurchaseTypeActions($db);
//$_SERVER["REQUEST_METHOD"]="DELETE";

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$type= isset($_GET['type']) ? $_GET['type'] : NULL;
		$result = $purchaseType->getAll(array(
		"type" => $type
		));
		break;
		
	case "POST":
		$result = $purchaseType->insert(array(
		"type" => $_POST["type"]
		));
		break;
		
	case "PUT":
		parse_str(file_get_contents("php://input"), $_PUT);
		
		$result = $purchaseType->update(array(
				"id" => intval($_PUT["id"]),
				"type" => $_PUT["type"]
		));
		break;
		
	case "DELETE":
		parse_str(file_get_contents("php://input"), $_DELETE);
		
		$result = $purchaseType->remove(intval($_DELETE["id"]));
		//$result = $purchaseType->remove(8);
		break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>

