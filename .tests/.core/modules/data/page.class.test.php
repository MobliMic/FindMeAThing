<?php

	class HC_Page_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete HC_Page_Test

		public function testPage()
		{

			$this->assertEquals(class_exists('HC_Page'), true);
		}

		/**
		 * @depends testPage
		 */
		public function testPageCreation()
		{

			$this->assertNotEmpty(new HC_Page());
		}
	}

