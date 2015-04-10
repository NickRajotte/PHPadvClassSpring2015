<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
                
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        
        $phone = filter_input(INPUT_POST, 'phone');
        $phoneTypeid = filter_input(INPUT_POST, 'phonetypeid');
        $active = filter_input(INPUT_POST, 'active');
        
        
         $phoneTypeDAO = new PhoneTypeDAO($db);
         $phoneDAO = new PhoneDAO($db);
         
         $phoneTypes = $phoneTypeDAO->getAllRows();
        
         $util = new Util();
         
          if ( $util->isPostRequest() ) {
                            
               $validator = new Validator(); 
                $errors = array();
                if( !$validator->phoneIsValid($phone) ) {
                    $errors[] = 'Phone is invalid';
                } 
                
                if ( !$validator->activeIsValid($active) ) {
                     $errors[] = 'Active is invalid';
                }
                
                if ( empty($phoneTypeid) ) {
                     $errors[] = 'Phone type is invalid';
                }
                
                
                
                if ( count($errors) > 0 ) {
                    foreach ($errors as $value) {
                        echo '<p>',$value,'</p>';
                    }
                } else {
                    
                    
                    $phoneModel = new PhoneModel();
                    
                    $phoneModel->map(filter_input_array(INPUT_POST));
                    
                   // var_dump($phonetypeModel);
                    if ( $phoneDAO->save($phoneModel) ) {
                        echo 'Phone Added';
                    } else {
                        echo 'Phone not added';
                    }
                    
                }
          }
        
        ?>
        
        
         <h3>Add phone</h3>
        <form action="#" method="post">
            <label>Phone:</label>            
            <input type="text" name="phone" value="<?php echo $phone; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            <br /><br />
            <label>Phone Type:</label>
            <select name="phonetypeid">
            <?php 
                foreach ($phoneTypes as $value) {
                    if ( $value->getPhonetypeid() == $phoneTypeid ) {
                        echo '<option value="',$value->getPhonetypeid(),'" selected="selected">',$value->getPhonetype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getPhonetypeid(),'">',$value->getPhonetype(),'</option>';
                    }
                }
            ?>
            </select>
            
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
            <table border="1" cellpadding="5">
                <tr>
                    <th>Phone</th>
                    <th>Phone Type</th>
                    <th>Last updated</th>
                    <th>Logged</th>
                    <th>Active</th>
                </tr>
         <?php 
            $phones = $phoneDAO->getAllRows(); 
            foreach ($phones as $value) {
                echo '<tr><td>',$value->getPhone(),'</td><td>',$value->getPhonetype(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td></tr>' ;
            }

         ?>
            </table>
    </body>
</html>
