<?php

include "../objets/GroupesFournisseurs.php";

class GroupesFournisseursRepo {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    private function read($row) {
        $result = new GroupesFournisseurs();
        $result->id = $row["id"];
        $result->groupe = $row["groupe"];
        return $result;
    }

    public function getAll() {
        $sql = "SELECT * FROM groupes_fournisseurs";
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