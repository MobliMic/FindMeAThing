<?php

	require_once('traits/escape.trait.php');
	require_once('traits/checkbox.trait.php');
	/**
	 * Class Checkbox
	 */
	class HC_Checkbox extends HC_Core {

		/**
		 * @var string
		 */
		private $inputHTML = '';
		use HC_EscapeTrait;
		use HC_CheckBoxTrait;

		/**
		 * Checkbox Constructor
		 * Call the function to generate a checkbox input, pass through options to customize.
		 *
		 * @param createElement => (true, false)   [true]      (Specifies whether to generate the element as part of the form, or return the html)
		 * @param required => (true, false)   [false]     (Specifies that an input field must be filled out before submitting the form)
		 * @param name => (true, false)   [false]     (Specifies a name and id for the input)
		 * @param checked => (true, false)   [false]     (Specifies whether the checkbox is checked)
		 * @param class => (true, false)   [false]     (Specifies the class of the input)
		 * @param onclick => (true, false)   [false]     (Specifies the onClick of the input)
		 * @param autofocus => (true, false)   [false]     (Specifies that a input should automatically get focus when the page loads)
		 * @param style => (string, false)              [false]         (Specifies the style of the checkbox)
		 * @param disabled => (true, false)   [false]     (Specifies that a input should be disabled)
		 * @param append => string                      ['']            (Specifies a string that is appended to the checkbox)
		 * @param prepend => string                     ['']            (Specifies a string that is prepended to the checkbox)
		 * @return integer
		 */
		public function __construct($options = [])
		{

			$this->inputHTML = $this->checkboxTrait($this->parseOptions($options, ['name'      => false,
			                                                                       'checked'   => false,
			                                                                       'class'     => false,
			                                                                       'onclick'   => false,
			                                                                       'disabled'  => false,
			                                                                       'required'  => false,
			                                                                       'autofocus' => false,
			                                                                       'style'     => false,
			                                                                       'append'    => '',
			                                                                       'prepend'   => ''
			]));

			return true;
		}

		/**
		 * Checkbox Render
		 * Call the function to render the checkbox created by this class
		 *
		 * @return string
		 */
		public function render()
		{

			// Return all the generated html
			return $this->inputHTML;
		}
	}
