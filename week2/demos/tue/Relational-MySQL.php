<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        /*
         * Normally with relational MySQL your dealing with multipule databases that have a connection with another table.
         * 
         * In this example we have a phone table that has a phonetypeid that is linked to the phone type table.
         * We can use the phonetypeid from the phone table to get a match from the phonetype table and get the phonetype.
         * 
         * phone->phonetypeid belongs to phonetype->phonetypeid
         * 
         * 
         * if you need a review about joins this article is good
         * 
         * http://www.sitepoint.com/understanding-sql-joins-mysql-database/
         * 
         */
        

        $dbConfig = array(
                "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                "DB_USER"=>'root',
                "DB_PASSWORD"=>''
                );

        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $stmt = $db->prepare("SELECT phoneid from phone where phone = :phone");  
        $values = array(":phone"=>'555-444-3333');
        
        if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
            echo '<p>Phone Already added</p>';
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
             
            // lets update the phone
            $stmt = $db->prepare("UPDATE phone SET lastupdated = now() where phoneid = :phoneid");  
            $values = array(":phoneid"=>$result['phoneid']);
            if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
                echo '<p>Phone Updated</p>';
            }
            
            
        } else {
        
            // lets add a phone
            // now() = MySql timestamp function
            $stmt = $db->prepare("INSERT INTO phone SET phone = :phone, phonetypeid = :phonetypeid, logged = now(), lastupdated = now()");  
            $values = array(":phone"=>'555-444-3333',":phonetypeid"=>'2');
            if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
                echo '<p>Phone Added</p>';
            } 

        }
        
        
        
        
        /*
         * Selects see the data
         */
        $stmt = $db->prepare("SELECT phone.phone, phonetype.phonetype, phone.logged, phone.lastupdated FROM phone LEFT JOIN phonetype on phone.phonetypeid = phonetype.phonetypeid");  
                
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
        
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            echo '<table>';
            foreach ($results as $value) {
                echo '<tr>';
                echo '<td>', $value['phone'], '</td>';
                echo '<td>', $value['phonetype'], '</td>';
                // we use the MySQL timestamp to format it in PHP
                echo '<td>', date("F j, Y g:i(s) a", strtotime($value['logged']))  , '</td>';
                echo '<td>', date("F j, Y g:i(s) a", strtotime($value['lastupdated'])) , '</td>';
                echo '</td>';
            }
             echo '</table>';
        } else {
            echo '<p>No Data</p>';
        }
        
        
        
        ?>
    </body>
</html>
