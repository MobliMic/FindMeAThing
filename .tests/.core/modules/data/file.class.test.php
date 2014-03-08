<?php

	class HC_File_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete File Class Test

		public function testFile()
		{

			$this->assertEquals(class_exists('HC_File'), true);
		}

		/**
		 * @depends testFile
		 */
		public function testFileCreation()
		{

			$this->assertNotEmpty(new HC_File());
		}
	}