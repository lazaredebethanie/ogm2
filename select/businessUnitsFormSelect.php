<?php

include "BusinessUnitsRepo.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$businessUnits = new BusinessUnitsRepo($db);

$result = $businessUnits->getAll();

echo "<div class=\"details-form-field\">\n";
echo "<label for=\"business_unit_id\">Business Unit :</label>\n";
echo "<select id=\"business_unit_id\" name=\"business_unit_id\">\n";
echo "<option value=\"\">(Select)</option>\n";
foreach($result as $line => $businessUnits)
{
	echo "<option value=".$businessUnits->id.">".$businessUnits->acronym."</option>\n";
	
}
echo "</select>\n";
echo "</div>\n";

?>