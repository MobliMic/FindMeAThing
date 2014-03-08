<?php

	class HC_List_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete List Class Test

		public function testList()
		{

			$this->assertEquals(class_exists('HC_List'), true);
		}

		/**
		 * @depends testList
		 */
		public function testListCreation()
		{

			$this->assertNotEmpty(new HC_List());
		}
	}