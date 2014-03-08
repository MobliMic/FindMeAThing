<?php

	/**
	 * Class HC_SelectTrait
	 */
	trait HC_SelectTrait {
		
		/**
		 * Select Constructor
		 * Call the function to generate a text input, pass through options to customize.
		 *
		 * @param required => (true, false)            [false]         (Specifies that an input field must be filled out before submitting the form)
		 * @param name => (true, false)        [false]         (Specifies a name and id for the input)
		 * @param values => (['name' => 'Name 1', 'value' => 'Value 1', 'disabled' => false, 'selected' => false]) (Specifies initial values for the select, use sub array to set grouping)
		 * @param class => (true, false)        [false]         (Specifies the class of the input)
		 * @param onclick => (true, false)        [false]         (Specifies the onClick of the input)
		 * @param autofocus => (true, false)        [false]         (Specifies that a input should automatically get focus when the page loads)
		 * @param disabled => (true, false)        [false]         (Specifies that a input should be disabled)
		 * @param readonly => (true, false)       [false]         (Specifies that an input field is read-only)
		 *
		 * @return string
		 */
		private function selectTrait($options = [])
		{

			// Draw the start of the input
			$tempHTML = $options['prepend'] . '<select ';
			// Allow disabling the button
			if ($options['disabled'] !== false) {
				$tempHTML .= ' disabled="disabled"';
			}
			// Allow setting the autofocus
			if ($options['autofocus'] !== false) {
				$tempHTML .= ' autofocus="autofocus"';
			}
			// Allow setting the required
			if ($options['required'] !== false) {
				$tempHTML .= ' required="required"';
			}
			// Allow setting the readonly
			if ($options['multiple'] !== false) {
				$tempHTML .= ' multiple="multiple"';
			}
			// Allow setting the class
			if (is_string($options['class'])) {
				$tempHTML .= ' class="' . $this->escapeTrait($options['class']) . '"';
			}
			// Allow setting the style
			if (is_string($options['style'])) {
				$tempHTML .= ' style="' . $this->escapeTrait($options['style']) . '"';
			}
			// Allow setting the on click event
			if (is_string($options['onclick'])) {
				$tempHTML .= ' onclick="' . $this->escapeTrait($options['onclick']) . '"';
			}
			// Allow setting the name
			if (is_string($options['name'])) {
				$options['name'] = $this->escapeTrait($options['name']);
				$tempHTML .= ' name="' . $options['name'] . '" id="' . $options['name'] . '"';
			}
			// Handle the html
			$tempHTML .= '>';

			// Deal with the associative array
			foreach ($options['values'] as $row => $value) {
				// If this is a group of values
				if (is_array($value['value'])) {
					// Start the group
					$tempHTML .= '<optgroup ';
					// Define the name if defined
					if (is_string($value['name'])) {
						$tempHTML .= ' label="' . $this->escapeTrait($value['name']) . '"';
					}
					// Disable if defined
					if ($value['disabled'] !== false) {
						$tempHTML .= ' disabled="disabled"';
					}
					// Close the start of the tag
					$tempHTML .= '>';
					// Loop through all the values
					foreach ($value['value'] as $row2 => $value2) {
						// Create each option
						$tempHTML .= '<option ';

						// Disable the element if defined
						if ($value2['disabled'] !== false) {
							$tempHTML .= ' disabled="disabled" ';
						}

						// Set the element as selected if defined
						if ($value2['selected'] !== false) {
							$tempHTML .= ' selected="selected" ';
						}

						$value2['value'] = $this->escapeTrait($value2['value']);

						// Set the value
						$tempHTML .= 'value="' . $value2['value'] . '" ';

						// Set name if defined else use the value as the name
						if (is_string($value2['name'])) {
							$tempHTML .= '>' . $this->escapeTrait($value2['name']) . '</option>';
						} else {
							$tempHTML .= '>' . $value2['value'] . '</option>';
						}
					}
					// Close the group
					$tempHTML .= '</optgroup> ';
				} else {
					// Create the otpion
					$tempHTML .= '<option ';

					// Disable the element if defined
					if ($value['disabled'] !== false) {
						$tempHTML .= ' disabled="disabled" ';
					}

					// Set the element as selected if defined
					if ($value['selected'] != false) {
						$tempHTML .= ' selected="selected" ';
					}

					$value['value'] = $this->escapeTrait($value['value']);

					// Set the value
					$tempHTML .= 'value="' . $value['value'] . '" ';

					// Set name if defined else use the value as the name, close the option
					if (is_string($value['name'])) {
						$tempHTML .= '>' . $this->escapeTrait($value['name']) . '</option>';
					} else {
						$tempHTML .= '>' . $value['value'] . '</option>';
					}
				}

			}

			return $tempHTML .= '</select>' . $options['append'];
		}
	}
