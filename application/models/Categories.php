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

	/**
	 * Crud validation
	 */

	/**
	 * Validates that the record name is an alphanumeric string
	 */
	function update($record)
	{
		if (!is_string($record->name))
			throw new InvalidArgumentException('Category name must be a string');

		$clean = str_replace(" ", "", $record->name);
		if (!ctype_alnum($clean))
			throw new InvalidArgumentException('Category names must be alpha-numeric');

		parent::update($record);
	}
}

 ?>
