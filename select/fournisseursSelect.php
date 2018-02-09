<?php

include "FournisseursRepo.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$fournisseursbusinessUnits = new FournisseursRepo($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $fournisseursbusinessUnits->getAll();
        break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>