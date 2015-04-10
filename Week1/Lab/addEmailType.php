<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        
        <?php
        
$util = new Util();
$validator = new Validator();
$emailType = filter_input(INPUT_POST, 'emailtype');
$errors = array();
if ( $util->isPostRequest() ) {
    if ( !$validator->emailTypeIsValid($emailType) ) {
        $errors[] = 'Email type is not valid';
    }
}
if ( count($errors) > 0 ) {
    foreach ($errors as $value) {
        echo '<p>',$value,'</p>';
    }
} else {
    
    //save to to database.
    $dbConfig = array(
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
        );
            
    
    $pdo = new DB($dbConfig);
    $db = $pdo->getDB();
    $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");  
                    
    $values = array(":emailtype"=>$emailType);
    if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
        echo 'Email Added';
    }       
    
    
    
}
        
        
        
       
        ?>
        
         <h3>Add email type</h3>
        <form action="#" method="post">
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <input type="submit" value="Submit" />
        </form>
         
         
    <?php 
    
    $dbConfig = array(
        "DB_DNS" => 'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
        "DB_USER" => 'root', 
        "DB_PASSWORD" => '');
    $pdo = new DB($dbConfig);
    $db = $pdo->getDB();
    $stmt = $db->prepare("SELECT * FROM emailtype where active = 1");
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $value) {
            echo '<strong><p>', $value['emailtype'], '</p></strong>';
        }
    } else {
        echo '<p>No Data</p>';
    }
    ?>
         
         
         
    </body>
</html>