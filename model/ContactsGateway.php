<?php


class ContactsGateway {

    public function RunQuery($query,$dbLink) {
		$queryString = $dbLink->prepare($query);
		$queryString->execute();
		return $queryString;
	}
    
    public function selectAll($order,$dbConnection) {
        if ( !isset($order) ) {
            $order = "id";
        }
        $dbOrder =  htmlspecialchars(trim($order), ENT_QUOTES, 'UTF-8');
        $dbres = $this->RunQuery("SELECT * FROM contacts ORDER BY $dbOrder DESC",$dbConnection);
        
        $contacts = array();
        while ( ($obj = $dbres->fetch()) != NULL ) {
            $contacts[] = $obj;
        }
        
        return $contacts;
    }
    
    public function selectById($id,$dbConnection) {
        $dbId = htmlspecialchars(trim($id), ENT_QUOTES, 'UTF-8');
    
        $dbres = $this->RunQuery("SELECT * FROM contacts WHERE id=$dbId",$dbConnection);
        
        return $dbres->fetch();
		
    }
    
    public function find($id,$dbConnection) {
        
        $dbID =  htmlspecialchars(trim($id), ENT_QUOTES, 'UTF-8');
        $dbres = $this->RunQuery("SELECT * FROM contacts WHERE id = $dbID",$dbConnection);
        return $dbres->fetch();
    }
    
    public function insert( $name, $phone, $email, $address, $dbConnection) {
        
        $dbName = ($name != NULL)?"'". htmlspecialchars(trim($name), ENT_QUOTES, 'UTF-8')."'":'NULL';
        $dbPhone = ($phone != NULL)?"'". htmlspecialchars(trim($phone), ENT_QUOTES, 'UTF-8')."'":'NULL';
        $dbEmail = ($email != NULL)?"'". htmlspecialchars(trim($email), ENT_QUOTES, 'UTF-8')."'":'NULL';
        $dbAddress = ($address != NULL)?"'". htmlspecialchars(trim($address), ENT_QUOTES, 'UTF-8')."'":'NULL';
        
        $query = "INSERT INTO contacts (name, phone, email, address) VALUES ($dbName, $dbPhone, $dbEmail, $dbAddress)";
        
        $createNew = $this->RunQuery($query,$dbConnection);
        return $dbConnection->lastInsertId();
    }
    
    public function update( $id, $name, $phone, $email, $address, $dbConnection) {
        
        $id = ($id != NULL)?"'". htmlspecialchars(trim($id), ENT_QUOTES, 'UTF-8')."'":'NULL';
        $dbName = ($name != NULL)?"'". htmlspecialchars(trim($name), ENT_QUOTES, 'UTF-8')."'":'NULL';
        $dbPhone = ($phone != NULL)?"'". htmlspecialchars(trim($phone), ENT_QUOTES, 'UTF-8')."'":'NULL';
        $dbEmail = ($email != NULL)?"'". htmlspecialchars(trim($email), ENT_QUOTES, 'UTF-8')."'":'NULL';
        $dbAddress = ($address != NULL)?"'". htmlspecialchars(trim($address), ENT_QUOTES, 'UTF-8')."'":'NULL';
        
        $query = "UPDATE contacts set name = $dbName, phone = $dbPhone, 
                email = $dbEmail, address = $dbAddress Where id = $id";
        
        return $this->RunQuery($query,$dbConnection);
    }
    
    public function delete($id, $dbConnection) {
        $dbId = htmlspecialchars(trim($id), ENT_QUOTES, 'UTF-8');
        $query = "DELETE FROM contacts WHERE id=$dbId";
        $runQuery = $this->RunQuery($query,$dbConnection);
        if($runQuery){
            return true;
        }else{
            return false;
        }
    }
    
}

?>