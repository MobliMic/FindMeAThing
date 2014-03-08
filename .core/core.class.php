<?php

	/**
	 * Class HC_Core
	 *
	 * This class pulls all the settings and creates the site object.
	 */
	class HC_Core {

		/**
		 * @var HC_Site|null
		 */
		private $site = null;

		// Construct the core based on settings
		/**
		 *
		 */
		public function __construct()
		{

			date_default_timezone_set('Europe/London');

			// Setup the core location based on where this file is
			if (!defined('HC_CORE_LOCATION')) {
				define('HC_CORE_LOCATION', dirname(__FILE__));
			}

			if (!defined('HC_SETTINGS_LOCATION')) {
				define('HC_SETTINGS_LOCATION', str_replace('.core', '.settings', HC_CORE_LOCATION));
			}

			// Set current release number
			if (!defined('HC_VERSION')) {
				define('HC_VERSION', '0.0.6');
			}

			// Include APC
			require_once(HC_CORE_LOCATION . '/modules/data/apc.class.php');

			$apc = new HC_APC(['ttl' => 86400]);

			if ($apc->getTTL() !== -1) {
				$settings = $apc->select('HC_SITE_SETTINGS');
				if ($settings === null) {
					// Include the settings psge
					require_once(HC_SETTINGS_LOCATION . '/settings.php');
					$apc->insert('HC_SITE_SETTINGS', $settings, 86400);
					$this->checkVersion();
				}
				unset($apc);
			} else {
				// Include the settings psge
				require_once(HC_SETTINGS_LOCATION . '/settings.php');
				$this->checkVersion();
			}

			// If settings are defined
			if (isset($settings)) {
				// If not alraedy sent, send the version header
				if (!headers_sent()) {
					@header('X-Powered-By: HydraCore ' . HC_VERSION);
				}

				// Create Site using settings defined
				require_once(HC_CORE_LOCATION . '/modules/data/site.class.php');
				$this->site = new HC_Site($settings);

				return true;
			}

			return false;
		}

		/**
		 *  checkVersion
		 *
		 *  This function will check the current php version, if it is not supported it will exit with 1 and display an error
		 */
		private function checkVersion()
		{

			// Check what version of PHP we are using
			if (version_compare(PHP_VERSION, '5.4', '<')) {
				// @todo: throw exception from error class
				echo 'HydraCore (' . HC_VERSION . ') requires at least PHP 5.4, you are using: ' . PHP_VERSION . PHP_EOL;
				// Exit using an error status
				exit(1);
			}
		}

		/**
		 * @return HC_Site|null
		 */
		public function getSite()
		{

			// Return the site object
			return $this->site;
		}

		/**
		 * @param $site
		 */
		public function setSite($site)
		{

			// Set the site of the core to a new site
			$this->site = $site;
		}

		/**
		 * parseOptions
		 *
		 * This function parses options making sure that each option needed has a defaultValue
		 *
		 * @param array $options
		 * @param array $defaultValue
		 */
		protected function parseOptions(&$options, $defaultValues)
		{

			return array_merge($defaultValues, $options);
		}
	}

	/**
	 *
	 */
	function HC_INIT()
	{

		// Create the core object
		$GLOBALS['HC_CORE'] = new HC_CORE();
	}

	HC_INIT();