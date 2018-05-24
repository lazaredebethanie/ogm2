<?php

include "../actions/BudgetYearsActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$budgetYears = new BudgetYearsActions($db);
$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$period_id= isset($_GET['period_id']) ? $_GET['period_id'] : NULL;
		//$year= isset($_GET['year']) ? $_GET['year'] : NULL;
		//$amount= isset($_GET['amount']) ? $_GET['amount'] : NULL;
		$result = $budgetYears->getAll($period_id);
		break;
		
	case "POST":
		$result = $budgetYears->insert(array(
		"year" => $_POST["year"],
		"amount" => $_POST["amount"],
		));
		break;
		
	case "PUT":
		parse_str(file_get_contents("php://input"), $_PUT);
		
		$result = $budgetYears->update(array(
				"id" => intval($_PUT["id"]),
				"year" => $_PUT["year"],
				"amount" => $_PUT["amount"],
		));
		break;
		
	case "DELETE":
		parse_str(file_get_contents("php://input"), $_DELETE);
		
		$result = $budgetYears->remove(intval($_DELETE["id"]));
		break;
}


header("Content-Type: application/json");
echo json_encode($result);

//echo json_encode($result[1]);

?>

