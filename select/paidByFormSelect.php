<?php

include "PaidByRepo.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$paidBy = new PaidByRepo($db);

$result = $paidBy->getAll();

echo "<div class=\"details-form-field\">\n";
echo "<label for=\"paid_by_id\">Paid by :</label>\n";
echo "<select id=\"paid_by_id\" name=\"paid_by_id\">\n";
echo "<option value=\"\">(Select)</option>\n";
foreach($result as $line => $paidBy)
{
	echo "<option value=".$paidBy->id.">".$paidBy->paidByEntity."</option>\n";
	
}
echo "</select>\n";
echo "</div>\n";

?>