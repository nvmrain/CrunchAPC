<?php

class Items extends CSV_Model {
    function __construct() {
        parent::__construct('../data/Items.csv', 'id');
    }

    public $id;
    public $description;
    public $categoryId;
    public $speed;
    public $power;
    public $cost;

    /**
     * id
     * description
     * categoryId
     * speed
     * power
     * cost
     */
}

 ?>
