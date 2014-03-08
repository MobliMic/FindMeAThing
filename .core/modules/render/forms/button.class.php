<?php

	require_once('traits/escape.trait.php');
	require_once('traits/button.trait.php');

	/**
	 * Class Button
	 */
	class HC_Button extends HC_Core {

		/**
		 * @var string
		 */
		private $inputHTML = '';
		use HC_EscapeTrait;
		use HC_ButtonTrait;


		/**
		 * Button Constructor
		 * Call the function to generate a button, pass through options to customize.
		 *
		 * @param type => ('button', 'submit', 'reset') ['button']      (Specifies the type of the button)
		 * @param name => (true, false)                 [false]         (Specifies a name and id for the button)
		 * @param value => (true, false)                [ucfirst(type)] (Specifies an initial value for the button)
		 * @param class => (true, false)                [false]         (Specifies the class of the button)
		 * @param onclick => (true, false)              [false]         (Specifies the onClick of the button)
		 * @param autofocus => (true, false)            [false]         (Specifies that a button should automatically get focus when the page loads)
		 * @param style => (string, false)              [false]         (Specifies the style of the button)
		 * @param disabled => (true, false)             [false]         (Specifies that a button should be disabled)
		 * @param append => string                      ['']            (Specifies a string that is appended to the button)
		 * @param prepend => string                     ['']            (Specifies a string that is prepended to the button)
		 *
		 * @return integer
		 */
		public function __construct($options = [])
		{

			$this->inputHTML = $this->buttonTrait($this->parseOptions($options, ['type'      => 'button',
			                                                                     'name'      => false,
			                                                                     'value'     => false,
			                                                                     'class'     => false,
			                                                                     'onclick'   => false,
			                                                                     'autofocus' => false,
			                                                                     'style' => false,
			                                                                     'disabled'  => false,
			                                                                     'append' => '',
																				 'prepend' => ''
			]));

			return true;
		}

		/**
		 * Button Render
		 * Call the function to render the button created by this class
		 *
		 * @return string
		 */
		public function render()
		{

			// Return all the generated html
			return $this->inputHTML;
		}
	}
