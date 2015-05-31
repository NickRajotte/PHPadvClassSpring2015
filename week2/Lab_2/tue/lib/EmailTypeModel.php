<?php

namespace nrajotte\week2;

class EmailTypeModel implements IModel{
    private $emailtypeid;
    private $emailtype;
    private $active;
    
    function getEmailtypeid() {
        return $this->emailtypeid;
    }

    function getEmailtype() {
        return $this->emailtype;
    }

    function getActive() {
        return $this->active;
    }

    function setEmailtypeid($emailtypeid) {
        $this->emailtypeid = $emailtypeid;
    }

    function setEmailtype($emailtype) {
        $this->emailtype = $emailtype;
    }

    function setActive($active) {
        $this->active = $active;
    }

    /*
     * When a class has to implement an interface those functions must be created in the class.
     */
    
    public function reset() {
        $this->setEmailtypeid('');
        $this->setEmailtype('');
        $this->setActive('');
        return $this;
    }

    public function map(Array $values) {
        
        if ( array_key_exists('emailtypeid', $values) ) {
            $this->setEmailtypeid($values['emailtypeid']);
        }
        
        if ( array_key_exists('emailtype', $values) ) {
            $this->setEmailtype($values['emailtype']);
        }
        
        if ( array_key_exists('active', $values) ) {
            $this->setActive($values['active']);
        }
        return $this;
    }

}
