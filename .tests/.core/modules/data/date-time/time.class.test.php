<?php

	class HC_Time_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete Time Class Test

		public function testTime()
		{

			$this->assertEquals(class_exists('HC_Time'), true);
		}

		/**
		 * @depends testTime
		 */
		public function testTimeCreation()
		{

			$this->assertNotEmpty(new HC_Time());
		}
	}