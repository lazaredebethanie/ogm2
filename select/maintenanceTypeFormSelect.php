<?php

include "MaintenanceTypeRepo.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$maintenanceType = new MaintenanceTypeRepo($db);


$result = $maintenanceType->getAll();

echo "<div class=\"details-form-field\">\n";
echo "<label for=\"maintenance_type_id\">Maintenance Type :</label>\n";
echo "<select id=\"maintenance_type_id\" name=\"maintenance_type_id\">\n";
echo "<option value=\"\">(Select)</option>\n";
foreach($result as $line => $maintenanceType)
{
	echo "<option value=".$maintenanceType->id.">".$maintenanceType->type."</option>\n";
	
}
echo "</select>\n";
echo "</div>\n";

?>