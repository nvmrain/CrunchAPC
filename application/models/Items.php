<?php

/**
 * Items model that stores the various types of items for all categories.
 */
class Items extends CSV_Model {

    public $id;
    public $description;
    public $categoryId;
    public $speed;
    public $power;
    public $cost;

    /**
     * Constructs the csv model using the Items.csv file.
     */
    function __construct() {
        parent::__construct('../data/Items.csv', 'id');
    }
}

 ?>
