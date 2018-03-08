<?php

include "../objets/Contracts.php";

class ContractDetailsActions {
    
    protected $db;
    
    public function __construct(PDO $db) {
        $this->db = $db;
    }
    
    private function read($row) {
    	$result = new Contracts();
        $result->id = $row["id"];
        $result->name_contract= $row["name_contract"];
        $result->reference = $row["reference"];
        $result->supplier_id= $row["supplier_id"];
        $result->purchase_type_id= $row["purchase_type_id"];
        $result->maintenance_type_id= $row["maintenance_type_id"];
        $result->purchase_date= $row["purchase_date"];
        $result->renewal_date= $row["renewal_date"];
        $result->business_unit_id= $row["business_unit_id"];
        $result->paid_by_id= $row["paid_by_id"];
        $result->comments= $row["comments"];
        return $result;
    }
    
    public function getById($id) {
        $sql = "SELECT * FROM contracts WHERE id = :id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":id", $id, PDO::PARAM_INT);
        $q->execute();
        $rows = $q->fetchAll();
        return $this->read($rows[0]);
    }
    
    public function getAll($filter) {
    	$name_contract= "%" . $filter["name_contract"] . "%";
        $reference = "%" . $filter["reference"] . "%";
        $supplier_id= "%" . $filter["supplier_id"] . "%";
        $purchase_type_id= "%" . $filter["purchase_type_id"] . "%";
        $maintenance_type_id= "%" . $filter["maintenance_type_id"] . "%";
        //$purchase_date= "%" . $filter["purchase_date"] . "%";
        $purchase_date= "%";
        $renewal_date= "%" . $filter["renewal_date"] . "%";
        $business_unit_id= "%" . $filter["business_unit_id"] . "%";
        $paid_by_id= "%" . $filter["paid_by_id"] . "%";
        //$comments= "%" . $filter["comments"] . "%";
        $comments= "%" ;
        $sql = "SELECT * FROM contracts WHERE name_contract LIKE :name_contract AND reference LIKE :reference";
        $sql .=" AND supplier_id LIKE :supplier_id AND purchase_type_id LIKE :purchase_type_id AND maintenance_type_id LIKE :maintenance_type_id";	 
        $sql .= " AND purchase_date LIKE :purchase_date AND renewal_date LIKE :renewal_date AND business_unit_id LIKE :business_unit_id";
        $sql .= " AND paid_by_id LIKE :paid_by_id AND comments LIKE :comments";
        $q = $this->db->prepare($sql);
        $q->bindParam(":name_contract", $name_contract);
        $q->bindParam(":reference", $reference);
        $q->bindParam(":supplier_id", $supplier_id);
        $q->bindParam(":purchase_type_id", $purchase_type_id);
        $q->bindParam(":maintenance_type_id", $maintenance_type_id);
        $q->bindParam(":purchase_date", $purchase_date);
        $q->bindParam(":renewal_date", $renewal_date);
        $q->bindParam(":business_unit_id", $business_unit_id);
        $q->bindParam(":paid_by_id", $paid_by_id);
        $q->bindParam(":comments", $comments);
        $q->execute();
        $rows = $q->fetchAll();
        
        $result = array();
        foreach($rows as $row) {
            array_push($result, $this->read($row));
        }
        return $result;
    }
    
    public function insert($data) {
        $sql = "INSERT INTO contracts (name_contract, reference,supplier_id,purchase_type_id,maintenance_type_id,purchase_date, renewal_date,business_unit_id,paid_by_id,comments) ";
        $sql .= "VALUES (:name_contract, :reference,:supplier_id,:purchase_type_id,:maintenance_type_id,:purchase_date,:renewal_date,:business_unit_id,:paid_by_id,:comments)";
        $q = $this->db->prepare($sql);
        $q->bindParam(":name_contract", $data["name_contract"]);
        $q->bindParam(":reference", $data["reference"]);
        $q->bindParam(":supplier_id", $data["supplier_id"]);
        $q->bindParam(":purchase_type_id", $data["purchase_type_id"]);
        $q->bindParam(":maintenance_type_id", $data["maintenance_type_id"]);
        $q->bindParam(":purchase_date", $data["purchase_date"]);
        $q->bindParam(":renewal_date", $data["renewal_date"]);
        $q->bindParam(":business_unit_id", $data["business_unit_id"]);
        $q->bindParam(":paid_by_id", $data["paid_by_id"]);
        $q->bindParam(":comments", $data["comments"]);
        $q->execute();
        return $this->getById($this->db->lastInsertId());
    }
    
    public function update($data) {
        $sql = "UPDATE contracts SET name_contract = :name_contract, reference = :reference, supplier_id = :supplier_id, purchase_type_id = :purchase_type_id, "; 
        $sql .= "maintenance_type_id = :maintenance_type_id, purchase_date = :purchase_date, renewal_date = :renewal_date, business_unit_id = :business_unit_id,";
        $sql .= "paid_by_id = :paid_by_id, comments = :comments WHERE id = :id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":name_contract", $data["name_contract"]);
        $q->bindParam(":reference", $data["reference"]);
        $q->bindParam(":supplier_id", $data["supplier_id"]);
        $q->bindParam(":purchase_type_id", $data["purchase_type_id"]);
        $q->bindParam(":maintenance_type_id", $data["maintenance_type_id"]);
        $q->bindParam(":purchase_date", $data["purchase_date"]);
        $q->bindParam(":renewal_date", $data["renewal_date"]);
        $q->bindParam(":business_unit_id", $data["business_unit_id"]);
        $q->bindParam(":paid_by_id", $data["paid_by_id"]);
        $q->bindParam(":comments", $data["comments"]);
        $q->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $q->execute();
    }
    
    public function remove($id) {
        $sql = "DELETE FROM contracts WHERE id = :id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":id", $id, PDO::PARAM_INT);
        $q->execute();
    }
    
}

?>