<?php

include "../actions/ContractsActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$contracts = new ContractsActions($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
    	$result = $contracts->getAll(array(
        "name_contract" => $_GET["name_contract"],
        "reference" => $_GET["reference"],
        "supplier_id" => $_GET["supplier_id"],
        "purchase_type_id" => $_GET["purchase_type_id"],
        "maintenance_type_id" => $_GET["maintenance_type_id"],
        //"purchase_date" => $_GET["purchase_date"],
        "renewal_date" => $_GET["renewal_date"],
        "total_amount" => $_GET["total_amount"],
        "business_unit_id" => $_GET["business_unit_id"],
        "paid_by_id" => $_GET["paid_by_id"],
        //"comments" => $_GET["comments"],
    	));
        break;
        
    case "POST":
    	$result = $contracts->insert(array(
        "name_contract" => $_POST["name_contract"],
        "reference" => $_POST["reference"],
        "supplier_id" => $_POST["supplier_id"],
        "purchase_type_id" => $_POST["purchase_type_id"],
        "maintenance_type_id" => $_POST["maintenance_type_id"],
        //"purchase_date" => $_POST["purchase_date"],
        "purchase_date" => "000-00-00",
        "renewal_date" => $_POST["renewal_date"],
        "business_unit_id" => $_POST["business_unit_id"],
        "paid_by_id" => $_POST["paid_by_id"],
        //"comments" => $_POST["comments"],
        "comments" => "",
    	));
        break;
        
    case "PUT":
        parse_str(file_get_contents("php://input"), $_PUT);
        
        $result = $contracts->update(array(
                "id" => intval($_PUT["id"]),
                "name_contract" => $_PUT["name_contract"],
                "reference" => $_PUT["reference"],
        		"supplier_id" => $_PUT["supplier_id"],
        		"purchase_type_id" => $_PUT["purchase_type_id"],
        		"maintenance_type_id" => $_PUT["maintenance_type_id"],
        		//"purchase_date" => $_PUT["purchase_date"],
        		"renewal_date" => $_PUT["renewal_date"],
        		"business_unit_id" => $_PUT["business_unit_id"],
        		"paid_by_id" => $_PUT["paid_by_id"],
        		//"comments" => $_PUT["comments"],
        ));
        break;
        
    case "DELETE":
        parse_str(file_get_contents("php://input"), $_DELETE);
        
        $result = $contracts->remove(intval($_DELETE["id"]));
        break;
}



header("Content-Type: application/json");
echo json_encode($result);
?>

