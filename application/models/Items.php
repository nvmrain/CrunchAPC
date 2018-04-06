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

	/**
	 * Crud validation
	 */

	/**
	 * Validates that the description is an alphanumeric string,
	 * that speed and cost are >= 0
	 */
	function update($record) {
		if (!is_string($record->description))
			throw new InvalidArgumentException('Item name must be a string');

		$clean = str_replace(" ", "", $record->description);
		if (!ctype_alnum($clean))
			throw new InvalidArgumentException('Item name must be alpha-numeric');

		if (!is_numeric($record->speed) || $record->speed < 0)
			throw new InvalidArgumentException('Speed must be at least 0');

		if (!is_numeric($record->cost) || $record->cost < 0)
			throw new InvalidArgumentException('Cost must be at least 0');

		parent::update($record);
	}
}

 ?>
