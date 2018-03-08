<?php

include "../objets/PurchaseType.php";

class PurchaseTypeRepo {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    private function read($row) {
        $result = new PurchaseType();
        $result->id = $row["id"];
        $result->type = $row["type"];
        return $result;
    }

    public function getAll() {
        $sql = "SELECT * FROM purchase_type ORDER BY type ASC";
        $q = $this->db->prepare($sql);
        $q->execute();
        $rows = $q->fetchAll();

        $result = array();
        foreach($rows as $row) {
            array_push($result, $this->read($row));
        }
        return $result;
    }

}

?>