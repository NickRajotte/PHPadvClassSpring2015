<?php

/**
 * Description of BaseDAO
 *
 * @author User
 */

namespace App\models\services;
use \App\models\interfaces\IModel;
use App\models\interfaces\ILogging;
use \PDO;

abstract class BaseDAO {
    
    protected $DB = null;
    protected $model;
    protected $log = null;


    protected function setDB(PDO $DB) {        
        $this->DB = $DB;
    }
    
    protected function getDB() {
        return $this->DB;
    }
    
    protected function getModel() {
        return $this->model;
    }

    protected function setModel(IModel $model) {
        $this->model = $model;
    }
    
    protected function getLog() {
        return $this->log;
    }

    protected function setLog(ILogging $log) {
        if ( $log instanceof ILogging) {
            $this->log = $log;
        }
        
    }  

}
