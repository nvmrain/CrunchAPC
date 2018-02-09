<?php

class Sets extends CSV_Model {
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

     function get($key1, $key2)
     {
         return !isset($this->_data[$key]) ? null : $this->_data[$key];
     }

     function all()
     {
         return $this->_data;
     }
}

 ?>
