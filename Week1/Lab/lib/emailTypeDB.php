<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of emailTypeDB
 *
 * @author MisterSpock
 */
class emailTypeDB {
   
    public function Save($emailType)
    {
        /* Start by creating the classes and files you need
         * 
         */
        $util = new Util();
        $validator = new Validator();   
        /*
         * When dealing with forms always collect the data before trying to validate
         * 
         * When getting values from $_POST or $_GET use filter_input
         */
        
        // We use errors to add issues to notify the user
        $errors = array();
        /*
         * We setup this config to get a standard database setup for the page
         */
        $dbConfig = array(
                "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                "DB_USER"=>'root',
                "DB_PASSWORD"=>''
                );
        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        /*
         * we utilize our classes to have less code on the page
         * 
         */
        if ( $util->isPostRequest() ) 
        {
         // we validate only if a post has been made
            if ( !$validator->emailTypeIsValid($emailType) ) 
            {
                $errors[] = 'Email type is not valid';
            }
            // if there are errors display them
            if ( count($errors) > 0 ) 
            {
                foreach ($errors as $value) 
                {
                    echo '<p>',$value,'</p>';
                }
            } 
            else 
            {
                //if no errors, save to to database.
                $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");  
                $values = array(":emailtype"=>$emailType);
                if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) 
                {
                    echo 'Email Added';
                }      
            }
        } 
    }
    public function displayEmails() {        
       $dbConfig = array(
                "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                "DB_USER"=>'root',
                "DB_PASSWORD"=>''
                );
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
    }
}