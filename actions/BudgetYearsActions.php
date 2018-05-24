<?php

include "../objets/BudgetYears.php";

class BudgetYearsActions {
	
	protected $db;
	
	public function __construct(PDO $db) {
		$this->db = $db;
	}
	
	private function read($row) {
		$result = new BudgetYears();
		$result->id = $row["id"];
		$result->period_id = $row["period_id"];
		$result->year = $row["year"];
		$result->amount = $row["amount"];
		return $result;
	}
	
	public function getById($id) {
		$sql = "SELECT * FROM budget_years WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
		$rows = $q->fetchAll();
		return $this->read($rows[0]);
	}
	
	public function getAll($period_id) {
		//$year = "%" . $filter["year"] . "%";
		//$amount = "%" . $filter["amount"] . "%";
		
		$sql = "SELECT * FROM budget_years WHERE period_id = :period_id ";
		$q = $this->db->prepare($sql);
		//$q->bindParam(":year", $year);
		//$q->bindParam(":amount", $amount);
		$q->bindParam(":period_id", $period_id, PDO::PARAM_INT);
		$q->execute();
		$rows = $q->fetchAll();
		
		$result = array();
		foreach($rows as $row) {
			array_push($result, $this->read($row));
		}
		return $result;
	}
	
	public function insert($period_id, $data) {
		while ($valeurs=current($data)) {
			$year=key($data);
			$sql = "INSERT INTO budget_years (period_id, year, amount) VALUES (:period_id, :year, :amount)";
			$q = $this->db->prepare($sql);
			$q->bindParam(":period_id", $period_id);
			$q->bindParam(":year", $year);
			$q->bindParam(":amount", $valeurs[1]);
			$q->execute();
			$erreur=$q->errorInfo();
			next($data);
		}
		return $this->getById($this->db->lastInsertId());
	}
	
	public function update($data) {
		$sql = "UPDATE budget_years SET period_id = : period_id, year = :year, amount = :amount WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":period_id", $data["period_id"]);
		$q->bindParam(":year", $data["year"]);
		$q->bindParam(":amount", $data["amount"]);
		$q->bindParam(":id", $data["id"], PDO::PARAM_INT);
		$q->execute();
	}
	
	public function remove($id) {
		$sql = "DELETE FROM budget_years WHERE id = :id";
		$q = $this->db->prepare($sql);
		$q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
	}
	
}

?>