<?php

include "../objets/MaintenanceLinesPeriods.php";

class MaintenanceLinesPeriodsActions {
    
    protected $db;
    
    public function __construct(PDO $db) {
        $this->db = $db;
    }
    
    private function read($row) {
    	$result = new MaintenanceLinesPeriods();
        $result->id = $row["id"];
        $result->description= $row["description"];
        $result->begin = $row["begin"];
        $result->end= $row["end"];
        $result->total_amount= $row["total_amount"];
        $result->multi_years= $row["multi_years"];
        $result->life_cycle_state_id= $row["life_cycle_state_id"];
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
    
    public function getAll($contractId, $filter) {
    	$description= "%" . $filter["description"] . "%";
        $begin = "%" . $filter["begin"] . "%";
        $end= "%" . $filter["end"] . "%";
        $total_amount= $filter["total_amount"];
        //$total_amount= "<-1";
        $op="";
        
        if (stripos($total_amount, ">") !== false) {
        	$op=">=";	
        } elseif (stripos($total_amount, "<") !== false) {
        	$op="<=";
        } elseif (stripos($total_amount, "<>") !== false) {
        	$op="<>";
        } elseif (stripos($total_amount, "=") !== false) {
        	$op="=";
        } elseif ($total_amount<>"") {
        		$total_amount= "%" . $filter["total_amount"] . "%" ;
        		$op="LIKE";
        } else {
        	  $total_amount="%";
        	  $op="LIKE"; 	
        }
        	
        
       	$speCar = array (">","<","=");
        $total_amount = str_replace($speCar, "", $total_amount);
        
        $multi_years= "%" . $filter["multi_years"] . "%";
        $life_cycle_state_id= "%" . $filter["life_cycle_state_id"] . "%";
        //$comments= "%" . $filter["comments"] . "%";
        $comments= "%%" ;
        $sql = "SELECT id, description, begin, end, total_amount, multi_years, life_cycle_state_id, comments"; 
		$sql .= " FROM maintenance_line_period";
        $sql .= " WHERE contract_id=:contractId";
        $sql .= " AND description LIKE :description AND begin LIKE :begin AND end LIKE :end AND total_amount " . $op .  " :total_amount";
        $sql .= " AND multi_years LIKE :multi_years AND life_cycle_state_id LIKE :life_cycle_state_id AND comments LIKE :comments";
        $q = $this->db->prepare($sql);
        
        $q->bindParam(":contractId", $contractId);
        $q->bindParam(":description", $description);
        $q->bindParam(":begin", $begin);
        $q->bindParam(":end", $end);
        if ($op=="LIKE") {
        	$q->bindParam(":total_amount", $total_amount, PDO::PARAM_STR );
        } else {
        	$q->bindParam(":total_amount", $total_amount, PDO::PARAM_INT );
        }
        $q->bindParam(":multi_years", $multi_years);
        $q->bindParam(":life_cycle_state_id", $life_cycle_state_id);
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
        $sql = "INSERT INTO contracts (name_contract, reference,supplier_id,purchase_type_id,maintenance_type_id,purchase_date, renewal_date,total_amount, business_unit_id,paid_by_id,comments) ";
        $sql .= "VALUES (:name_contract, :reference,:supplier_id,:purchase_type_id,:maintenance_type_id,:purchase_date,:renewal_date,:total_amount,:business_unit_id,:paid_by_id,:comments)";
        $q = $this->db->prepare($sql);
        $q->bindParam(":name_contract", $data["name_contract"]);
        $q->bindParam(":reference", $data["reference"]);
        $q->bindParam(":supplier_id", $data["supplier_id"]);
        $q->bindParam(":purchase_type_id", $data["purchase_type_id"]);
        $q->bindParam(":maintenance_type_id", $data["maintenance_type_id"]);
        $q->bindParam(":purchase_date", $data["purchase_date"]);
        $q->bindParam(":renewal_date", $data["renewal_date"]);
        $q->bindParam(":total_amount", $data["total_amount"]);
        $q->bindParam(":business_unit_id", $data["business_unit_id"]);
        $q->bindParam(":paid_by_id", $data["paid_by_id"]);
        $q->bindParam(":comments", $data["comments"]);
        $q->execute();
        return $this->getById($this->db->lastInsertId());
    }
    
    public function update($data) {
        $sql = "UPDATE contracts SET name_contract = :name_contract, reference = :reference, supplier_id = :supplier_id, purchase_type_id = :purchase_type_id, "; 
        $sql .= "maintenance_type_id = :maintenance_type_id, purchase_date = :purchase_date, renewal_date = :renewal_date, total_amount=:total_amount, business_unit_id = :business_unit_id,";
        $sql .= "paid_by_id = :paid_by_id, comments = :comments WHERE id = :id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":name_contract", $data["name_contract"]);
        $q->bindParam(":reference", $data["reference"]);
        $q->bindParam(":supplier_id", $data["supplier_id"]);
        $q->bindParam(":purchase_type_id", $data["purchase_type_id"]);
        $q->bindParam(":maintenance_type_id", $data["maintenance_type_id"]);
        $q->bindParam(":purchase_date", $data["purchase_date"]);
        $q->bindParam(":renewal_date", $data["renewal_date"]);
        $q->bindParam(":total_amount", $data["total_amount"]);
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