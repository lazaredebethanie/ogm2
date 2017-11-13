<?php

include "groupesFournisseursRepo.php";

$config = include("../db/config.php");
$db = new PDO($config["db"], $config["username"], $config["password"]);
$groupesFournisseurs = new groupesFournisseursRepo($db);
//$_SERVER["REQUEST_METHOD"]="GET";

switch($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        $result = $groupesFournisseurs->getAll();
        break;
}


header("Content-Type: application/json");
echo json_encode($result);

?>