<?php

include "../objets/EntitesPrescriptrices.php";

class EntitesPrescriptricesActions {
	
	protected $db;
	
	public function __construct(PDO $db) {
		$this->db = $db;
	}
	
	private function read($row) {
		$result = new EntitesPrescriptrices();
		$result->id = $row["id"];
		$result->acronyme = $row["acronyme"];
		$result->nom = $row["nom"];
		return $result;
	}
	
	public function getById($id) {
		$sql = "SELECT * FROM entites_prescriptrices WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
		$rows = $q->fetchAll();
		return $this->read($rows[0]);
	}
	
	public function getAll($filter) {
		$acronyme = "%" . $filter["acronyme"] . "%";
		$nom = "%" . $filter["nom"] . "%";
		
		$sql = "SELECT * FROM entites_prescriptrices WHERE acronyme LIKE :acronyme AND nom LIKE :nom ";
		$q = $this->db->prepare($sql);
		$q->bindParam(":acronyme", $acronyme);
		$q->bindParam(":nom", $nom);
		$q->execute();
		$rows = $q->fetchAll();
		
		$result = array();
		foreach($rows as $row) {
			array_push($result, $this->read($row));
		}
		return $result;
	}
	
	public function insert($data) {
		$sql = "INSERT INTO entites_prescriptrices (acronyme, nom) VALUES (:acronyme, :nom)";
		$q = $this->db->prepare($sql);
		$q->bindParam(":acronyme", $data["acronyme"]);
		$q->bindParam(":nom", $data["nom"]);
		$q->execute();
		return $this->getById($this->db->lastInsertId());
	}
	
	public function update($data) {
		$sql = "UPDATE entites_prescriptrices SET acronyme = :acronyme, nom = :nom WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":acronyme", $data["acronyme"]);
		$q->bindParam(":nom", $data["nom"]);
		$q->bindParam(":id", $data["id"], PDO::PARAM_INT);
		$q->execute();
	}
	
	public function remove($id) {
		$sql = "DELETE FROM entites_prescriptrices WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
	}
	
}

?>