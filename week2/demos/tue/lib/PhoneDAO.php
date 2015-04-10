 <?php
/**
 * PhoneDAO
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

// *** NOTE this class is not complete and does not work
class PhoneDAO implements IDAO {
    
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
        $stmt = $db->prepare("SELECT phoneid FROM phone WHERE phoneid = :phoneid");
         
        if ( $stmt->execute(array(':phoneid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }
    
    public function getById($id) {
         
         $model = new PhoneModel(); // this creates a dependacy, how can we fix this
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT phone.phoneid, phone.phone, phone.phonetypeid, phonetype.phonetype, phonetype.active as phonetypeactive, phone.logged, phone.lastupdated, phone.active"
                 . " FROM phone LEFT JOIN phonetype on phone.phonetypeid = phonetype.phonetypeid WHERE phoneid = :phoneid");
         
         if ( $stmt->execute(array(':phoneid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->map($results);
         }
         
         return $model;
    }
    
    
    public function save(IModel $model) {
                 
         $db = $this->getDB();
         
         $values = array( ":phone" => $model->getPhone(),
                          ":active" => $model->getActive(),
                          ":phonetypeid" => $model->getPhonetypeid(),
             
                    );
         
                
         if ( $this->idExisit($model->getPhoneid()) ) {
             $values[":phoneid"] = $model->getPhoneid();
             $stmt = $db->prepare("UPDATE phone SET phone = :phone, phonetypeid = :phonetypeid,  active = :active, lastupdated = now() WHERE phoneid = :phoneid");
         } else {             
             $stmt = $db->prepare("INSERT INTO phone SET phone = :phone, phonetypeid = :phonetypeid, active = :active, logged = now(), lastupdated = now()");
         }
         
          
         if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
            return true;
         }
         
         return false;
    }
    
    
    public function delete($id) {
          
         $db = $this->getDB();         
         $stmt = $db->prepare("Delete FROM phone WHERE phoneid = :phoneid");
         
         if ( $stmt->execute(array(':phoneid' => $id)) && $stmt->rowCount() > 0 ) {
             return true;
         }
         
         return false;
    }
     
    
    
    public function getAllRows() {
       
        $values = array();         
        $db = $this->getDB();               
        $stmt = $db->prepare("SELECT phone.phoneid, phone.phone, phone.phonetypeid, phonetype.phonetype, phonetype.active as phonetypeactive, phone.logged, phone.lastupdated, phone.active"
                 . " FROM phone LEFT JOIN phonetype on phone.phonetypeid = phonetype.phonetypeid");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
               $model = new PhoneModel();
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