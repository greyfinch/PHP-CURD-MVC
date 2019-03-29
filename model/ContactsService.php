<?php
    require_once 'model/ContactsGateway.php';
    require_once 'model/ValidationException.php';

    class ContactsService {

        private $contactsGateway = NULL;
        private $dbConnection;
        
        public function __construct() {
            $this->dbConnection = $this->openDB();
            $this->contactsGateway = new ContactsGateway();
        }

        public function openDB() {
            try {
                $conn = new PDO("mysql:host=localhost;dbname=mvc_db;charset=UTF8", 'root', '');
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                return $conn;
            }catch(PDOException $e){
                throw new Exception("Connection error. ". $e->getMessage());
            }
        }

        public function closeDB() {
            $this->dbConnection = NULL;
        }

        public function getAllContacts($order) {
            try {
                $this->openDB();
                $res = $this->contactsGateway->selectAll($order, $this->dbConnection);
                $this->closeDB();
                return $res;
            } catch (Exception $e) {
                $this->closeDB();
                throw new Exception($e);
            }
        }

        public function getContact($id) {
            try{
                $this->openDB();
                $res = $this->contactsGateway->selectById($id,$this->dbConnection);
                $this->closeDB();
                return $res;
            } catch (Exception $e) {
                $this->closeDB();
                throw new Exception($e);
            }
            return $this->contactsGateway->find($id);
        }

        private function validateContactParams($name,$phone,$email,$address) {
            $errors = array();
            if(!isset($name) || empty($name)){
                $errors[] = 'Name is required';
            }

            if(empty($errors)){
                return;
            }
            //throw new ValidationException($errors);
        }

        public function createNewContact($name,$phone,$email,$address) {
            try{
                $this->openDB();
                $this->validateContactParams($name,$phone,$email,$address);
                $res = $this->contactsGateway->insert($name, $phone, $email, $address,$this->dbConnection);
                $this->closeDB();
                return $res;
            }catch (Exception $e) {
                $this->closeDB();
                throw new Exception($e);
            }
        }

        public function updateContact($id,$name,$phone,$email,$address) {
            try {
                $this->openDB();
                $this->validateContactParams($name,$phone,$email,$address);
                $response = $this->contactsGateway->update($id,$name,$phone,$email,$address,$this->dbConnection);
                $this->closeDB();
                return $response;
            } catch (Exception $e) {
                $this->closeDB();
                throw new Exception($e);
            }
        }

        public function deleteContact($id) {
            try {
                $this->openDB();
                $res = $this->contactsGateway->delete($id,$this->dbConnection);
                $this->closeDB();
                return $res;
            } catch (Exception $e) {
                $this->closeDB();
                throw $e;
            }
        }
    }
?>