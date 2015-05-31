<?php
/**
 * Description of Scope
 *
 * @author 000847713
 */
namespace App\models\services;

use App\models\interfaces\IService;

class Scope implements IService {
   private $data = array();

   public function __construct(){
    $this->data = array();
    }

   public function __get($varName){

      if (!array_key_exists($varName,$this->data)){
          //this attribute is not defined!
          throw new ScopeVariableNotFoundException('Scope variable '. $varName .' not found or set.');
      } else { 
          return $this->data[$varName];
      }

   }

   public function __set($varName,$value){
      $this->data[$varName] = $value;
   }
}
