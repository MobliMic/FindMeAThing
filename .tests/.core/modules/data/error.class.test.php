<?php

	class HC_Error_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete Error Class Test

		public function testError()
		{

			$this->assertEquals(class_exists('HC_Error'), true);
		}

		/**
		 * @depends testError
		 */
		public function testErrorCreation()
		{

			$this->assertNotEmpty(new HC_Error());
		}
	}