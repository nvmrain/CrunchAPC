<?php

/**
 * Sets model that stores collections of items.
 */
class Sets extends CSV_Model {

    public $id;
    public $description;
    public $cpuId;
    public $ramId;
    public $gpuId;
    public $fanId;
    public $psuId;

    /**
     * Constructs a csv model using the Sets.csv file.
     */
    function __construct() {
        parent::__construct('../data/Sets.csv', 'id');
    }
}

 ?>
