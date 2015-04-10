<?php
/**
 * Interface for Database Access Object
 * 
 * Object interfaces allow you to create code which specifies the methods a class must implement, 
 * without having to define how these methods are handled.
 * 
 * So it's the blueprint for a class on what functions should be created.
 * 
 * In the class name we add an "I" so we know it's an interface
 * 
 * @author GForti
 *  
 */
interface IDAO {
    
    /**
    * A method to check a single row of data exist based on the primary key.
    *
    * @param {String} [$id] - must be a valid ID
    *
    * @return Boolean
    */
    public function idExisit($id);
    /**
    * A method to get a single row of data based on the primary key.
    *
    * @param {String} [$id] - must be a valid ID
    *
    * @return IModel
    */
    public function getById($id);
    /**
    * A method to delete a single row of data based on the primary key.
    *
    * @param {String} [$id] - must be a valid ID
    *
    * @return Boolean
    */
    public function delete($id); 
    /**
    * A method to insert/update a single row of data based.
    *
    * @param {Object} [IModel $model] - must be a valid IModel
    *
    * @return Boolean
    */
    public function save(IModel $model);
    /**
    * A method to retrive all rows from the table
    *
    * @return Array
    */
    
    
}