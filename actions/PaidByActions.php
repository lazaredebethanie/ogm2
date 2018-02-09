<?php

include "../objets/PaidBy.php";

class PaidByActions {
	
	protected $db;
	
	public function __construct(PDO $db) {
		$this->db = $db;
	}
	
	private function read($row) {
		$result = new PaidBy();
		$result->id = $row["id"];
		$result->paidByEntity = $row["paid_by_entity"];
		$result->longName = $row["long_name"];
		return $result;
	}
	
	public function getById($id) {
		$sql = "SELECT * FROM paid_by WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
		$rows = $q->fetchAll();
		return $this->read($rows[0]);
	}
	
	public function getAll($filter) {
		$paidByEntity = "%" . $filter["paidByEntity"] . "%";
		$longName = "%" . $filter["longName"] . "%";
		
		$sql = "SELECT * FROM paid_by WHERE paid_by_entity LIKE :paidByEntity AND long_name LIKE :longName ";
		$q = $this->db->prepare($sql);
		$q->bindParam(":paidByEntity", $paidByEntity);
		$q->bindParam(":longName", $longName);
		$q->execute();
		$rows = $q->fetchAll();
		
		$result = array();
		foreach($rows as $row) {
			array_push($result, $this->read($row));
		}
		return $result;
	}
	
	public function insert($data) {
		$sql = "INSERT INTO paid_by (paid_by_entity, long_name) VALUES (:paidByEntity, :longName)";
		$q = $this->db->prepare($sql);
		$q->bindParam(":paidByEntity", $data["paidByEntity"]);
		$q->bindParam(":longName", $data["longName"]);
		$q->execute();
		return $this->getById($this->db->lastInsertId());
	}
	
	public function update($data) {
		$sql = "UPDATE paid_by SET paid_by_entity = :paidByEntity, long_name = :longName WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":paidByEntity", $data["paidByEntity"]);
		$q->bindParam(":longName", $data["longName"]);
		$q->bindParam(":id", $data["id"], PDO::PARAM_INT);
		$q->execute();
	}
	
	public function remove($id) {
		$sql = "DELETE FROM paid_by WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
	}
	
}

?>