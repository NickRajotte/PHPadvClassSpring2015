<?php

namespace nrajotte\week2;

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
