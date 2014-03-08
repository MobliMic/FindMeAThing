<?php

	/**
	 * Class HC_CheckBoxTrait
	 */
	trait HC_CheckBoxTrait {

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
		 * @param disabled => (true, false)   [false]     (Specifies that a input should be disabled)
		 *
		 * @return string
		 */
		private function checkboxTrait($options = [])
		{

			// Draw the start of the checkbox
			$tempHTML = $options['prepend'] . '<input type="checkbox"';
			// Allow disabling the button
			if ($options['disabled'] === true) {
				$tempHTML .= ' disabled="disabled"';
			}
			// Allow setting the autofocus
			if ($options['autofocus'] === true) {
				$tempHTML .= ' autofocus="autofocus"';
			}
			// Allow setting the style
			if (is_string($options['style'])) {
				$tempHTML .= ' style="' . $this->escapeTrait($options['style']) . '"';
			}
			// Allow setting the checked
			if ($options['checked'] === true) {
				$tempHTML .= ' checked="checked"';
			}
			// Allow setting the required
			if ($options['required'] === true) {
				$tempHTML .= ' required="required"';
			}

			// Allow setting the class
			if (is_string($options['class'])) {
				$tempHTML .= ' class="' . $this->escapeTrait($options['class']) . '"';
			}
			// Allow setting the on click event
			if (is_string($options['onclick'])) {
				$tempHTML .= ' onclick="' . $this->escapeTrait($options['onclick']) . '"';
			}
			// Allow setting the name
			if (is_string($options['name'])) {
				$tempHTML .= ' name="' . $this->escapeTrait($options['name']) . '" id="' . $this->escapeTrait($options['name']) . '"';
			}

			// Handle the html
			return $tempHTML .= '>' . $options['append'];
		}
	}
