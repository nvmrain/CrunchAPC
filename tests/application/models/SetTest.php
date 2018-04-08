<?php
use PHPUnit\Framework\TestCase;

class SetTest extends TestCase {
	public static $CI;
	public static $backup;

	static function setUpBeforeClass() {
		SetTest::$CI = &get_instance();
		SetTest::$CI->load->model('sets');
		SetTest::$backup = clone SetTest::$CI->sets->first();
	}

	function setUp() {
		$this->set = SetTest::$CI->sets->first();
	}

	function testDescNotString() {
		$this->expectException('InvalidArgumentException');
		$this->set->description = 0;
		SetTest::$CI->sets->update($this->set);
	}

	function testDescEmpty() {
		$this->expectException('InvalidArgumentException');
		$this->set->description = "";
		SetTest::$CI->sets->update($this->set);
	}

	function testDescInvalid() {
		$this->expectException('InvalidArgumentException');
		$this->set->description = "_test";
		SetTest::$CI->sets->update($this->set);
	}

	function testDescValid() {
		$expected = "test";
		$this->set->description = $expected;
		SetTest::$CI->sets->update($this->set);
		$return = SetTest::$CI->sets->first();
		$this->assertTrue($return->description == $expected);
	}

	static function tearDownAfterClass() {
		SetTest::$CI->sets->update(SetTest::$backup);
	}
}

?>
