<?php

	require_once('traits/escape.trait.php');
	require_once('traits/select.trait.php');

	/**
	 * Class Select
	 */
	class HC_Select extends HC_Core {

		/**
		 * @var string
		 */
		private $inputHTML = '';
		use HC_EscapeTrait;
		use HC_SelectTrait;

		/**
		 * Select Constructor
		 * Call the function to generate a select, pass through options to customize.
		 *
		 * @param required => (true, false)            [false]         (Specifies that an select field must be filled out before submitting the form)
		 * @param name => (true, false)        [false]         (Specifies a name and id for the select)
		 * @param values => (['name' => 'Name 1', 'value' => 'Value 1', 'disabled' => false, 'selected' => false]) (Specifies initial values for the select)
		 * @param class => (true, false)        [false]         (Specifies the class of the select)
		 * @param onclick => (true, false)        [false]         (Specifies the onClick of the select)
		 * @param autofocus => (true, false)        [false]         (Specifies that a select should automatically get focus when the page loads)
		 * @param style => (string, false)              [false]         (Specifies the style of the select)
		 * @param disabled => (true, false)        [false]         (Specifies that a select should be disabled)
		 * @param readonly => (true, false)       [false]         (Specifies that an select field is read-only)
		 * @param append => string                      ['']            (Specifies a string that is appended to the select)
		 * @param prepend => string                     ['']            (Specifies a string that is prepended to the select)
		 *
		 * @return string
		 */
		public function __construct($options = [])
		{

			$this->inputHTML = $this->selectTrait($this->parseOptions($options, [
				'name'      => false,
				'class'     => false,
				'onclick'   => false,
				'disabled'  => false,
				'required'  => false,
				'autofocus' => false,
				'style'     => false,
				'multiple'  => false,
				'values'    => [
					[
						'name'     => 'Name 1',
						'value'    => 'Value 1',
						'disabled' => false,
						'selected' => false
					],
					[
						'name'     => 'Name 2',
						'value'    => 'Value 2',
						'disabled' => false,
						'selected' => false
					]
				],
				'append' => '',
				'prepend' => ''
			]));

			return true;
		}

		/**
		 * Select Render
		 * Call the function to render the select created by this class
		 *
		 * @return string
		 */
		public function render()
		{

			// Return all the generated html
			return $this->inputHTML;
		}
	}
