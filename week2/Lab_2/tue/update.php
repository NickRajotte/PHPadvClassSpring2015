<?php 
namespace week2\nrajotte;
include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
          <a href="EmailTest.php">Add Email</a><br/>
        <?php
        
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );

        $errors = array();
        
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
       
        $util = new Util();
        $validator = new Validator();
        
        $emailtypeDAO = new EmailTypeDAO($db);
        $emailtypes = $emailtypeDAO->getAllRows();
        
        $emailDAO = new EmailDAO($db);
        $emailModel = new EmailModel();
        
        $email = filter_input(INPUT_POST, 'email');
        $emailid = filter_input(INPUT_POST, 'emailid');
        $emailtypeid = filter_input(INPUT_POST, 'emailtypeid');
        $active = filter_input(INPUT_POST, 'active');
         
        if ( $util->isPostRequest() ) {
            
            var_dump($email);
            if ( !$validator->emailIsValid($email) ) {
            $errors[] = 'Email is not valid';
            }
            
            if( count($errors) > 0 ) {
                foreach ($errors as $value) 
                {
                    echo '<p>',$value,'</p>';
                }
            }
            
            else {
            
            $emailModel->map(filter_input_array(INPUT_POST));
            
            if( $emailDAO->save($emailModel) ) {
                echo '<p> Email Updated </p>';
            }
            else 
            {
                echo '<p> Email not Updated </p>';
            }
            
            }
            
                     
        } 
        else 
        {
            $emailid = filter_input(INPUT_GET, 'emailid');
            $emailModel = $emailDAO->getByID($emailid);
            
            $email = $emailModel->getEmail();
            $emailtype = $emailModel->getEmailtype();
            $emailtypeid = $emailModel->getEmailtypeid();
            $active = $emailModel->getActive(); 
        }
        
        
        ?>
        
        
         
          <h3>Update Email</h3>
        <form action="#" method="post">
             <input type="hidden" name="emailid" value="<?php echo $emailid; ?>" />
             <br />
             <label> Email: </label>
             <input type="text" name="email" value="<?php echo $email; ?>" />
             <br /><br />
            <label>Email Type:</label> 
            <select name="emailtypeid">
                <?php 
                    foreach($emailtypes as $value)
                    {
                        if($value->getEmailtypeid() == $emailtypeid)
                        {
                            echo '<option value="',$value->getEmailtypeid(),'" selected="selected">',$value->getEmailtype(),'</option>';
                        }
                        else
                        {
                            echo '<option value="',$value->getEmailtypeid(),'">',$value->getEmailtype(),'</option>';
                        }
                        
                    }
             ?>               
            </select>
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Update" />
        </form>

                  
    </body>
</html>
