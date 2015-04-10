<?php

/**
 * Description of PhotoTypeModel
 * 
 * The idea of the model(Data Object) is to provide an object the reflects your
 * table in your database.  Notice all the private variables are the colums from
 * the table in our database.
 * 
 * One word of advise, keep all table names in your models class lowercase.  When creating 
 * getter and setter functions it will camel case (Java Style) your functions.
 *
 * @author User
 */
class PhoneTypeModel implements IModel {
    
    private $phonetypeid;
    private $phonetype;
    private $active;
    
    function getPhonetypeid() {
        return $this->phonetypeid;
    }

    function getPhonetype() {
        return $this->phonetype;
    }

    function getActive() {
        return $this->active;
    }

    function setPhonetypeid($phonetypeid) {
        if (is_integer($phonetypeid) ) {
            $this->phonetypeid = $phonetypeid;
        } else {
            
        }
    }

    function setPhonetype($phonetype) {
        $this->phonetype = $phonetype;
    }

    function setActive($active) {
        $this->active = $active;
    }

    /*
     * When a class has to implement an interface those functions must be created in the class.
     */
    
    public function reset() {
        $this->setPhonetypeid('');
        $this->setPhonetype('');
        $this->setActive('');
        return $this;
    }
    
    public function map(Array $values) {
        
        if ( array_key_exists('phonetypeid', $values) ) {
            $this->setPhonetypeid($values['phonetypeid']);
        }
        
        if ( array_key_exists('phonetype', $values) ) {
            $this->setPhonetype($values['phonetype']);
        }
        
        if ( array_key_exists('active', $values) ) {
            $this->setActive($values['active']);
        }
        return $this;
    }

}
