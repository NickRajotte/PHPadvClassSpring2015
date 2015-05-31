<?php
/**
 * Description of IModel
 *
 * @author 000847713
 */
namespace App\models\interfaces;

interface IModel {
    public function reset();
    public function map(array $values);
    public function getAllValues();
}