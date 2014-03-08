<?php

	class HC_URL_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete Url Class Test

		public function testURL()
		{

			$this->assertEquals(class_exists('HC_URL'), true);
		}

		/**
		 * @depends testURL
		 */
		public function testURLCreation()
		{

			$this->assertNotEmpty(new HC_URL());
		}
	}