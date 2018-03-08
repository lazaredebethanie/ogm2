<?php

include "../actions/ContractDetailsActions.php";
include "../actions/FournisseursActions.php";
include "../actions/PurchaseTypeActions.php";
include "../actions/TypesMaintenanceActions.php";
include "../actions/BusinessUnitsActions.php";
include "../actions/PaidByActions.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$contractDetails = new ContractDetailsActions($db);
//$_SERVER["REQUEST_METHOD"]="GET";
//$_GET["id"]=10;

//echo $_SERVER["REQUEST_METHOD"];
//echo $_GET["id"];

switch ($_SERVER ["REQUEST_METHOD"]) {
	case "GET" :
		$result = $contractDetails->getById($_GET ["id"]);
		break;
	
	case "POST" :
		$result = $contractDetails->insert ( array (
				"name_contract" => $_POST ["name_contract"],
				"reference" => $_POST ["reference"],
				"supplier_id" => $_POST ["supplier_id"],
				"purchase_type_id" => $_POST ["purchase_type_id"],
				"maintenance_type_id" => $_POST ["maintenance_type_id"],
				// "purchase_date" => $_POST["purchase_date"],
				"purchase_date" => "000-00-00",
				"renewal_date" => $_POST ["renewal_date"],
				"business_unit_id" => $_POST ["business_unit_id"],
				"paid_by_id" => $_POST ["paid_by_id"],
				// "comments" => $_POST["comments"],
				"comments" => "" 
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
				"maintenance_type_id" => $_PUT ["maintenance_type_id"],
				// "purchase_date" => $_PUT["purchase_date"],
				"renewal_date" => $_PUT ["renewal_date"],
				"business_unit_id" => $_PUT ["business_unit_id"],
				"paid_by_id" => $_PUT ["paid_by_id"] 
			// "comments" => $_PUT["comments"],
		) );
		break;
	
	case "DELETE" :
		parse_str ( file_get_contents ( "php://input" ), $_DELETE );
		
		$result = $contractDetails->remove ( intval ( $_DELETE ["id"] ) );
		break;
}

$result_text = new Contracts();

$suppliers=new FournisseursActions($db);
$suppliers_tab=array();
$suppliers_tab= $suppliers->getAll(array(
		"nom_usuel" => "",
		"cofor" => "",
		"groupe_id" => ""));

$purchaseType=new PurchaseTypeActions($db);
$purchase_type_tab=array();
$purchase_type_tab=$purchaseType->getAll(array(
		"type" => ""));


$maintenanceTypes=new TypesMaintenanceActions($db);
$maintenance_type_tab=array();
$maintenance_type_tab=$maintenanceTypes->getAll(array(
		"type" => ""));

$bu=new BusinessUnitsActions($db);
$bu_tab=array();
$bu_tab=$bu->getAll(array(
		"acronym" => "",
		"nameBU" => ""));

$paidBy=new PaidByActions($db);
$paid_by_tab=array();
$paid_by_tab=$paidBy->getAll(array(
		"paidByEntity" => "",
		"longName" => ""));

//header("Content-Type: application/json");
header("Content-Type: text/html");
//echo json_encode($result);
echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "<head>\n";
echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">\n";
echo "<title>Page de test pour le développement...</title>\n";
echo "</head>\n";
echo "<body>\n";
echo "		<form name=\"Contract Details\" action=\"screens/contractDetailsValidate.php\" method=\"POST\" autocomplete=\"on\">\n";
echo "			<input name=\"id\" type=\"hidden\" value=" . $result->id . ">\n";
echo "			<input name=\"supplier_id\" type=\"hidden\" value=" . $result->supplier_id. ">\n";
echo "			<input name=\"purchase_type_id\" type=\"hidden\" value=" . $result->purchase_type_id. ">\n";
echo "			<input name=\"maintenance_type_id\" type=\"hidden\" value=" . $result->maintenance_type_id. ">\n";
echo "			<input name=\"business_unit_id\" type=\"hidden\" value=" . $result->business_unit_id. ">\n";
echo "			<input name=\"paid_by_id\" type=\"hidden\" value=" . $result->paid_by_id. ">\n";
echo "          <TABLE>\n";
echo "          <TR>\n";
echo "			   <TD>Contract Name </TD>\n";
echo "			   <TD><input name=\"name_contract\" type=\"text\" value=\"" . $result->name_contract. "\"></TD>\n";
echo "			   <TD>Reference </TD>\n";
echo "			   <TD><input name=\"reference\" type=\"text\" value=\"" . $result->reference. "\"></TD>\n";
echo "   		</TR>\n";
echo "          <TR>\n";
echo "			   <TD>Supplier </TD>\n";
echo "			   <TD><SELECT name=\"supplier\" size=\"1\">\n";
foreach ($suppliers_tab as $row) {
	if ($row->id==$result->supplier_id) {
		$selected="selected=\"SELECTED\"";
	}
	   else { 
	   	$selected="";
	}
	echo "				<OPTION " . $selected . " value=\"" . $row->id . "\">" . $row->nom_usuel . " \n";
}

//echo "			   <TD><input name=\"supplier\" type=\"text\" value=\"" . $result_text->supplier_id . "\"></TD>\n";
echo "			   </SELECT></TD>\n";
echo "			   <TD>Supplier Code </TD>\n";
echo "			   <TD><input name=\"supplier_code\" type=\"text\" value=\"" . "" . "\"></TD>\n";
echo "   		</TR>\n";
echo "          <TR>\n";
echo "			   <TD>Purchase Family </TD>\n";
echo "			   <TD><input name=\"purchase_family\" type=\"text\" value=\"" . "" . "\"></TD>\n";
echo "   		</TR>\n";
echo "          <TR>\n";
echo "			   <TD>Purchase Type </TD>\n";
echo "			   <TD><SELECT name=\"purchase_type\" size=\"1\">\n";
foreach ($purchase_type_tab as $row) {
	if ($row->id==$result->purchase_type_id) {
		$selected="selected=\"SELECTED\"";
	}
	else {
		$selected="";
	}
	echo "				<OPTION " . $selected . " value=\"" . $row->id . "\">" . $row->type . " \n";
}

//echo "			   <TD><input name=\"purchase_type\" type=\"text\" value=\"" . $result_text->purchase_type_id. "\"></TD>\n";
echo "			   <TD>Purchase Date </TD>\n";
echo "			   <TD><input name=\"purchase_date\" type=\"text\" value=\"" . $result->purchase_date. "\"></TD>\n";
echo "   		</TR>\n";
echo "          <TR>\n";
echo "			   <TD>&nbsp;</TD>\n";
echo "   		</TR>\n";
echo "          <TR>\n";
echo "			   <TD>Maintenance Type </TD>\n";
echo "			   <TD><SELECT name=\"maintenance_type\" size=\"1\">\n";
foreach ($maintenance_type_tab as $row) {
	if ($row->id==$result->maintenance_type_id) {
		$selected="selected=\"SELECTED\"";
	}
	else {
		$selected="";
	}
	echo "				<OPTION " . $selected . " value=\"" . $row->id . "\">" . $row->type . " \n";
}
//echo "			   <TD><input name=\"maintenance_type\" type=\"text\" value=\"" . $result_text->maintenance_type_id. "\"></TD>\n";
echo "			   <TD>Amount </TD>\n";
echo "			   <TD><input name=\"amount\" type=\"text\" value=\"" . "" . "\"></TD>\n";
echo "   		</TR>\n";
echo "          <TR>\n";
echo "			   <TD>Renewal Date</TD>\n";
echo "			   <TD><input name=\"renewal_date\" type=\"text\" value=\"" . $result->renewal_date. "\"></TD>\n";
echo "			   <TD>Duration </TD>\n";
echo "			   <TD><input name=\"maintenance_duration\" type=\"text\" value=\"" . "" . "\"></TD>\n";
echo "   		</TR>\n";
echo "          <TR>\n";
echo "   		</TR>\n";
echo "          <TR>\n";
echo "			   <TD>&nbsp;</TD>\n";
echo "   		</TR>\n";
echo "          <TR>\n";
echo "			   <TD>Business Unit </TD>\n";
echo "			   <TD><SELECT name=\"business_unit\" size=\"1\">\n";
foreach ($bu_tab as $row) {
	if ($row->id==$result->business_unit_id) {
		$selected="selected=\"SELECTED\"";
	}
	else {
		$selected="";
	}
	echo "				<OPTION " . $selected . " value=\"" . $row->id . "\">" . $row->acronym . " \n";
}
//echo "			   <TD><input name=\"business_unit\" type=\"text\" value=\"" . $result_text->business_unit_id. "\"></TD>\n";
echo "			   <TD>Paid by </TD>\n";
echo "			   <TD><SELECT name=\"paid_by\" size=\"1\">\n";
foreach ($paid_by_tab as $row) {
	if ($row->id==$result->paid_by_id) {
		$selected="selected=\"SELECTED\"";
	}
	else {
		$selected="";
	}
	echo "				<OPTION " . $selected . " value=\"" . $row->id . "\">" . $row->paidByEntity . " \n";
}
//echo "			   <TD><input name=\"paid_by\" type=\"text\" value=\"" . $result_text->paid_by_id. "\"></TD>\n";
echo "   		</TR>\n";
echo " 	        </TABLE>\n";
echo "<br><br><button type=\"submit\">Envoi</button>\n";
echo "</form>\n";
echo "</body>\n";
echo "</html>\n";
/*echo $result->id . "\n";
echo $result_text->supplier_id . "\n";
echo $result->reference . "\n";
echo $result->purchase_type_id . " - ";
echo $result_text->purchase_type_id. "\n";
echo $result->maintenance_type_id . " - ";
echo $result_text->maintenance_type_id. "\n";
echo $result->purchase_date . "\n";
echo $result->business_unit_id. " - ";
echo $result_text->business_unit_id. "\n";
echo $result->renewal_date. "\n";
echo $result->paid_by_id. " - ";
echo $result_text->paid_by_id. "\n";
echo $result->comments. "\n";
*/
?>

