<?php

include "LifeCyclesRepo.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$lifeCycles = new LifeCyclesRepo($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $lifeCycles->getAll();
        break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>