<?php

/**
 * Interface for Database Model (Object)
 * 
 * Object interfaces allow you to create code which specifies the methods a class must implement, 
 * without having to define how these methods are handled.
 * 
 * So it's the blueprint for a class on what functions should be created.
 * 
 * In the class name we add an "I" so we know it's an interface
 * 
 * @author GForti
 */
interface IModel {
    /**
    * A method to update all values back to an empty state.
    *
    * @return SELF
    */
    public function reset();
    
    /**
    * A method to set all values based on an associative array.
    *
    * @param {Array} [$values] - must be a valid associative array
    *
    * @return SELF
    */
    public function map(array $values);
}
