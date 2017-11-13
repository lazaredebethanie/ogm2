<?php

include "../actions/GroupesFournisseursActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$groupesFournisseur = new GroupesFournisseursActions($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$result = $groupesFournisseur->getAll(array(
		"groupe" => $_GET["groupe"]
		));
		break;
		
	case "POST":
		$result = $groupesFournisseur->insert(array(
		"groupe" => $_POST["groupe"]
		));
		break;
		
	case "PUT":
		parse_str(file_get_contents("php://input"), $_PUT);
		
		$result = $groupesFournisseur->update(array(
				"id" => intval($_PUT["id"]),
				"groupe" => $_PUT["groupe"]
		));
		break;
		
	case "DELETE":
		parse_str(file_get_contents("php://input"), $_DELETE);
		
		$result = $groupesFournisseur->remove(intval($_DELETE["id"]));
		break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>

