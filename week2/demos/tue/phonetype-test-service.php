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
       
        $phoneType = filter_input(INPUT_POST, 'phonetype');
        $active = filter_input(INPUT_POST, 'active');
        $phonetypeid = filter_input(INPUT_POST, 'phonetypeid');
        
        $util = new Util();
        $validator = new Validator();
        $phoneTypeDAO = new PhoneTypeDAO($db);
        
        
        $phonetypeModel = new PhoneTypeModel();
        $phonetypeModel->setActive($active);
        $phonetypeModel->setPhonetype($phoneType);

        
        $phoneTypeService = new PhoneTypeService($db, $util, $validator, $phoneTypeDAO, $phonetypeModel);
        
        $phoneTypeService->saveForm();
        
        
        ?>
        
        
         <h3>Add phone type</h3>
        <form action="#" method="post">
            <label>Phone Type:</label> 
            <input type="text" name="phonetype" value="<?php echo $phoneType; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
         
         <?php         
             $phoneTypeService->displayPhonesActions();
         ?>
         
         
    </body>
</html>
