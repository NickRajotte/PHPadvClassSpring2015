<?php
/**
 * Description of PhoneTypeDAO
 * 
 * DAO = Data Access Object
 * 
 * The idea of a Data Access object is a class the will simply execute crud 
 * operations for your database.  We want to be able to create a DAO for each
 * table in your database.
 * 
 * CRUD = (Create Read Update Disable/Delete)
 *
 * @author User
 */
class PhoneTypeDAO implements IDAO {
    
    private $DB = null;

    public function __construct( PDO $db ) {        
        $this->setDB($db);    
    }
    
    private function setDB( PDO $DB) {        
        $this->DB = $DB;
    }
    
    private function getDB() {
        return $this->DB;
    }
    
    public function idExisit($id) {
        
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT * FROM phonetype WHERE phonetypeid = :phonetypeid");
         
        if ( $stmt->execute(array(':phonetypeid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }
    
    public function getById($id) {
         
         $model = new PhoneTypeModel(); // this creates a dependacy, how can we fix this
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT * FROM phonetype WHERE phonetypeid = :phonetypeid");
         
         if ( $stmt->execute(array(':phonetypeid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->map($results);            
         }
         
         return $model;
    }
    
    
    public function save(IModel $model) {
                 
         $db = $this->getDB();
         
         $values = array( ":phonetype" => $model->getPhonetype(),
                          ":active" => $model->getActive()
                    );
         
                
         if ( $this->idExisit($model->getPhonetypeid()) ) {
             $values[":phonetypeid"] = $model->getPhonetypeid();
             $stmt = $db->prepare("UPDATE phonetype SET phonetype = :phonetype, active = :active WHERE phonetypeid = :phonetypeid");
         } else {             
             $stmt = $db->prepare("INSERT INTO phonetype SET phonetype = :phonetype, active = :active");
         }
         
          
         if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
            return true;
         }
         
         return false;
    }
    
    
    public function delete($id) {
          
         $db = $this->getDB();         
         $stmt = $db->prepare("Delete FROM phonetype WHERE phonetypeid = :phonetypeid");
         
         if ( $stmt->execute(array(':phonetypeid' => $id)) && $stmt->rowCount() > 0 ) {
             return true;
         }
         
         return false;
    }
     
    
    
    public function getAllRows() {
       
        $values = array();         
        $db = $this->getDB();               
        $stmt = $db->prepare("SELECT * FROM phonetype");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
               $model = new PhoneTypeModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
             
        }   else {            
           //log($db->errorInfo() .$stmt->queryString ) ;           
        }  
        
        $stmt->closeCursor();         
         return $values;
     }
     
}
