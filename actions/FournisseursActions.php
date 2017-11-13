<?php

include "../objets/Fournisseurs.php";

class FournisseursActions {
	
	protected $db;
	
	public function __construct(PDO $db) {
		$this->db = $db;
	}
	
	private function read($row) {
		$result = new Fournisseurs();
		$result->id = $row["id"];
		$result->nom_usuel = $row["nom_usuel"];
		$result->cofor = $row["cofor"];
		$result->groupe_id = $row["groupe_id"];
		return $result;
	}
	
	public function getById($id) {
		$sql = "SELECT * FROM fournisseurs WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
		$rows = $q->fetchAll();
		return $this->read($rows[0]);
	}
	
	public function getAll($filter) {
		$nom_usuel = "%" . $filter["nom_usuel"] . "%";
		$cofor = "%" . $filter["cofor"] . "%";
		$groupe_id = "%" . $filter["groupe_id"] . "%";
		$sql = "SELECT * FROM fournisseurs WHERE nom_usuel LIKE :nom_usuel AND cofor LIKE :cofor AND (:groupe_id = 0 OR groupe_id = :groupe_id)";
		$q = $this->db->prepare($sql);
		$q->bindParam(":nom_usuel", $nom_usuel);
		$q->bindParam(":cofor", $cofor);
		$q->bindParam(":groupe_id", $groupe_id);
		$q->execute();
		$rows = $q->fetchAll();
		
		$result = array();
		foreach($rows as $row) {
			array_push($result, $this->read($row));
		}
		return $result;
	}
	
	public function insert($data) {
		$sql = "INSERT INTO fournisseurs (nom_usuel, cofor, groupe_id) VALUES (:nom_usuel, :cofor, :groupe_id)";
		$q = $this->db->prepare($sql);
		$q->bindParam(":nom_usuel", $data["nom_usuel"]);
		$q->bindParam(":cofor", $data["cofor"]);
		$q->bindParam(":groupe_id", $data["groupe_id"], PDO::PARAM_INT);
		$q->execute();
		return $this->getById($this->db->lastInsertId());
	}
	
	public function update($data) {
		$sql = "UPDATE fournisseurs SET nom_usuel = :nom_usuel, cofor = :cofor, groupe_id = :groupe_id WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":nom_usuel", $data["nom_usuel"]);
		$q->bindParam(":cofor", $data["cofor"]);
		$q->bindParam(":groupe_id", $data["groupe_id"], PDO::PARAM_INT);
		$q->bindParam(":id", $data["id"], PDO::PARAM_INT);
		$q->execute();
	}
	
	public function remove($id) {
		$sql = "DELETE FROM fournisseurs WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
	}
	
}

?>
