<?php

include "FournisseursRepo.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$suppliers = new FournisseursRepo($db);

$result = $suppliers->getAll();

echo "<div class=\"details-form-field\">\n";
echo "<label for=\"supplier_id\">Supplier :</label>\n";
echo "<select id=\"supplier_id\" name=\"supplier_id\">\n";
echo "<option value=\"\">(Select)</option>\n";
foreach($result as $line => $supplier)
{
	echo "<option value=".$supplier->id.">".$supplier->nom_usuel."</option>\n";
	
}
echo "</select>\n";
echo "</div>\n";


?>