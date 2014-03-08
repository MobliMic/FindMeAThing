<?php

	class HC_Directory_Test extends PHPUnit_Framework_TestCase {

		//@todo: Complete Directory Class Test

		public function testDirectory()
		{

			$this->assertEquals(class_exists('HC_Directory'), true);
		}

		/**
		 * @depends testDirectory
		 */
		public function testDirectoryCreation()
		{

			$this->assertNotEmpty(new HC_Directory());
		}
	}