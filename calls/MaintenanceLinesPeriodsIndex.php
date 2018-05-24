<?php

include "../actions/MaintenanceLinesPeriodsActions.php";
include "../actions/BudgetYearsActions.php";

$config = include("../db/config.php");
$option=array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$db = new PDO($config["db"], $config["username"], $config["password"],$option );
$maintenanceLinesPeriods= new MaintenanceLinesPeriodsActions($db);
//$_SERVER["REQUEST_METHOD"]="POST";

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
    	/*
    	 * $_POST["addLineBegin"]="2018-05-01";
    	$_POST["addLineEnd"]="2019-04-30";
    	$_POST["contractId"]="4";
    	$_POST["description"]="achat 2017";
    	$_POST["amount"]="10000";
    	$_POST["budget_years"]="yes";
    	*/
    	
    	$dateBegin=$_POST["addLineBegin"];
    	if ($_POST["addLineEnd"]=="") {
    		//$tmp="$dateBegin+".$_POST["nb_unity"]." ".$_POST["time_unity"]."-1 days";
    		$dateEnd=date('Y-m-d',strtotime("$dateBegin+".$_POST["nb_unity"]." ".$_POST["time_unity"]."-1 days"));
    	} else {
    		$dateEnd=$_POST["addLineEnd"];
    	}
    	if ($_POST["budget_years"]=="yes") {
    		$yrb=date("Y",strtotime($dateBegin));
    		$yre=date("Y",strtotime($dateEnd));
    		$budget_years=($yre-$yrb)+1;
    	} else {
    		$budget_years=1;
    	}

    	$daysByYear=array();
    	$year=date('Y',strtotime($dateBegin));
    	$yearEnd=date('Y',strtotime($dateEnd));
    	$dateTimeBegin=new DateTime($dateBegin);
    	$dateTimeEnd=new DateTime($dateEnd);
    	$totalDays=0;
    	$first3112=new DateTime(date('Y-m-d',strtotime($year."-12-31")));
    	$daysByYear[$year][0]=$first3112->diff($dateTimeBegin)->format("%a")+1;
    	$total_days=$daysByYear[$year][0];
    	$year=$year+1;
    	while ($year<$yearEnd) {
	    	$days=0;
	    	if (date("L", mktime(0, 0, 0, 1, 1, $year)) == 1) {
	    		$days=366;
	    	} else {
	    		$days=365;
	    	}
	    	$daysByYear[$year][0]=$days;
	    	$total_days=$total_days+$days;
	    	$year=$years+1;
    	}
    	//$tmp=date('Y-m-d',strtotime($year."-01-01"));
    	$last0101=new DateTime(date('Y-m-d',strtotime($year."-01-01")));
    	$daysByYear[$year][0]=$dateTimeEnd->diff($last0101)->format("%a")+1;
    	$total_days=$total_days+$daysByYear[$year][0];
    	
    	$amoutByDay=$_POST["amount"]/$total_days;
    	
    	$year=date('Y',strtotime($dateBegin));
    	
    	$ctlTotalAmount=0;
    	
    	while ($year<=$yearEnd) {
    	
    		$daysByYear[$year][1]=round($amoutByDay*$daysByYear[$year][0],2);
    		$ctlTotalAmount=$ctlTotalAmount+$daysByYear[$year][1];
    		$year=$year+1;
    	}
    	
    	if ($ctlTotalAmount!=$_POST["amount"]) {
    		// to implement
    	}
    	
    	$result = $maintenanceLinesPeriods->insert(array(
        "contract_id" => $_POST["contractId"],
        "description" => $_POST["description"],
    	"begin" => $dateBegin,
    	"end" => $dateEnd,
        "total_amount" => $_POST["amount"],
     	"multi_years" => $budget_years,
    			
    	));
    	
    	If ($result->id != "") {
    		$budgetYears= new BudgetYearsActions($db);
    		$result2=$budgetYears->insert($result->id,$daysByYear);
    		
    	}
    	
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
echo PHP_EOL;*/


?>

