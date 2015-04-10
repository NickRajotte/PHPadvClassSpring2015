<?php

/**
 * Description of EmailModel
 *
 * @author GFORTI
 * 
 * 
 * The idea of the Model is to create a data object that will reflect the database 
 * table.  Each variable created is a private.  You can use netbeans to insert
 * the getter and setter function (ALT+Insert)
 */
class EmailModel {
    
    private $email;
    
    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }


}
