<?php
namespace week2\jrola;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailTypeService
 *
 * @author Jack
 */
class EmailTypeService {
    //put your code here
    
    private $_errors = array();
    private $_Util;
    private $_DB;
    private $_Validator;
    private $_EmailTypeDAO;
    private $_EmailTypeModel;


    public function __construct($db, $util, $validator, $emailTypeDAO, $emailTypeModel) {
        $this->_DB = $db;    
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_EmailTypeDAO = $emailTypeDAO;
        $this->_EmailTypeModel = $emailTypeModel;
    }


    public function saveForm() {        
        if ( !$this->_Util->isPostRequest() ) {
            return false;
        }
        
        $this->validateForm();
        
        if ( $this->hasErrors() ) {
            $this->displayErrors();
        } else {
            
            if (  $this->_EmailTypeDAO->save($this->_EmailTypeModel) ) {
                echo 'Email Added';
            } else {
                echo 'Email could not be added Added';
            }  
        }
    }
    public function validateForm() {
       
        if ( $this->_Util->isPostRequest() ) {                
            $this->_errors = array();
            if( !$this->_Validator->EmailTypeIsValid($this->_EmailTypeModel->getEmailtype()) ) {
                 $this->_errors[] = 'Email Type is invalid';
            } 
            if( !$this->_Validator->activeIsValid($this->_EmailTypeModel->getActive()) ) {
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


    public function displayEmail() {        
       
        $stmt = $this->_DB->prepare("SELECT * FROM emailtype");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            foreach ($results as $value) {
                echo '<p>', $value['emailtype'], '</p>';
            }
        } else {
            echo '<p>No Data</p>';
        }
    }
    
        public function displayEmailsActions() {        
       // Notice in the previous function I should have called get all rows
        
        $emailTypes = $this->_EmailTypeDAO->getAllRows();
        
        if ( count($emailTypes) < 0 ) {
            echo '<p>No Data</p>';
        } else {
            
            
             echo '<table border="1" cellpadding="5"><tr><th>Email Type</th><th>Active</th><th></th><th></th></tr>';
             foreach ($emailTypes as $value) {
                echo '<tr>';
                echo '<td>', $value->getEmailtype(),'</td>';
                echo '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                echo '<td><a href=update.php?emailtypeid=',$value->getEmailtypeid(),'>Update</a></td>';
                echo '<td><a href=deleteEmailType.php?emailtypeid=',$value->getEmailtypeid(),'>Delete</a></td>';
                echo '</tr>' ;
            }
            echo '</table>';
            
        }
    }
}
