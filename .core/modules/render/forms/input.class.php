<?php

	require_once('traits/escape.trait.php');
	require_once('traits/input.trait.php');

	/**
	 * Class HC_Input
	 */
	class HC_Input extends HC_Core {

		/**
		 * @var string
		 */
		private $inputHTML = '';
		use HC_EscapeTrait;
		use HC_InputTrait;

		/**
		 * Text Input Constructor
		 * Call the function to generate a text input, pass through options to customize.
		 *
		 * @param createElement => (true, false)        [true]          (Specifies whether to generate the element as part of the form, or return the html)
		 * @param required => (true, false)            [false]         (Specifies that an input field must be filled out before submitting the form)
		 * @param name => (true, false)        [false]         (Specifies a name and id for the input)
		 * @param value => (true, false)        [ucfirst(type)] (Specifies an initial value for the input)
		 * @param class => (true, false)        [false]         (Specifies the class of the input)
		 * @param onclick => (true, false)        [false]         (Specifies the onClick of the input)
		 * @param autofocus => (true, false)        [false]         (Specifies that a input should automatically get focus when the page loads)
		 * @param style => (string, false)              [false]         (Specifies the style of the input)
		 * @param disabled => (true, false)        [false]         (Specifies that a input should be disabled)
		 * @param readonly => (true, false)       [false]         (Specifies that an input field is read-only)
		 * @param maxlength => (0-999, false)      [false]         (Specifies the maximum number of characters allowed in an <input> element)
		 * @param pattern => (regexp, false)     [false]         (Specifies a regular expression that an <input> element's value is checked against)
		 * @param spellcheck => (true, false)       [false]         (Specifies whether the element is to have its spelling and grammar checked or not)
		 * @param append => string                      ['']            (Specifies a string that is appended to the input)
		 * @param prepend => string                     ['']            (Specifies a string that is prepended to the input)
		 *
		 * @return integer
		 */
		public function __construct($options = [])
		{

			$this->inputHTML = $this->inputTrait($this->parseOptions($options, ['name'       => false,
			                                                                    'value'      => false,
			                                                                    'class'      => false,
			                                                                    'onclick'    => false,
			                                                                    'disabled'   => false,
			                                                                    'required'   => false,
			                                                                    'autofocus'  => false,
			                                                                    'style'      => false,
			                                                                    'readonly'   => false,
			                                                                    'maxlength'  => false,
			                                                                    'pattern'    => false,
			                                                                    'spellcheck' => false,
			                                                                    'type'       => 'text',
			                                                                    'append' => '',
			                                                                    'prepend' => ''
			]));

			return true;
		}

		/**
		 * Text Input Render
		 * Call the function to render the text input created by this class
		 *
		 * @return string
		 */
		public function render()
		{

			// Return all the generated html
			return $this->inputHTML;
		}
	}
