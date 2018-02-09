<?php

class Sets extends CSV_Model {

    public $id;
    public $description;
    public $cpuId;
    public $ramId;
    public $gpuId;
    public $fanId;
    public $psuId;

    function __construct() {
        parent::__construct('../data/Sets.csv', 'id');
    }

    /**
     * id
     * cpuId
     * ramId
     * gpuId
     * fanId
     * psuId
     */
}

 ?>
