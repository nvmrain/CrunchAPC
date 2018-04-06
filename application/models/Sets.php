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

	/**
	 * Crud validation
	 */

	/**
	 * Validates that the description is an alphanumeric string
	 */
	 function add($record) {
		 if (!is_string($record->description))
 			throw new InvalidArgumentException('Set name must be a string');

 		$clean = str_replace(" ", "", $record->description);
 		if (!ctype_alnum($clean))
 			throw new InvalidArgumentException('Set name must be alpha-numeric');

		 parent::add($record);
	 }

	 function update($record) {
		 if (!is_string($record->description))
 			throw new InvalidArgumentException('Set name must be a string');

 		$clean = str_replace(" ", "", $record->description);
 		if (!ctype_alnum($clean))
 			throw new InvalidArgumentException('Set name must be alpha-numeric');

		 parent::update($record);
	 }
}

 ?>
