<?php
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase {

	public static $CI;
	public static $backup;

	static function setUpBeforeClass() {
		CategoryTest::$CI = &get_instance();
		CategoryTest::$CI->load->model('categories');
		CategoryTest::$backup = CategoryTest::$CI->categories->first();
	}

	function setUp() {
		$this->category = CategoryTest::$CI->categories->first();
	}

	function testNameNotString() {
		$this->expectException('InvalidArgumentException');
		$this->category->name = 0;
		CategoryTest::$CI->categories->update($this->category);
	}

	function testNameEmpty() {
		$this->expectException('InvalidArgumentException');
		$this->category->name = "";
		CategoryTest::$CI->categories->update($this->category);
	}

	function testNameInvalid() {
		$this->expectException('InvalidArgumentException');
		$this->category->name = "_test";
		CategoryTest::$CI->categories->update($this->category);
	}

	function testNameValid() {
		$expected = "test";
		$this->category->name = $expected;
		CategoryTest::$CI->categories->update($this->category);
		$return = CategoryTest::$CI->categories->first();
		$this->assertTrue($return->name == $expected);
	}

	static function tearDownAfterClass() {
		CategoryTest::$CI->categories->update(CategoryTest::$backup);
	}
}

 ?>
