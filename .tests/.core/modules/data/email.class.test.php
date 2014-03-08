<?php

	/**
	 * Class HC_Email_Test
	 */
	class HC_Email_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete HC_Email_Test

		public function testMail()
		{

			$this->assertEquals(class_exists('HC_Email'), true);
		}

		/**
		 * @depends testMail
		 */
		public function testMailCreation()
		{

			$this->assertNotEmpty(new HC_Email());
		}
	}