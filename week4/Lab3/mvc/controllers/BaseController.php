<?php
/**
 * Description of BaseController
 *
 * @author MisterSpock
 */

namespace APP\controller;

use App\models\interfaces\IService;

class BaseController {
    
    protected $data = array();
    
    protected function view($page, IService $scope) {

        $folder = "mvc".DIRECTORY_SEPARATOR."views";
        $file = $folder.DIRECTORY_SEPARATOR.$page.'.php';
        if ( is_dir($folder) &&  file_exists( $file ) ) {
            include_once $file; 
            return true;
        } 
        
        return false;
    }
    
}
