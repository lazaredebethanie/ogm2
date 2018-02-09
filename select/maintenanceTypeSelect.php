<?php

include "MaintenanceTypeRepo.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$maintenanceType = new MaintenanceTypeRepo($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
    	$result = $maintenanceType->getAll();
        break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>