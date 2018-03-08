<?php

include "PurchaseTypeRepo.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$purchaseType = new PurchaseTypeRepo($db);

$result = $purchaseType->getAll();

echo "<div class=\"details-form-field\">\n";
echo "<label for=\"purchase_type_id\">Purchase Type :</label>\n";
echo "<select id=\"purchase_type_id\" name=\"purchase_type_id\">\n";
echo "<option value=\"\">(Select)</option>\n";
foreach($result as $line => $purchaseType)
{
	echo "<option value=".$purchaseType->id.">".$purchaseType->type."</option>\n";
	
}
echo "</select>\n";
echo "</div>\n";

?>