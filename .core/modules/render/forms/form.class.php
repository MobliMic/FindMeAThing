<?php

	require_once('traits/escape.trait.php');
	require_once('traits/button.trait.php');
	require_once('traits/checkbox.trait.php');
	require_once('traits/input.trait.php');
	require_once('traits/select.trait.php');

	/**
	 * Class Form
	 */
	class HC_Form extends HC_Core {

		/**
		 * @var string
		 */
		private $formName = '';

		/**
		 * @var string
		 */
		private $formStartHTML = '';

		/**
		 * @var string
		 */
		private $formBodyHTML = '';

		/**
		 * @var string
		 */
		private $formEndHTML = '';
		use HC_EscapeTrait;
		use HC_ButtonTrait;
		use HC_CheckBoxTrait;
		use HC_InputTrait;
		use HC_SelectTrait;

		/**
		 * Form Constructor
		 * Call the function to generate a form, pass through options to customize.
		 *
		 * @param name => (true, false)          [false]     (Specifies the name and id attributes of the form element)
		 * @param action => (true, false)          [false]     (Specifies where to send the form-data when a form is submitted)
		 * @param onsubmit => (true, false)          [false]     (Set the onsubmit attribute of the form element)
		 * @param autocomplete => (true, false)          [false]     (Specifies whether a form should have autocomplete on or off)
		 * @param style => (string, false)              [false]         (Specifies the style of the form element)
		 * @param novalidate => (true, false)          [false]     (Specifies that the form should not be validated when submitted)
		 * @param method => ('get', 'post', false) [false]     (Specifies the HTTP method to use when sending form-data)
		 * @param target => ('_blank', '_self', '_parent', '_top', false) [false]
		 * @param enctype => ('application/x-www-form-urlencoded', 'multipart/form-data', 'text/plain', false) [false] (Specifies how the form-data should be encoded when submitting it to the server (only for method="post"))
		 * @param append => string                      ['']            (Specifies a string that is appended to the form element)
		 * @param prepend => string                     ['']            (Specifies a string that is prepended to the form element)
		 *
		 * @return integer
		 */
		public function __construct($options = [])
		{

			$options = $this->parseOptions($options, [
				'name'         => false,
				'class'         => false,
				'action'       => false,
				'onsubmit'     => false,
				'autocomplete' => false,
				'style'        => false,
				'novalidate'   => false,
				'method'       => false,
				'target'       => false,
				'enctype'      => false,
				'append' => '',
				'prepend' => ''
			]);

			// Start the form, with a name/id if defined
			if (is_string($options['name'])) {
				$options['name'] = htmlspecialchars($options['name']);

				// Start Creating the form HTML
				$this->formStartHTML = $options['prepend'] . '<form id="' . $options['name'] . '" name="' . $options['name'] . '"';

				// Set the form name
				$this->formName = $options['name'];
			} else {
				// Start Creating the form HTML
				$this->formStartHTML = $options['prepend'] . '<form';
			}

			// Allow setting the class
			if (is_string($options['class'])) {
				$this->formStartHTML .= ' class="' . htmlspecialchars($options['class']) . '"';
			};

			// Allow setting the action
			if (is_string($options['action'])) {
				$this->formStartHTML .= ' action="' . htmlspecialchars($options['action']) . '"';
			};

			// Allow setting the onSubmit
			if (is_string($options['onsubmit'])) {
				$this->formStartHTML .= ' onsubmit="' . htmlspecialchars($options['onsubmit']) . '"';
			};

			// Allow setting the autocomplete
			if ($options['autocomplete'] !== false) {
				$this->formStartHTML .= ' autocomplete="on"';
			};

			// Allow setting the novalidate
			if ($options['novalidate'] !== false) {
				$this->formStartHTML .= ' novalidate="novalidate"';
			};

			// Allow setting the method
			if (is_string($options['method'])) {
				$this->formStartHTML .= ' method="' . htmlspecialchars($options['method']) . '"';
			};

			// Allow setting the target
			if (is_string($options['target'])) {
				$this->formStartHTML .= ' target="' . htmlspecialchars($options['target']) . '"';
			};

			// Allow setting the enctype
			if (is_string($options['enctype'])) {
				$this->formStartHTML .= ' enctype="' . htmlspecialchars($options['enctype']) . '"';
			};

			// Close off the element
			$this->formStartHTML .= '>';

			// Make sure the form gets closed
			$this->formEndHTML = '</form>' . $options['append'];

			return true;
		}

		/**
		 * Button - see trait buttonTrait
		 *
		 * @param array $options
		 *
		 * @return bool
		 */
		public function button($options = [])
		{

			$this->formBodyHTML .= $this->buttonTrait($this->parseOptions($options, [
				'type'      => 'button',
				'name'      => false,
				'value'     => false,
				'class'     => false,
				'onclick'   => false,
				'autofocus' => false,
				'style'     => false,
				'disabled'  => false,
			    'append' => '',
				'prepend' => ''
			]));

			return true;
		}

		/**
		 * Select - see trait selectTrait
		 *
		 * @param array $options
		 *
		 * @return bool
		 */
		public function select($options = [])
		{

			$this->formBodyHTML .= $this->selectTrait($this->parseOptions($options, [
				'name'      => false,
				'value'     => false,
				'class'     => false,
				'onclick'   => false,
				'disabled'  => false,
				'required'  => false,
				'autofocus' => false,
				'style'     => false,
				'readonly'  => false,
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
		 * Checkbox - see trait selectTrait
		 *
		 * @param array $options
		 *
		 * @return bool
		 */
		public function checkbox($options = [])
		{

			$this->formBodyHTML .= $this->checkboxTrait($this->parseOptions($options, [
				'name'      => false,
				'checked'   => false,
				'class'     => false,
				'onclick'   => false,
				'disabled'  => false,
				'required'  => false,
				'autofocus' => false,
				'style'     => false,
				'readonly'  => false,
				'append' => '',
				'prepend' => ''
			]));

			return true;
		}

		/**
		 * Input - see trait inputTrait
		 *
		 * @param array $options
		 *
		 * @return bool
		 */
		public function input($options = [])
		{

			$this->formBodyHTML .= $this->inputTrait($this->parseOptions($options, [
				'name'       => false,
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
		 * Form Render
		 * Call the function to render the form created by this class
		 *
		 * @return string
		 */
		public function render()
		{

			// Return all the generated html
			return $this->formStartHTML . $this->formBodyHTML . $this->formEndHTML;
		}

	}
