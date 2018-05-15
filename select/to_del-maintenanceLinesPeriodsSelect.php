<?php

include "../actions/MaintenanceLinesPeriodsActions.php";

$config = include("../db/config.php");
$option=array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
$db = new PDO($config["db"], $config["username"], $config["password"],$option );
$maintenanceLinesPeriods= new MaintenanceLinesPeriodsActions($db);
$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $fournisseurs->getAll();
        break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>