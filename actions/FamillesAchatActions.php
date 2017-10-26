<?php

include "../objets/FamillesAchat.php";

class FamillesAchatActions {
	
	protected $db;
	
	public function __construct(PDO $db) {
		$this->db = $db;
	}
	
	private function read($row) {
		$result = new FamillesAchat();
		$result->id = $row["id"];
		$result->code = $row["code"];
		$result->designation = $row["designation"];
		return $result;
	}
	
	public function getById($id) {
		$sql = "SELECT * FROM familles_achat WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
		$rows = $q->fetchAll();
		return $this->read($rows[0]);
	}
	
	public function getAll($filter) {
		$code = "%" . $filter["code"] . "%";
		$designation = "%" . $filter["designation"] . "%";
		
		$sql = "SELECT * FROM familles_achat WHERE code LIKE :code AND designation LIKE :designation ";
		$q = $this->db->prepare($sql);
		$q->bindParam(":code", $code);
		$q->bindParam(":designation", $designation);
		$q->execute();
		$rows = $q->fetchAll();
		
		$result = array();
		foreach($rows as $row) {
			array_push($result, $this->read($row));
		}
		return $result;
	}
	
	public function insert($data) {
		$sql = "INSERT INTO familles_achat (code, designation) VALUES (:code, :designation)";
		$q = $this->db->prepare($sql);
		$q->bindParam(":code", $data["code"]);
		$q->bindParam(":designation", $data["designation"]);
		$q->execute();
		return $this->getById($this->db->lastInsertId());
	}
	
	public function update($data) {
		$sql = "UPDATE familles_achat SET code = :code, designation = :designation WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":code", $data["code"]);
		$q->bindParam(":designation", $data["designation"]);
		$q->bindParam(":id", $data["id"], PDO::PARAM_INT);
		$q->execute();
	}
	
	public function remove($id) {
		$sql = "DELETE FROM familles_achat WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
	}
	
}

?>