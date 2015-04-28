<?php
namespace week2\nrajotte;
/**
 * Util - functions used to help with the over all application
 *
 * @author MisterSpock
 */
class Util {
    
    
    /**
    * A method to check if a Post request has been made.
    *    
    * @return boolean
    */    
    public function isPostRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
    }
    
    /**
    * A method to check if a Get request has been made.
    *    
    * @return boolean
    */    
    public function isGetRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' );
    }
    
}
