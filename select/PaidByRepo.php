<?php

include "../objets/PaidBy.php";

class PaidByRepo {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    private function read($row) {
        $result = new PaidBy();
        $result->id = $row["id"];
        $result->paidByEntity = $row["paid_by_entity"];
        $result->longName = $row["long_name"];
        return $result;
    }

    public function getAll() {
        $sql = "SELECT * FROM paid_by ORDER BY paid_by_entity ASC";
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