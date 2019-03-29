<?php
    require_once 'model/ContactsService.php';

    class ContactsController {
        
        private $contactsService = NULL;

        public function __construct() {
            $this->contactsService = new ContactsService();
        }

        public function redirect($location) {
            header('Location: '.$location);
        }

        public function handleRequest() {
            $op = isset($_GET['op'])?$_GET['op']:NULL;

            try {
                if(!$op || $op == 'list') {
                    $this->listContacts();
                }elseif($op == 'new') {
                    $this->saveContact();
                }elseif($op == 'update') {
                    $this->updateContact();
                }elseif($op == 'delete') {
                    $this->deleteContact();
                }elseif($op == 'show') {
                    $this->showContact();
                }else {
                    $this->showError("Page not found", "Page for operation ".$op." was not found!");
                }
            } catch (Exception $e) {
                $this->showError("Application error", $e->getMessage());
            }
        }

        public function listContacts() {
            $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
            $contacts = $this->contactsService->getAllContacts($orderby);
            include 'view/contacts.php';
        }

        public function saveContact() {
            $title = 'Add new contact';

            $name = '';
            $phone = '';
            $email = '';
            $address = '';

            $errors = array();

            if(isset($_POST['form-submitted'])) {
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $address = $_POST['address'];

                try {
                    $this->contactsService->createNewContact($name,$phone,$email,$address);
                    $this->redirect('index.php');
                    return;
                } catch (ValidationException $e) {
                    $errors = $e->getErrors();
                }
            }
            include 'view/contact-form.php';
        }

        public function updateContact() {
            $title = 'Update contact';

            $id = isset($_GET['id'])?$_GET['id']:NULL;
            if(!$id) {
                throw new Exception("Internal error.");
            }

            $errors = array();

            if(isset($_POST['form-submitted'])) {
                $id = $_POST['contact-id'];
                $name = $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $address = $_POST['address'];

                try {
                    $this->contactsService->updateContact($id,$name,$phone,$email,$address);
                    $this->redirect('index.php');
                    return;
                } catch (ValidationException $e) {
                    $errors = $e->getErrors();
                }
            }else {               

                $contact = $this->contactsService->getContact($id);

                $name = $contact->name;
                $phone = $contact->phone;
                $email = $contact->email;
                $address = $contact->address;
            }
            include 'view/contact-form.php';
        }

        public function deleteContact() {
            $id = isset($_GET['id'])?$_GET['id']:NULL;
            $deleteMessage = '';
            if(!$id) {
                throw new Exception("Internal error.");
            }

            $deleteContact = $this->contactsService->deleteContact($id);
            if($deleteContact) {
                $deleteMessage = '<div class="alert alert-success>Contact Deleted successfully</div>';
            }else{
                $deleteMessage = '<div class="alert alert-danger>Operation failed. Contact Admin</div>';
            }
            $this->redirect('index.php');
        }
        
        public function showContact() {
            $id = isset($_GET['id'])?$_GET['id']:NULL;
            if(!$id) {
                throw new Exception("Internal error.");
            }

            $contact = $this->contactsService->getContact($id);
            include 'view/contact.php';
        }

        public function showError($title, $message){
            include 'view/error.php';
        }
    }
?>