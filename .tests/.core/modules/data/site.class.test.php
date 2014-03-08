<?php

	class HC_Site_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete HC_Site_Test

		public function testSite()
		{

			$this->assertEquals(class_exists('HC_Site'), true);
		}

		/**
		 * @depends testSite
		 */
		public function testSiteCreation()
		{

			$this->assertNotEmpty($GLOBALS['HC_CORE']->getSite());
		}
	}
