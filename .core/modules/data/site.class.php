<?php

	/**
	 * Class HC_Site
	 *
	 * This class defines the site object based on settings provided, loading other classes that are needed.
	 */
	class HC_Site extends HC_Core {

		// Setup class public variables

		// Setup class private variables
		/**
		 * @var array
		 */
		private $settings = [];

		/**
		 * @var null
		 */
		private $startTime = null;

		// Setup Constructor
		/**
		 * @param array $settings
		 */
		public function __construct(&$settings = [])
		{

			// If this is a dev environment
			if ($settings['constants']['ENVIRONMENT'] == 'DEV') {
				// Setup Page Timer
				$this->startTime = microtime();
				$this->startTime = explode(' ', $this->startTime);
				$this->startTime = $this->startTime[1] + $this->startTime[0];

				if (!function_exists('HC_CUSTOM_ERROR')) {
					// Be strict
					error_reporting(E_ALL);

					function HC_CUSTOM_ERROR($errno, $errstr, $errfile, $errline)
					{

						switch ($errno) {
							case E_USER_ERROR:
								echo 'HC_Fatal' . PHP_EOL;
								echo '[' . $errno . '] ' . $errstr . PHP_EOL . 'Fatal error on line ' . $errline . ' in ' . $errfile . ' file ' . PHP_EOL . 'HydraCore Version: ' . HC_VERSION . PHP_EOL . 'PHP Version: ' . PHP_VERSION . PHP_EOL . 'OS: ' . PHP_OS . PHP_EOL;
								exit(1);
								break;

							case E_USER_WARNING:
								echo 'HC_Warning' . PHP_EOL;
								echo '[' . $errno . '] ' . $errstr . PHP_EOL . 'Warning on line ' . $errline . ' in ' . $errfile . ' file ' . PHP_EOL . 'HydraCore Version: ' . HC_VERSION . PHP_EOL . 'PHP Version: ' . PHP_VERSION . PHP_EOL . 'OS: ' . PHP_OS . PHP_EOL;
								exit(1);
								break;

							case E_USER_NOTICE:
								echo 'HC_Notice' . PHP_EOL;
								echo '[' . $errno . '] ' . $errstr . PHP_EOL . 'Notice on line ' . $errline . ' in ' . $errfile . ' file ' . PHP_EOL . 'HydraCore Version: ' . HC_VERSION . PHP_EOL . 'PHP Version: ' . PHP_VERSION . PHP_EOL . 'OS: ' . PHP_OS . PHP_EOL;
								exit(1);
								break;

							default:
								echo 'HC_Error' . PHP_EOL;
								echo '[' . $errno . '] ' . $errstr . PHP_EOL . 'Unknown Error on line ' . $errline . ' in ' . $errfile . ' file ' . PHP_EOL . 'HydraCore Version: ' . HC_VERSION . PHP_EOL . 'PHP Version: ' . PHP_VERSION . PHP_EOL . 'OS: ' . PHP_OS . PHP_EOL;
								exit(1);
								break;
						}
					}

					$old_error_handler = set_error_handler('HC_CUSTOM_ERROR');
				}
			}

			$this->settings = $settings;

			if (!function_exists('HC_AUTOLOADER')) {
				// Register the autoloader
				function HC_AUTOLOADER($class)
				{

					switch ($class) {

						case 'HC_Page':
							require_once(HC_CORE_LOCATION . '/modules/data/page.class.php');
							break;

						case 'HC_Form':
							require_once(HC_CORE_LOCATION . '/modules/render/forms/form.class.php');
							break;

						case 'HC_Button':
							require_once(HC_CORE_LOCATION . '/modules/render/forms/button.class.php');
							break;

						case 'HC_Checkbox':
							require_once(HC_CORE_LOCATION . '/modules/render/forms/checkbox.class.php');
							break;

						case 'HC_Input':
							require_once(HC_CORE_LOCATION . '/modules/render/forms/input.class.php');
							break;

						case 'HC_Select':
							require_once(HC_CORE_LOCATION . '/modules/render/forms/select.class.php');
							break;

						case 'HC_List':
							require_once(HC_CORE_LOCATION . '/modules/render/views/list.class.php');
							break;

						case 'HC_Table':
							require_once(HC_CORE_LOCATION . '/modules/render/views/table.class.php');
							break;

						case 'HC_DB':
							require_once(HC_CORE_LOCATION . '/modules/data/db.class.php');
							break;

						case 'HC_User':
							require_once(HC_CORE_LOCATION . '/modules/data/user.class.php');
							break;

						case 'HC_Directory':
							require_once(HC_CORE_LOCATION . '/modules/data/directory.class.php');
							break;

						case 'HC_Email':
							require_once(HC_CORE_LOCATION . '/modules/data/email.class.php');
							break;

						case 'HC_Encryption':
							require_once(HC_CORE_LOCATION . '/modules/data/encryption.class.php');
							break;

						case 'HC_Error':
							require_once(HC_CORE_LOCATION . '/modules/data/error.class.php');
							break;

						case 'HC_File':
							require_once(HC_CORE_LOCATION . '/modules/data/file.class.php');
							break;

						case 'HC_URL':
							require_once(HC_CORE_LOCATION . '/modules/data/url.class.php');
							break;

						case 'HC_Zip':
							require_once(HC_CORE_LOCATION . '/modules/data/zip.class.php');
							break;

						case 'HC_DateTime':
							require_once(HC_CORE_LOCATION . '/modules/data/date-time/time.class.php');
							require_once(HC_CORE_LOCATION . '/modules/data/date-time/date.class.php');
							require_once(HC_CORE_LOCATION . '/modules/data/date-time/datetime.class.php');
							break;

						case 'HC_Time':
							require_once(HC_CORE_LOCATION . '/modules/data/date-time/time.class.php');
							break;

						case 'HC_Date':
							require_once(HC_CORE_LOCATION . '/modules/data/date-time/date.class.php');
							break;

						case 'HC_Calendar':
							require_once(HC_CORE_LOCATION . '/modules/render/calendar.class.php');
							break;
					}
				}

				spl_autoload_register('HC_AUTOLOADER');
			}

			// Setup Environment Constants
			foreach ($settings['constants'] as $row => $value) {
				// Define constant if not already defined
				if (!defined($row)) {
					define($row, $value);
				}
			}

			unset($settings);

			return true;
		}

		// Setup Public Functions
		/**
		 * @return array
		 */
		public function getSettings()
		{

			// Return the settings used to create the site object
			return $this->settings;
		}

		/**
		 * @return null
		 */
		public function getStartTime()
		{

			// Return the time the site was started
			return $this->startTime;
		}
	}
