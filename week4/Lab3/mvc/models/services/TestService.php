<?php
/**
 * Description of TestService
 *
 * @author 000847713
 */

namespace App\models\services;

//use App\models\interfaces\IDAO;
use App\models\interfaces\IService;
//use App\models\interfaces\IModel;


class TestService implements IService{
    
    public function validateForm($email) {
        
        if ( !empty($email) ) {
            return true;
        }
        return false;
    } 
}
