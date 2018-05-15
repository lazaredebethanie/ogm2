<?php

include "../actions/MaintenanceLinesPeriodsActions.php";

$config = include("../db/config.php");
$option=array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$db = new PDO($config["db"], $config["username"], $config["password"],$option );
$maintenanceLinesPeriods= new MaintenanceLinesPeriodsActions($db);
$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {

    case "GET":
    	$id=isset($_GET['id']) ? $_GET['id'] : NULL;
    	$description= isset($_GET['description']) ? $_GET['description'] : NULL;
    	$begin= isset($_GET['begin']) ? $_GET['begin'] : NULL;
    	$end= isset($_GET['end']) ? $_GET['end'] : NULL;
    	$total_amount= isset($_GET['total_amount']) ? $_GET['total_amount'] : NULL;
    	$multi_years= isset($_GET['multi_years']) ? $_GET['multi_years'] : NULL;
    	$life_cycle_state_id= isset($_GET['life_cycle_state_id']) ? $_GET['life_cycle_state_id'] : NULL;
    	$comments= isset($_GET['comments']) ? $_GET['comments'] : NULL;
    	$result = $maintenanceLinesPeriods->getAll($id,array(
    			"description" => $description,
    			"begin" => $begin,
    			"end" => $end,
    			"total_amount" => $total_amount,
    			"multi_years" => $multi_years,
    			"life_cycle_state_id" => $life_cycle_state_id,
    			"comments" => $comments
    	));
    	break;
    	
    case "POST":
    	$result = $maintenanceLinesPeriods->insert(array(
        "name_contract" => $_POST["name_contract"],
        "reference" => $_POST["reference"],
        "supplier_id" => $_POST["supplier_id"],
        "purchase_type_id" => $_POST["purchase_type_id"],
        "maintenance_type_id" => $_POST["maintenance_type_id"],
        "purchase_date" => "000-00-00",
        "renewal_date" => $_POST["renewal_date"],
        "total_amount" => $_POST["total_amount"],
        "business_unit_id" => $_POST["business_unit_id"],
        "paid_by_id" => $_POST["paid_by_id"],
        "comments" => "",
    	));
        break;
        
    case "PUT":
        parse_str(file_get_contents("php://input"), $_PUT);
        
        $result = $maintenanceLinesPeriods->update(array(
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
        
        $result = $maintenanceLinesPeriods->remove(intval($_DELETE["id"]));
        break;
}



header("Content-Type: application/json");
echo json_encode($result);
/*$json=json_encode($result);
switch (json_last_error()) {
	case JSON_ERROR_NONE:
		echo ' - No errors';
		break;
	case JSON_ERROR_DEPTH:
		echo ' - Maximum stack depth exceeded';
		break;
	case JSON_ERROR_STATE_MISMATCH:
		echo ' - Underflow or the modes mismatch';
		break;
	case JSON_ERROR_CTRL_CHAR:
		echo ' - Unexpected control character found';
		break;
	case JSON_ERROR_SYNTAX:
		echo ' - Syntax error, malformed JSON';
		break;
	case JSON_ERROR_UTF8:
		echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
		break;
	default:
		echo ' - Unknown error';
		break;
}
echo PHP_EOL;
*/

?>

