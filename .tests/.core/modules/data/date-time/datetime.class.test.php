<?php

	class HC_DateTime_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete DateTime Class Test

		public function testDateTime()
		{

			$this->assertEquals(class_exists('HC_DateTime'), true);
		}

		/**
		 * @depends testDateTime
		 */
		public function testDateTimeCreation()
		{

			$this->assertNotEmpty(new HC_DateTime());
		}
	}