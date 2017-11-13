<?php

include "../objets/TypesMaintenance.php";

class TypesMaintenanceActions {
	
	protected $db;
	
	public function __construct(PDO $db) {
		$this->db = $db;
	}
	
	private function read($row) {
		$result = new TypesMaintenance();
		$result->id = $row["id"];
		$result->type = $row["type"];
		return $result;
	}
	
	public function getById($id) {
		$sql = "SELECT * FROM types_maintenance WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
		$rows = $q->fetchAll();
		return $this->read($rows[0]);
	}
	
	public function getAll($filter) {
		$type = "%" . $filter["type"] . "%";
		
		$sql = "SELECT * FROM types_maintenance WHERE type LIKE :type ";
		$q = $this->db->prepare($sql);
		$q->bindParam(":type", $type);
		$q->execute();
		$rows = $q->fetchAll();
		
		$result = array();
		foreach($rows as $row) {
			array_push($result, $this->read($row));
		}
		return $result;
	}
	
	public function insert($data) {
		$sql = "INSERT INTO types_maintenance (type) VALUES (:type)";
		$q = $this->db->prepare($sql);
		$q->bindParam(":type", $data["type"]);
		$q->execute();
		return $this->getById($this->db->lastInsertId());
	}
	
	public function update($data) {
		$sql = "UPDATE types_maintenance SET type = :type WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":type", $data["type"]);
		$q->bindParam(":id", $data["id"], PDO::PARAM_INT);
		$q->execute();
	}
	
	public function remove($id) {
		$sql = "DELETE FROM types_maintenance WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
	}
	
}

?>