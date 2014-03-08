<?php

	/**
	 * Class HC_Page
	 */
	class HC_Page extends HC_Core {

		// Setup class public variables
		/**
		 * @var string
		 */
		public $body = '';

		// Setup class private variables
		/**
		 * @var array
		 */
		private $settings = [];

		/**
		 * @var bool|mixed
		 */
		private $viewsLocation = false;

		// Setup public functions
		/**
		 * @param array $settings
		 */
		public function __construct(&$settings = [])
		{

			// Check for caching
			if (!isset($settings['cacheViews'])) {
				$tempSettings           = $GLOBALS['HC_CORE']->getSite()->getSettings();
				$settings['cacheViews'] = false;
				if (isset($tempSettings['apc'])) {
					if ($tempSettings['apc'] !== false) {
						// Caching is enabled, check if we are caching views
						if ($tempSettings['pages']['cacheViews'] === true) {
							$settings['cacheViews'] = true;
						}
					}
					unset($tempSettings);
				}
			} else {
				if ($settings['cacheViews'] === true) {
					$tempSettings = $GLOBALS['HC_CORE']->getSite()->getSettings();
					if ($tempSettings['apc'] !== true) {
						$settings['cacheViews'] = false;
					}
				}
			}
			if ($settings['cacheViews'] == true) {
				$settings['apc'] = new HC_APC();
			}
			if (isset($settings['authentication'])) {
				if ($settings['authentication'] == true) {
					HC_User::startSession();
					if (!isset($_SESSION['user'])) {
						header('Location: ' . PROTOCOL . '://' . SITE_DOMAIN);
						exit();
					}
				}
			}
			$this->settings      = $settings;
			$this->viewsLocation = str_replace('.core', '.views', HC_CORE_LOCATION);

			return true;
		}

		/**
		 * @return bool
		 */
		public function render()
		{

			if (isset($this->settings['views'])) {
				// If defined, render footer
				foreach ($this->settings['views'] as $row => $value) {
					if ($value == true) {
						if ($row == 'body') {
							echo $this->body;
						} else {
							// Render default view that was defined
							echo $this->getView($row, $value);
						}
					} else if (is_array($value)) {
						// Render view with defined settings
						echo $this->getView($row, $value);
					}
				}

				return true;
			}

			return false;
		}

		/**
		 * @param $viewName
		 * @param $viewSettings
		 *
		 * @return bool
		 */
		private function getView(&$viewName, $viewSettings)
		{

			if (is_string($this->viewsLocation)) {
				$fileName = $this->viewsLocation . '/' . $viewName . '.php';
				if (isset($viewSettings['cache'])) {
					if ($viewSettings['cache'] === true) {
						if ($this->settings['cacheViews'] === true) {
							$apcKey = 'HC_VIEWS_APC_' . md5($fileName . json_encode($viewSettings));
							if ($this->settings['apc']->exists($apcKey)) {
								// We have a value
								echo $this->settings['apc']->select($apcKey);

								return true;
							} else {
								if (is_file($fileName)) {
									ob_start();
									include($fileName);
									$contents = ob_get_contents();
									ob_end_clean();
									// Store the value for later
									$this->settings['apc']->insert($apcKey, $contents);
									echo $contents;

									return true;
								}
							}
						} else {
							// If view exists
							if (is_file($fileName)) {
								include($fileName);

								return true;
							}
						}
					} else {
						// If view exists
						if (is_file($fileName)) {
							include($fileName);

							return true;
						}
					}
				} else {
					if ($this->settings['cacheViews'] === true) {
						$apcKey = 'HC_VIEWS_APC_' . preg_replace("/[^a-zA-Z0-9]+/", "", $fileName);
						if ($this->settings['apc']->exists($apcKey)) {
							// We have a value
							echo $this->settings['apc']->select($apcKey);

							return true;
						} else {
							if (is_file($fileName)) {
								ob_start();
								include($fileName);
								$contents = ob_get_contents();
								ob_end_clean();
								// Store the value for later
								$this->settings['apc']->insert($apcKey, $contents);
								echo $contents;

								return true;
							}
						}
					} else {
						// If view exists
						if (is_file($fileName)) {
							include($fileName);

							return true;
						}
					}
				}
			}

			return false;
		}

		/**
		 * @param $view
		 *
		 * @return bool
		 */
		public function renderView($view)
		{

			if (isset($this->settings['views'][$view])) {
				// Render header
				$this->getView($view, $this->settings['views'][$view]);

				return true;
			}

			return false;
		}

		/**
		 * @return bool
		 */
		public function startBuffer()
		{

			// If headers have not been sent
			if (!headers_sent()) {
				// Try override the time limit
				@set_time_limit(0);
				// Clean the buffer
				ob_end_clean();
				// Close the connection
				@header("Connection: close");
				// Ignore client aborting request
				ignore_user_abort(true);
				// Start the object
				ob_start();

				return true;
			}

			return false;
		}

		// Setup private functions

		/**
		 * @return bool
		 */
		public function endBuffer()
		{

			// Get the length of our buffered content
			$size = ob_get_length();

			// If we have content from the buffer
			if ($size !== false) {

				// If headers have not been sent
				if (!headers_sent()) {
					// Send the content length header with the buffer size
					@header('Content-Length: ' . $size);

					// Flush the buffer
					ob_end_flush();
					flush();
					session_write_close();

					return true;
				}
			}

			return false;
		}
	}