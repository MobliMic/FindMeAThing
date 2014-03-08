<?php

	class HC_Date_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete Date Class Test

		public function testDate()
		{

			$this->assertEquals(class_exists('HC_Date'), true);
		}

		/**
		 * @depends testDate
		 */
		public function testDateCreation()
		{

			$this->assertNotEmpty(new HC_Date());
		}
	}