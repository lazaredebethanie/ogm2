<?php

include "PurchaseTypeRepo.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$purchaseType = new PurchaseTypeRepo($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
    	$result = $purchaseType->getAll();
        break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>