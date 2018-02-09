<?php

include "../objets/Fournisseurs.php";

class FournisseursRepo {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    private function read($row) {
        $result = new Fournisseurs();
        $result->id = $row["id"];
        $result->nom_usuel = $row["nom_usuel"];
        $result->cofor = $row["cofor"];
        $result->groupe_id= $row["groupe_id"];
        return $result;
    }

    public function getAll() {
        $sql = "SELECT * FROM fournisseurs";
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