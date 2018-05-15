<?php

include "../objets/LifeCycles.php";

class LifeCyclesRepo {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    private function read($row) {
        $result = new LifeCycles();
        $result->id = $row["id"];
        $result->state= $row["state"];
        $result->rank= $row["rank"];
        return $result;
    }

    public function getAll() {
        $sql = "SELECT * FROM life_cycle_state ORDER BY rank ASC";
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