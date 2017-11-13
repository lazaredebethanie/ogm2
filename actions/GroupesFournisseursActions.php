<?php

include "../objets/GroupesFournisseurs.php";

class GroupesFournisseursActions {
	
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
	
	public function getById($id) {
		$sql = "SELECT * FROM groupes_fournisseurs WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
		$rows = $q->fetchAll();
		return $this->read($rows[0]);
	}
	
	public function getAll($filter) {
		$groupe = "%" . $filter["groupe"] . "%";
		
		$sql = "SELECT * FROM groupes_fournisseurs WHERE groupe LIKE :groupe ";
		$q = $this->db->prepare($sql);
		$q->bindParam(":groupe", $groupe);
		$q->execute();
		$rows = $q->fetchAll();
		
		$result = array();
		foreach($rows as $row) {
			array_push($result, $this->read($row));
		}
		return $result;
	}
	
	public function insert($data) {
		$sql = "INSERT INTO groupes_fournisseurs (groupe) VALUES (:groupe)";
		$q = $this->db->prepare($sql);
		$q->bindParam(":groupe", $data["groupe"]);
		$q->execute();
		return $this->getById($this->db->lastInsertId());
	}
	
	public function update($data) {
		$sql = "UPDATE groupes_fournisseursgroupes_fournisseurs SET groupe = :groupe WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":groupe", $data["groupe"]);
		$q->bindParam(":id", $data["id"], PDO::PARAM_INT);
		$q->execute();
	}
	
	public function remove($id) {
		$sql = "DELETE FROM groupes_fournisseurs WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
	}
	
}

?>