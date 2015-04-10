<?php
/**
 * PhoneModel
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
class PhoneModel implements IModel {
    
    private $phoneid;
    private $phone;
    private $phonetypeid;
    private $phonetype;
    private $phonetypeactive;
    private $logged;
    private $lastupdated;
    private $active;
    
    function getPhoneid() {
        return $this->phoneid;
    }

    function getPhone() {
        return $this->phone;
    }

    function getPhonetypeid() {
        return $this->phonetypeid;
    }
    
     function getPhonetype() {
        return $this->phonetype;
    }

    function getPhonetypeactive() {
        return $this->phonetypeactive;
    }

    function getLogged() {
        return $this->logged;
    }

    function getLastupdated() {
        return $this->lastupdated;
    }

    function getActive() {
        return $this->active;
    }

    function setPhoneid($phoneid) {
        $this->phoneid = $phoneid;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function setPhonetypeid($phonetypeid) {
        $this->phonetypeid = $phonetypeid;
    }

    function setPhonetype($phonetype) {
        $this->phonetype = $phonetype;
    }

    function setPhonetypeactive($phonetypeactive) {
        $this->phonetypeactive = $phonetypeactive;
    }
    
    function setLogged($logged) {
        $this->logged = $logged;
    }

    function setLastupdated($lastupdated) {
        $this->lastupdated = $lastupdated;
    }

    function setActive($active) {
        $this->active = $active;
    }
    
    /*
    * When a class has to implement an interface those functions must be created in the class.
    */
    public function reset() {
        $this->setPhoneid('');
        $this->setPhone('');
        $this->setPhonetypeid('');
        $this->setPhonetype('');
        $this->setPhonetypeactive('');
        $this->setLogged('');
        $this->setLastupdated('');
        $this->setActive('');
        return $this;
    }
    
    
   
    public function map(array $values) {
        
        if ( array_key_exists('phoneid', $values) ) {
            $this->setPhoneid($values['phoneid']);
        }
        
        if ( array_key_exists('phone', $values) ) {
            $this->setPhone($values['phone']);
        }
        
        if ( array_key_exists('phonetypeid', $values) ) {
            $this->setPhonetypeid($values['phonetypeid']);
        }
        
        if ( array_key_exists('phonetype', $values) ) {
            $this->setPhonetype($values['phonetype']);
        }
        
        if ( array_key_exists('phonetypeactive', $values) ) {
            $this->setPhonetypeactive($values['phonetypeactive']);
        }
        
        if ( array_key_exists('logged', $values) ) {
            $this->setLogged($values['logged']);
        }
        
        if ( array_key_exists('lastupdated', $values) ) {
            $this->setLastupdated($values['lastupdated']);
        }
        
        if ( array_key_exists('active', $values) ) {
            $this->setActive($values['active']);
        }
        return $this;
    }


}
