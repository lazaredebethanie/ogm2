<?php

include "../objets/BusinessUnits.php";

class BusinessUnitsActions {
	
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
	
	public function getById($id) {
		$sql = "SELECT * FROM entites_prescriptrices WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
		$rows = $q->fetchAll();
		return $this->read($rows[0]);
	}
	
	public function getAll($filter) {
		$acronym = "%" . $filter["acronym"] . "%";
		$nameBU = "%" . $filter["nameBU"] . "%";
		
		$sql = "SELECT * FROM entites_prescriptrices WHERE acronym LIKE :acronym AND nameBU LIKE :nameBU ";
		$q = $this->db->prepare($sql);
		$q->bindParam(":acronym", $acronym);
		$q->bindParam(":nameBU", $nameBU);
		$q->execute();
		$rows = $q->fetchAll();
		
		$result = array();
		foreach($rows as $row) {
			array_push($result, $this->read($row));
		}
		return $result;
	}
	
	public function insert($data) {
		$sql = "INSERT INTO entites_prescriptrices (acronym, nameBU) VALUES (:acronym, :nameBU)";
		$q = $this->db->prepare($sql);
		$q->bindParam(":acronym", $data["acronym"]);
		$q->bindParam(":nameBU", $data["nameBU"]);
		$q->execute();
		return $this->getById($this->db->lastInsertId());
	}
	
	public function update($data) {
		$sql = "UPDATE entites_prescriptrices SET acronym = :acronym, nameBU = :nameBU WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":acronym", $data["acronym"]);
		$q->bindParam(":nameBU", $data["nameBU"]);
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