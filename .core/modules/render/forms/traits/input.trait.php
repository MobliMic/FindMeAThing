<?php

	/**
	 * Class HC_InputTrait
	 */
	trait HC_InputTrait {

		/**
		 * Input Constructor
		 * Call the function to generate a input, pass through options to customize.
		 *
		 * @param createElement => (true, false)        [true]          (Specifies whether to generate the element as part of the form, or return the html)
		 * @param type => (text, password)            [text]         (Specifies that the input field type)
		 * @param required => (true, false)            [false]         (Specifies that an input field must be filled out before submitting the form)
		 * @param name => (true, false)        [false]         (Specifies a name and id for the input)
		 * @param value => (true, false)        [ucfirst(type)] (Specifies an initial value for the input)
		 * @param class => (true, false)        [false]         (Specifies the class of the input)
		 * @param onclick => (true, false)        [false]         (Specifies the onClick of the input)
		 * @param autofocus => (true, false)        [false]         (Specifies that a input should automatically get focus when the page loads)
		 * @param disabled => (true, false)        [false]         (Specifies that a input should be disabled)
		 * @param readonly => (true, false)       [false]         (Specifies that an input field is read-only)
		 * @param maxlength => (0-999, false)      [false]         (Specifies the maximum number of characters allowed in an <input> element)
		 * @param pattern => (regexp, false)     [false]         (Specifies a regular expression that an <input> element's value is checked against)
		 * @param spellcheck => (true, false)       [false]         (Specifies whether the element is to have its spelling and grammar checked or not)
		 *
		 * @return string
		 */
		private function inputTrait($options = [])
		{

			// Draw the start of the input
			$tempHTML = $options['prepend'] . '<input type="' . $this->escapeTrait($options['type']) . '"';
			// Allow disabling the button
			if ($options['disabled'] === true) {
				$tempHTML .= ' disabled="disabled"';
			}
			// Allow setting the style
			if (is_string($options['style'])) {
				$tempHTML .= ' style="' . $this->escapeTrait($options['style']) . '"';
			}
			// Allow setting the autofocus
			if ($options['autofocus'] === true) {
				$tempHTML .= ' autofocus="autofocus"';
			}
			// Allow setting the required
			if ($options['required'] === true) {
				$tempHTML .= ' required="required"';
			}
			// Allow setting the readonly
			if ($options['readonly'] === true) {
				$tempHTML .= ' readonly="readonly"';
			}
			// Allow setting the class
			if (is_string($options['class'])) {
				$tempHTML .= ' class="' . $this->escapeTrait($options['class']) . '"';
			}
			// Allow setting the on click event
			if (is_string($options['onclick'])) {
				$tempHTML .= ' onclick="' . $this->escapeTrait($options['onclick']) . '"';
			}
			// Allow setting the maxlength
			if (is_integer($options['maxlength'])) {
				$tempHTML .= ' maxlength="' . $this->escapeTrait($options['maxlength']) . '"';
			}
			// Allow setting the pattern
			if (is_string($options['pattern'])) {
				$tempHTML .= ' pattern="' . $this->escapeTrait($options['pattern']) . '"';
			}
			// Allow setting the spellcheck
			if (is_string($options['spellcheck'])) {
				$tempHTML .= ' spellcheck="true"';
			}
			// Allow setting the name
			if (is_string($options['name'])) {
				$options['name'] = $this->escapeTrait($options['name']);
				$tempHTML .= ' name="' . $options['name'] . '" id="' . $options['name'] . '"';
			}
			// Force setting the value
			if ($options['value'] === false) {
				$options['value'] = ucfirst($options['type']);
			}

			$options['value'] = $this->escapeTrait($options['value']);
			// Handle the html
			return $tempHTML .= ' value="' . $options['value'] . '">' . $options['append'];
		}
	}
