<?php
namespace week2\jrola;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Jack
 */
interface IDAO {
    //put your code here
    public function getById($id);
    public function delete($id); 
    public function save(IModel $model);

    public function getAllRows();
}
