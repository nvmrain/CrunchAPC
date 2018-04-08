<?php
use PHPUnit\Framework\TestCase;

class ItemsTest extends TestCase {
	public static $CI;
	public static $backup;

	static function setUpBeforeClass() {
		ItemsTest::$CI = &get_instance();
		ItemsTest::$CI->load->model('Items');
		ItemsTest::$backup = clone ItemsTest::$CI->items->first();
	}

	function setUp() {
		$this->item = ItemsTest::$CI->items->first();
	}

	function testDescNotString() {
		$this->expectException('InvalidArgumentException');
		$this->item->description = 0;
		ItemsTest::$CI->items->update($this->item);
	}

	function testDescInvalid() {
		$this->expectException('InvalidArgumentException');
		$this->item->description = "_test";
		ItemsTest::$CI->items->update($this->item);
	}

	function testDescValid() {
		$expected = "test";
		$this->item->description = $expected;
		ItemsTest::$CI->items->update($this->item);
		$return = ItemsTest::$CI->items->first();
		$this->assertTrue($return->description == $expected);
	}

	function testSpeedNAN() {
		$this->expectException('InvalidArgumentException');
		$this->item->speed = "five";
		ItemsTest::$CI->items->update($this->item);
	}

	function testSpeedNegative() {
		$this->expectException('InvalidArgumentException');
		$this->item->speed = -1;
		ItemsTest::$CI->items->update($this->item);
	}

	function testCostNAN() {
		$this->expectException('InvalidArgumentException');
		$this->item->cost = "five";
		ItemsTest::$CI->items->update($this->item);
	}

	function testCostNegative() {
		$this->expectException('InvalidArgumentException');
		$this->item->cost = -1;
		ItemsTest::$CI->items->update($this->item);
	}

	static function tearDownAfterClass() {
		ItemsTest::$CI->items->update(ItemsTest::$backup);
	}
}

 ?>
