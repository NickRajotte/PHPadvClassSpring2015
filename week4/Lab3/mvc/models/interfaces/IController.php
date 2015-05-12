<?php

/**
 *
 * @author MisterSpock
 */

namespace App\models\interfaces;

use App\models\interfaces\IService;

interface IController {
    public function execute(IService $scope);
}
