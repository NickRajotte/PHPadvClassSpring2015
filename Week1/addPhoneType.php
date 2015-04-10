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
$phoneType = filter_input(INPUT_POST, 'phonetype');
$errors = array();
if ( $util->isPostRequest() ) {
    if ( !$validator->phoneTypeIsValid($phoneType) ) {
        $errors[] = 'Phone type is not valid';
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
    $stmt = $db->prepare("INSERT INTO phonetype SET phonetype = :phonetype");  
                    
    $values = array(":phonetype"=>$phoneType);
    if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
        echo 'Phone Added';
    }       
    
    
    
}
        
        
        
       
        ?>
        
         <h3>Add phone type</h3>
        <form action="#" method="post">
            <label>Phone Type:</label> 
            <input type="text" name="phonetype" value="<?php echo $phoneType; ?>" placeholder="" />
            <input type="submit" value="Submit" />
        </form>
         
         
    <?php 
    
    $dbConfig = array(
        "DB_DNS" => 'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
        "DB_USER" => 'root', 
        "DB_PASSWORD" => '');
    $pdo = new DB($dbConfig);
    $db = $pdo->getDB();
    $stmt = $db->prepare("SELECT * FROM phonetype where active = 1");
    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $value) {
            echo '<p>', $value['phonetype'], '</p>';
        }
    } else {
        echo '<p>No Data</p>';
    }
    ?>
         
         
         
    </body>
</html>