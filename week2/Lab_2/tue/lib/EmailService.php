<?php

namespace nrajotte\week2;
use \PDO;

class EmailService {
    private $_errors = array();
    private $_Util;
    private $_DB;
    private $_Validator;
    private $_EmailDAO;
    private $_EmailModel;


    public function __construct($db, $util, $validator, $emailDAO, $emailModel) {
        $this->_DB = $db;
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_EmailDAO = $emailDAO;
        $this->_EmailModel = $emailModel;
    }

    public function saveForm() {
        if ( !$this->_Util->isPostRequest() ) {
            return false;
        }
        $this->validateForm();
        if ( $this->hasErrors() ) {
            $this->displayErrors();
        } else {
            if (  $this->_EmailDAO->save($this->_EmailModel) ) {
                echo 'Email Added';
            } else {
                echo 'Email could not be added Added';
            }
        }
    }
    public function validateForm() {
        if ( $this->_Util->isPostRequest() ) {
            $this->_errors = array();
            if( !$this->_Validator->emailIsValid($this->_EmailModel->getEmail()) ) {
                var_dump($this->_EmailModel->getEmail());
                 $this->_errors[] = 'Email is invalid';
            }
            if( !$this->_Validator->emailTypeIsValid($this->_EmailModel->getEmailtypeid()) ) {
                 $this->_errors[] = 'Emails Type is invalid';
            }
            if( !$this->_Validator->activeIsValid($this->_EmailModel->getEmailactive()) ) {
                 $this->_errors[] = 'Active is invalid';
            }
        }
    }

    public function displayErrors() {

        foreach ($this->_errors as $value) {
            echo '<p>',$value,'</p>';
        }
    }

    public function hasErrors() {
        return ( count($this->_errors) > 0 );
    }



    public function displayEmails() {
        $stmt = $this->_DB->prepare("SELECT * FROM email");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
                echo '<p>', $value['email'], '</p>';
            }
        } else {
            echo '<p>No Data</p>';
        }
    }
    public function ifIdexistDelte($emailid){
        try{
            $emailId = filter_input(INPUT_GET, 'emailid');
            $this->_EmailDAO->delete($emailId);
            header('Location: email-test.php');
        }catch(Exception $e){
            echo 'Error Deleting' . $e;
        }
    }
    public function displayEmailsActions() {
       // Notice in the previous function I should have called get all rows

        $emailTypes = $this->_EmailDAO->getAllRows();

        if ( count($emailTypes) < 0 ) {
            echo '<p>No Data</p>';
        } else {

             echo '<table class="table-bordered table-striped" border="2" cellpadding="5"><tr><th>Email</th><th>Email_Type</th><th>Active</th><th>Update</th><th>Delete</th></tr>';
             foreach ($emailTypes as $value) {
                echo '<tr>';
                echo '<td>', $value->getEmail(),'</td>';
                echo '<td>', $value->getEmailtype(),'</td>';
                echo '<td>', ( $value->getEmailactive() == 1 ? 'Yes' : 'No') ,'</td>';
                echo '<td><a href=email-update.php?emailid=',$value->getEmailid(),'>Update</a></td>';
                echo '<td><a href=email-test.php?emailid=',$value->getEmailid(),'>Delete</a></td>';
                echo '</tr>' ;
            }
            echo '</table>';
        }
     }
}
