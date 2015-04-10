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
                              
            // get values from URL
            $phonetypeid = filter_input(INPUT_GET, 'phonetypeid');
            
            if ( NULL !== $phonetypeid ) {
               $phoneTypeDAO = new PhoneTypeDAO($db);
               
               if ( $phoneTypeDAO->delete($phonetypeid) ) {
                   echo 'Phone Type was deleted';                  
               }                
        
            }
            
            
             echo '<p><a href="',filter_input(INPUT_SERVER, 'HTTP_REFERER'),'">Go back</a></p>';
        
        ?>
    </body>
</html>
