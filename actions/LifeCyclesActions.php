<?php

include "../objets/LifeCycles.php";

class LifeCyclesActions {
	
	protected $db;
	
	public function __construct(PDO $db) {
		$this->db = $db;
	}
	
	private function read($row) {
		$result = new LifeCycles();
		$result->id = $row["id"];
		$result->state = $row["state"];
		$result->rank = $row["rank"];
		return $result;
	}
	
	public function getById($id) {
		$sql = "SELECT * FROM life_cycle_state WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
		$rows = $q->fetchAll();
		return $this->read($rows[0]);
	}
	
	public function getAll($filter) {
		$state = "%" . $filter["state"] . "%";
		$rank = "%" . $filter["rank"] . "%";
		
		$sql = "SELECT * FROM life_cycle_state WHERE state LIKE :state AND rank LIKE :rank ORDER BY rank";
		$q = $this->db->prepare($sql);
		$q->bindParam(":state", $state);
		$q->bindParam(":rank", $rank);
		$q->execute();
		$rows = $q->fetchAll();
		
		$result = array();
		foreach($rows as $row) {
			array_push($result, $this->read($row));
		}
		return $result;
	}
	
	public function insert($data) {
		$sql = "INSERT INTO life_cycle_state (state, rank) VALUES (:state, :rank)";
		$q = $this->db->prepare($sql);
		$q->bindParam(":state", $data["state"]);
		$q->bindParam(":rank", $data["rank"]);
		$q->execute();
		return $this->getById($this->db->lastInsertId());
	}
	
	public function update($data) {
		$sql = "UPDATE life_cycle_state SET state = :state, rank = :rank WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":state", $data["state"]);
		$q->bindParam(":rank", $data["rank"]);
		$q->bindParam(":id", $data["id"], PDO::PARAM_INT);
		$q->execute();
	}
	
	public function remove($id) {
		$sql = "DELETE FROM life_cycle_state WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
	}
	
}

?>