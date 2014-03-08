<?php

	class HC_Calendar_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete Calendar Class Test

		public function testCalendar()
		{

			$this->assertEquals(class_exists('HC_Calendar'), true);
		}

		/**
		 * @depends testCalendar
		 */
		public function testCalendarCreation()
		{

			$this->assertNotEmpty(new HC_Calendar());
		}
	}