<?php

class Categories extends CI_Model {

    var $cats = array(
        '1'     => array('id' => '1', 'name' => 'Processor'),
        '2'     => array('id' => '2', 'name' => 'RAM'),
        '3'     => array('id' => '3', 'name' => 'Graphics Card'),
        '4'     => array('id' => '4', 'name' => 'CPU Fan'),
        '5'     => array('id' => '5', 'name' => 'Power Source')
    );

    function __construct() {
        parent::__construct();
    }

    /**
     * Retrieve and existing DB record.
     * @param string $key Primary key of the record to return.
	 * @param string $key2 Second part of composite key, if applicable
	 * @return object The requested record, null if not found.
     */
    function get($key)
    {
        return !isset($this->cats[$key]) ? null : $this->cats[$key];
    }

    /**
     * Retrieve all existing DB records.
	 * @return object All records.
     */
    function all()
    {
        return $this->cats;
    }
}

 ?>
