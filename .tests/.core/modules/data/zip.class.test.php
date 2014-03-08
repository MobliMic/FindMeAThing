<?php

	class HC_Zip_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete Zip Class Test

		public function testZip()
		{

			$this->assertEquals(class_exists('HC_Zip'), true);
		}

		/**
		 * @depends testZip
		 */
		public function testZipCreation()
		{

			$this->assertNotEmpty(new HC_Zip());
		}
	}