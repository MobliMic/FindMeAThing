<?php

	/**
	 * Class Select Test
	 */
	class HC_Select_Test extends PHPUnit_Framework_TestCase {

		// @todo: HC_Select_Test Test

		public function testSelect()
		{

			$this->assertEquals(class_exists('HC_Select'), true);
		}

		/**
		 * @depends testSelect
		 */
		public function testSelectCreation()
		{

			$this->assertNotEmpty(new HC_Select());
		}

		/**
		 * @depends testSelectCreation
		 */
		public function testSelectHTML()
		{
			$select     = new HC_Select([
				'name'      => 'selectName',
				'class'     => 'selectClass',
				'onclick'   => 'alert("Select Clicked");',
				'disabled'  => true,
				'required'  => true,
				'autofocus' => true,
				'style'     => 'color: red;',
				'multiple'  => true,
				'values'    => [
					['name' => 'Group 1', 'disabled' => false,
					 'value' => [
						 ['name' => 'Name 1', 'value' => 'Value 1', 'disabled' => false, 'selected' => false],
						 ['name' => 'Name 2', 'value' => 'Value 2', 'disabled' => false, 'selected' => false],
						 ['name' => 'Name 3', 'value' => 'Value 3', 'disabled' => false, 'selected' => false]
					 ]
					],
					['name' => 'Name 4', 'value' => 'Value 4', 'disabled' => false, 'selected' => false],
					['name' => 'Group 2', 'disabled' => true,
					 'value' => [
						 ['name' => 'Name 5', 'value' => 'Value 5', 'disabled' => false, 'selected' => false],
						 ['name' => 'Name 6', 'value' => 'Value 6', 'disabled' => false, 'selected' => false],
						 ['name' => 'Name 7', 'value' => 'Value 7', 'disabled' => false, 'selected' => false]
					 ]
					],
					['name' => 'Name 8', 'value' => 'Value 8', 'disabled' => true, 'selected' => false]
				],
				'append' => '<p>Append Select</p>',
				'prepend' => '<p>Prepend Select</p>'
			]);
			$selectHTML = $select->render();
			$this->assertContains('<select', $selectHTML, 'Select did not contain <select,:' . $selectHTML);
			// Check for prepend
			$this->assertStringStartsWith('<p>Prepend Select</p>', $selectHTML, 'Checkbox did not contain prepend');

			// Check for append
			$this->assertStringEndsWith('<p>Append Select</p>', $selectHTML, 'Checkbox did not contain append');
			Assert::HTMLValidate($selectHTML);
		}
	}
