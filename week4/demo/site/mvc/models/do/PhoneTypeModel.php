<?php

/**
 * Description of PhotoTypeModel
 *
 * @author User
 */

namespace App\models\services;


class PhoneTypeModel extends BaseModel {
    
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
        $this->phonetypeid = $phonetypeid;
    }

    function setPhonetype($phonetype) {
        $this->phonetype = $phonetype;
    }

    function setActive($active) {
        $this->active = $active;
    }


}
