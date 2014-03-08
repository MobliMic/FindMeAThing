<?php

	class HC_Table_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete Table Class Test

		public function testTable()
		{

			$this->assertEquals(class_exists('HC_Table'), true);
		}

		/**
		 * @depends testTable
		 */
		public function testTableCreation()
		{

			$this->assertNotEmpty(new HC_Table());
		}
	}