<?php

include "../actions/ContractDetailsActions.php";
include "../actions/FournisseursActions.php";
include "../actions/PurchaseTypeActions.php";
include "../actions/FamillesAchatActions.php";
include "../actions/TypesMaintenanceActions.php";
include "../actions/BusinessUnitsActions.php";
include "../actions/PaidByActions.php";

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
if ($_SERVER["REQUEST_METHOD"]=="POST") {
	switch ($_POST["method"]) {
		case "PUT" : 
			$_SERVER["REQUEST_METHOD"]="PUT";
			$_PUT=$_POST;
			break;
		case "DELETE" :
			$_SERVER["REQUEST_METHOD"]="DELETE";
			break;
			case "POST" :
			$_SERVER["REQUEST_METHOD"]="POST";
			break;
	}
} 	
 	
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
//If ($_SERVER["REQUEST_METHOD"]=="PUT") {
//	$_GET=$_POST;
//}
		$result_text = new Contracts();
		
		$suppliers=new FournisseursActions($db);
		$suppliers_tab=array();
		$suppliers_tab= $suppliers->getAll(array(
				"nom_usuel" => "",
				"cofor" => "",
				"groupe_id" => ""));
		
		$purchaseFamily=new FamillesAchatActions($db);
		$purchase_family_tab=array();
		$purchase_family_tab=$purchaseFamily->getAll(array(
				"code" => "",
				"designation" => ""));
		
		
		
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
		echo " <link type=\"text/css\" rel=\"stylesheet\" media=\"all\" title=\"CSS\" href=\"../css/ogm.css\" /> \n";
		echo " <link type=\"text/css\" rel=\"stylesheet\" media=\"all\" title=\"CSS\" href=\"../css/onglets2.css\" /> \n";
		echo "</head>\n";
		echo "<body>\n";
		echo " <div class=\"onglets_html\">\n";
		echo "  <DIV class=\"tabs_panels\">\n";
		echo "  <DIV class=\"onglets\">\n";
		echo "     <DIV class=\"onglet_y onglet\"><a href=\"../screens/contractDetails.php\">Contract Details</a></DIV>\n";
		echo "     <DIV class=\"onglet_n onglet\"><a href=\"../screens/maintenance_lines.html\">Maintenance Lines</a></DIV>\n";
		echo "  </DIV>\n";
		echo "  <DIV class=\"contenu\">\n";
		echo "		<H1>Details of " . $result->name_contract." </H1> \n";
		echo "		<form name=\"Contract Details\" action=\"contractDetails.php\" method=\"POST\" autocomplete=\"on\">\n";
		echo "			<INPUT name=\"method\" type=\"hidden\" value=\"PUT\">\n";	
		echo "			<INPUT name=\"id\" type=\"hidden\" value=\"" .  $result->id . "\">\n";
		echo "          <TABLE>\n";
		echo "          <TR>\n";
		echo "			   <TD>Contract Name </TD>\n";
		echo "			   <TD colspan=\"3\"><input name=\"name_contract\" type=\"text\" size=\"60\" value=\"" . $result->name_contract. "\"></TD>\n";
		echo "   		</TR>\n";
		echo "          <TR>\n";
		echo "			   <TD>Reference </TD>\n";
		echo "			   <TD><input name=\"reference\" type=\"text\" value=\"" . $result->reference. "\"></TD>\n";
		echo "   		</TR>\n";
		echo "          <TR>\n";
		echo "			   <TD>Supplier </TD>\n";
		echo "			   <TD><SELECT name=\"supplier_id\" size=\"1\" onChange=\"changeVal(event)\">\n";
		foreach ($suppliers_tab as $row) {
			if ($row->id==$result->supplier_id) {
				$selected="selected=\"SELECTED\"";
				$cofor=$row->cofor;
			}
			   else { 
			   	$selected="";
			}
			echo "				<OPTION " . $selected . " value=\"" . $row->id ."|".$row->cofor . "\">" . $row->nom_usuel . " \n";
		}
		
		echo "			   </SELECT></TD>\n";
		echo "			   <TD>Supplier Code </TD>\n";
		echo "			   <TD><input name=\"supplier_code\" type=\"text\" value=\"" . $cofor . "\" disabled ></TD>\n";
		echo "   		</TR>\n";
		echo "          <TR>\n";
		echo "			   <TD>Purchase Family </TD>\n";
		echo "			   <TD colspan=\"3\"><SELECT name=\"purchase_family_id\" size=\"1\">\n";
		echo "				<OPTION  value=\"0\"> \n";
		foreach ($purchase_family_tab as $row) {
			if ($row->id==$result->purchase_family_id) {
				$selected="selected=\"SELECTED\"";
			}
			else {
				$selected="";
			}
			echo "				<OPTION " . $selected . " value=\"" . $row->id . "\">" . $row->code . " - " . $row->designation . " \n";
		}
		echo "   		</TR>\n";
		echo "          <TR>\n";
		echo "			   <TD>Purchase Type </TD>\n";
		echo "			   <TD><SELECT name=\"purchase_type_id\" size=\"1\">\n";
		foreach ($purchase_type_tab as $row) {
			if ($row->id==$result->purchase_type_id) {
				$selected="selected=\"SELECTED\"";
			}
			else {
				$selected="";
			}
			echo "				<OPTION " . $selected . " value=\"" . $row->id . "\">" . $row->type . " \n";
		}
		
		echo "			   <TD>Purchase Date </TD>\n";
		echo "			   <TD><input name=\"purchase_date\" type=\"text\" value=\"" . $result->purchase_date. "\"></TD>\n";
		echo "   		</TR>\n";
		echo "          <TR>\n";
		echo "			   <TD>&nbsp;</TD>\n";
		echo "   		</TR>\n";
		echo "          <TR>\n";
		echo "			   <TD>Maintenance Type </TD>\n";
		echo "			   <TD><SELECT name=\"maintenance_type_id\" size=\"1\">\n";
		foreach ($maintenance_type_tab as $row) {
			if ($row->id==$result->maintenance_type_id) {
				$selected="selected=\"SELECTED\"";
			}
			else {
				$selected="";
			}
			echo "				<OPTION " . $selected . " value=\"" . $row->id . "\">" . $row->type . " \n";
		}
		echo "			   <TD>Amount </TD>\n";
		echo "			   <TD><input name=\"total_amount\" type=\"text\" value=\"" . floatval($result->total_amount) . "\"></TD>\n";
		echo "   		</TR>\n";
		echo "          <TR>\n";
		echo "			   <TD>Renewal Date</TD>\n";
		echo "			   <TD><input name=\"renewal_date\" type=\"text\" value=\"" . $result->renewal_date . "\"></TD>\n";
		echo "			   <TD>End Date </TD>\n";
		echo "			   <TD><input name=\"end_date\" type=\"text\" value=\"" . $result->end_date. "\"></TD>\n";
		echo "   		</TR>\n";
		echo "          <TR>\n";
		echo "   		</TR>\n";
		echo "          <TR>\n";
		echo "			   <TD>&nbsp;</TD>\n";
		echo "   		</TR>\n";
		echo "          <TR>\n";
		echo "			   <TD>Business Unit </TD>\n";
		echo "			   <TD><SELECT name=\"business_unit_id\" size=\"1\">\n";
		foreach ($bu_tab as $row) {
			if ($row->id==$result->business_unit_id) {
				$selected="selected=\"SELECTED\"";
			}
			else {
				$selected="";
			}
			echo "				<OPTION " . $selected . " value=\"" . $row->id . "\">" . $row->acronym . " \n";
		}
		echo "			   <TD>Paid by </TD>\n";
		echo "			   <TD><SELECT name=\"paid_by_id\" size=\"1\">\n";
		foreach ($paid_by_tab as $row) {
			if ($row->id==$result->paid_by_id) {
				$selected="selected=\"SELECTED\"";
			}
			else {
				$selected="";
			}
			echo "				<OPTION " . $selected . " value=\"" . $row->id . "\">" . $row->paidByEntity . " \n";
		}
		echo "   		</TR>\n";
		echo "          <TR>\n";
		echo "			   <TD>Comment </TD>\n";
		echo "			   <TD  colspan=\"3\"><TEXTAREA name=\"comments\" maxlength =\"255\" rows=\"5\" cols=\"60\" >" . $result->comments . "</TEXTAREA></TD>\n";
		echo "   		</TR>\n";
		echo " 	        </TABLE>\n";
		echo "			<br><br><button type=\"submit\">Save</button>&nbsp;&nbsp;";
		echo "			<button type=\"reset\" value=\"Reset\">Reset</button>&nbsp;&nbsp;";
		echo "			<button type=\"reset\" onClick=\"window.close()\">Close</button>\n";
		echo "			<div></div>\n";
		echo "			</form>\n";
		echo "<div id=\"jsGrid\"></div>\n";
		echo "<script type=\"text/javascript\">\n";
		echo "	function changeVal(event) {\n";
		echo "			var elem=event.target.value.split('|');\n";
		echo "			document.forms[0].p1_supplier_code.value=elem[1];\n";
		echo "  }\n";
		echo "</script>\n";
		
		echo "  </DIV>\n";
		
		echo "</body>\n";
		echo "</html>\n";
?>

