<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PhoneTypeService
 *
 * @author User
 */
class PhoneTypeService {
   
    private $_errors = array();
    private $_Util;
    private $_DB;
    private $_Validator;
    private $_PhoneTypeDAO;
    private $_PhonetypeModel;


    public function __construct($db, $util, $validator, $phoneTypeDAO, $phonetypeModel) {
        $this->_DB = $db;    
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_PhoneTypeDAO = $phoneTypeDAO;
        $this->_PhoneTypeModel = $phonetypeModel;
    }


    public function saveForm() {        
        if ( !$this->_Util->isPostRequest() ) {
            return false;
        }
        
        $this->validateForm();
        
        if ( $this->hasErrors() ) {
            $this->displayErrors();
        } else {
            
            if (  $this->_PhoneTypeDAO->save($this->_PhoneTypeModel) ) {
                echo 'Phone Added';
            } else {
                echo 'Phone could not be added Added';
            }
           
        }
        
    }
    public function validateForm() {
       
        if ( $this->_Util->isPostRequest() ) {                
            $this->_errors = array();
            if( !$this->_Validator->phoneTypeIsValid($this->_PhoneTypeModel->getPhonetype()) ) {
                 $this->_errors[] = 'Phone Type is invalid';
            } 
            if( !$this->_Validator->activeIsValid($this->_PhoneTypeModel->getActive()) ) {
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


    public function displayPhones() {        
       // this doesn't make good use of the getallrows function in my DAO
        $stmt = $this->_DB->prepare("SELECT * FROM phonetype");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            foreach ($results as $value) {
                echo '<p>', $value['phonetype'], '</p>';
            }
        } else {
            echo '<p>No Data</p>';
        }
        
    }
    
    public function displayPhonesActions() {        
       // Notice in the previous function I should have called get all rows
        
        $phoneTypes = $this->_PhoneTypeDAO->getAllRows();
        
        if ( count($phoneTypes) < 0 ) {
            echo '<p>No Data</p>';
        } else {
            
            
             echo '<table border="1" cellpadding="5"><tr><th>Phone Type</th><th>Active</th><th></th><th></th></tr>';
             foreach ($phoneTypes as $value) {
                echo '<tr>';
                echo '<td>', $value->getPhonetype(),'</td>';
                echo '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                echo '<td><a href=update.php?phonetypeid=',$value->getPhonetypeid(),'>Update</a></td>';
                echo '<td><a href=delete.php?phonetypeid=',$value->getPhonetypeid(),'>Delete</a></td>';
                echo '</tr>' ;
            }
            echo '</table>';
            
        }
        
       
        
    }
    
    
    
    
}
