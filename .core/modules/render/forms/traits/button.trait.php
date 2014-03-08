<?php

	/**
	 * Class HC_ButtonTrait
	 */
	trait HC_ButtonTrait {
		
		/**
		 * Button Constructor
		 * Call the function to generate a button, pass through options to customize.
		 *
		 * @param type => ('button', 'submit', 'reset')    ['button']      (Specifies the type of the button)
		 * @param name => (true, false)                     [false]         (Specifies a name and id for the button)
		 * @param value => (true, false)                     [ucfirst(type)] (Specifies an initial value for the button)
		 * @param class => (true, false)                     [false]         (Specifies the class of the button)
		 * @param onclick => (true, false)                     [false]         (Specifies the onClick of the button)
		 * @param autofocus => (true, false)                     [false]         (Specifies that a button should automatically get focus when the page loads)
		 * @param disabled => (true, false)                     [false]         (Specifies that a button should be disabled)
		 *
		 * @return string
		 */
		private function buttonTrait($options = [])
		{

			// Draw the start of the button
			$tempHTML = $options['prepend'] . '<button type="' . $this->escapeTrait($options['type']) . '"';
			// Allow disabling the button
			if ($options['disabled'] === true) {
				$tempHTML .= ' disabled="disabled"';
			}
			// Allow setting the autofocus
			if ($options['autofocus'] === true) {
				$tempHTML .= ' autofocus="autofocus"';
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
			// Force setting the value
			if ($options['value'] === false) {
				$options['value'] = ucfirst($options['type']);
			}

			$options['name'] = $this->escapeTrait($options['value']);

			// Handle the html
			return $tempHTML .= '>' . $options['value'] . '</button>' . $options['append'];
		}
	}
