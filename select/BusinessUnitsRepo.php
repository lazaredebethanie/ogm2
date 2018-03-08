<?php

include "../objets/BusinessUnits.php";

class BusinessUnitsRepo {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    private function read($row) {
        $result = new BusinessUnits();
        $result->id = $row["id"];
        $result->acronym = $row["acronym"];
        $result->nameBU = $row["nameBU"];
        return $result;
    }

    public function getAll() {
        $sql = "SELECT * FROM entites_prescriptrices ORDER BY acronym ASC";
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