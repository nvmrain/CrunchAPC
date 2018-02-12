<?php

/**
 * Categories model that stores the various categories of items.
 */
class Categories extends CSV_Model {

    public $id;
    public $name;

    /**
     * Constructs the csv persistence model using the Categories.csv file.
     */
    function __construct() {
        parent::__construct('../data/Categories.csv', 'id');
    }
}

 ?>
