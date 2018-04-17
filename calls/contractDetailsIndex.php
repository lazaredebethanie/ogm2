<?php

include "../actions/ContractDetailsActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$contractDetails = new ContractDetailsActions($db);

// ************************** pour le DEBUG *************************************
if (! isset($_SERVER["REQUEST_METHOD"])){
	$_SERVER["REQUEST_METHOD"]="GET";
	
}
if (! isset($_GET["id"] )) {
	$_GET["id"]=10;
 	}
// *******************************************************************************
 	
switch ($_SERVER ["REQUEST_METHOD"]) {
	case "GET" :
	    $id= isset($_GET['id']) ? $_GET['id'] : NULL;
		$result = $contractDetails->getById($_GET ["id"]);
		break;
	
	case "POST" :
		$result = $contractDetails->insert ( array (
				"name_contract" => $_POST ["name_contract"],
				"reference" => $_POST ["reference"],
				"supplier_id" => $_POST ["supplier_id"],
				"purchase_type_id" => $_POST ["purchase_type_id"],
				"purchase_family_id" => $_POST ["purchase_family_id"],
				"maintenance_type_id" => $_POST ["maintenance_type_id"],
				"purchase_date" => $_POST["purchase_date"],
				"renewal_date" => $_POST ["renewal_date"],
				"end_date" => $_POST ["end_date"],
				"total_amount" => $_POST ["total_amount"],
				"business_unit_id" => $_POST ["business_unit_id"],
				"paid_by_id" => $_POST ["paid_by_id"],
				"comments" => $_POST["comments"],
		) );
		break;
	
	case "PUT" :
		parse_str ( file_get_contents ( "php://input" ), $_PUT );
		
		$result = $contractDetails->update ( array (
				"id" => intval ( $_PUT ["id"] ),
				"name_contract" => $_PUT ["name_contract"],
				"reference" => $_PUT ["reference"],
				"supplier_id" => $_PUT ["supplier_id"],
				"purchase_type_id" => $_PUT ["purchase_type_id"],
				"purchase_family_id" => $_PUT ["purchase_family_id"],
				"maintenance_type_id" => $_PUT ["maintenance_type_id"],
				"purchase_date" => $_PUT["purchase_date"],
				"renewal_date" => $_PUT ["renewal_date"],
				"end_date" => $_PUT ["end_date"],
				"total_amount" => $_PUT ["total_amount"],
				"business_unit_id" => $_PUT ["business_unit_id"],
				"paid_by_id" => $_PUT ["paid_by_id"], 
			    "comments" => $_PUT["comments"]
		) );
		break;
	
	case "DELETE" :
		parse_str ( file_get_contents ( "php://input" ), $_DELETE );
		
		$result = $contractDetails->remove ( intval ( $_DELETE ["id"] ) );
		break;
}


header("Content-Type: application/json");
echo json_encode($result);
?>

