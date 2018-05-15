<?php

include "../actions/FournisseursActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$fournisseursbusinessUnits = new FournisseursActions($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$nom_usuel= isset($_GET['nom_usuel']) ? $_GET['nom_usuel'] : NULL;
		$cofor= isset($_GET['cofor']) ? $_GET['cofor'] : NULL;
		$groupe_id= isset($_GET['groupe_id']) ? $_GET['groupe_id'] : NULL;
		
	    $result = $fournisseursbusinessUnits->getAll(array(
	    		"nom_usuel" => $nom_usuel,
	    		"cofor" => $cofor,
	    		"groupe_id" => $groupe_id
		
		));
		break;
		
	case "POST":
		$result = $fournisseursbusinessUnits->insert(array(
		"nom_usuel" => $_POST["nom_usuel"],
		"cofor" => $_POST["cofor"],
		"groupe_id" => $_POST["groupe_id"],
		));
		break;
		
	case "PUT":
		parse_str(file_get_contents("php://input"), $_PUT);
		
		$result = $fournisseursbusinessUnits->update(array(
				"id" => intval($_PUT["id"]),
				"nom_usuel" => $_PUT["nom_usuel"],
				"cofor" => $_PUT["cofor"],
		        "groupe_id" => $_PUT["groupe_id"],
		));
		break;
		
	case "DELETE":
		parse_str(file_get_contents("php://input"), $_DELETE);
		
		$result = $fournisseursbusinessUnits->remove(intval($_DELETE["id"]));
		break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>

