<?php

include "BusinessUnitsRepo.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$businessUnits = new BusinessUnitsRepo($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $businessUnits->getAll();
        break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>