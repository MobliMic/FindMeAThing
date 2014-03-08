<?php

	/**
	 * Class HC_APC_Test
	 */
	class HC_APC_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete HC_APC_Test

		public function testAPC()
		{

			$this->assertEquals(class_exists('HC_APC'), true, 'HC_APC Class does not exist.');
		}

		/**
		 * @depends testAPC
		 */
		public function testAPCCreation()
		{

			$this->assertNotEmpty(new HC_APC(), 'Object of HC_APC could not be created.');
		}
	}