<?php

	/**
	 * Class Form Test
	 */
	class HC_Form_Test extends PHPUnit_Framework_TestCase {

		// @todo: HC_Form_Test Test

		public function testForm()
		{

			$this->assertEquals(class_exists('HC_Form'), true);
		}

		/**
		 * @depends testForm
		 */
		public function testFormCreation()
		{

			$this->assertNotEmpty(new HC_Form());
		}

		/**
		 * @depends testFormCreation
		 */
		public function testFormHTML()
		{

			$form = new HC_Form(['name'         => 'FormName',
			                     'class'         => 'FormClass',
			                     'action'       => 'action.php',
			                     'onsubmit'     => 'alert("Submitted");',
			                     'autocomplete' => true,
			                     'style'        => 'color: red;',
			                     'novalidate'   => true,
			                     'method'       => 'GET',
			                     'target'       => '_blank',
			                     'enctype'      => 'application/x-www-form-urlencoded',
			                     'append' => '<p>Append Form</p>',
			                     'prepend' => '<p>Prepend Form</p>']);
			$form->checkbox(['name'      => 'checkboxName',
			                 'checked'   => true,
			                 'class'     => 'checkboxClass',
			                 'onclick'   => 'alert("Checkbox clicked");',
			                 'disabled'  => true,
			                 'required'  => true,
			                 'autofocus' => true,
			                 'style'     => 'color: red;',
			                 'readonly'  => true,
			                 'append'    => '<p>Append Checkbox</p>',
			                 'prepend'   => '<p>Prepend Checkbox</p>']);
			$form->button(['type'      => 'button',
			               'name'      => 'buttonName',
			               'value'     => 'Value',
			               'class'     => 'class',
			               'onclick'   => 'onclick();',
			               'autofocus' => true,
			               'style' => 'color: red;',
			               'disabled'  => true,
			               'append' => '<p>Append Button</p>',
			               'prepend' => '<p>Prepend Button</p>']);
			$form->input(['name'       => 'inputName',
			              'value'      => 'inputValue',
			              'class'      => 'inputClass',
			              'onclick'    => 'alert("Input clicked");',
			              'disabled'   => true,
			              'required'   => true,
			              'autofocus'  => true,
			              'style'      => 'color: red;',
			              'readonly'   => true,
			              'maxlength'  => 255,
			              'pattern'    => '^\w+$',
			              'spellcheck' => true,
			              'type'       => 'text',
			              'append' => '<p>Append Input</p>',
			              'prepend' => '<p>Prepend Input</p>']);
			$form->select([
				'name'      => 'selectName',
				'class'     => 'selectClass',
				'onclick'   => 'alert("Select Clicked");',
				'disabled'  => true,
				'required'  => true,
				'autofocus' => true,
				'style'     => 'color: red;',
				'readonly'  => true,
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

			$formHTML = $form->render();

			// Check for prepend
			$this->assertStringStartsWith('<p>Prepend Form</p>', $formHTML, 'Form did not contain prepend');

			// Check for append
			$this->assertStringEndsWith('<p>Append Form</p>', $formHTML, 'Form did not contain append');

			// Check for start of form
			$this->assertContains('<form', $formHTML, 'Form did not contain <form,:' . $formHTML);

			// Check for checkbox
			$this->assertContains('type="checkbox"', $formHTML, 'Form did not contain type="checkbox",:' . $formHTML);

			// Check for button
			$this->assertContains('type="button"', $formHTML, 'Form did not contain type="button",:' . $formHTML);

			// Check for input
			$this->assertContains('<input', $formHTML, 'Form did not contain <input,:' . $formHTML);

			// Check for select
			$this->assertContains('<select', $formHTML, 'Form did not contain <select,:' . $formHTML);

			// Check for end of form
			$this->assertContains('</form>', $formHTML, 'Form did not contain </form>,:' . $formHTML);


			// Validate the html
			Assert::HTMLValidate($formHTML);
		}
	}
