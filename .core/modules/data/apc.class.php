<?php

	/**
	 * Class HC_APC
	 */
	class HC_APC extends HC_Core {

		/**
		 * @var array
		 */
		private $options = [];

		/**
		 * @var bool
		 */
		private $isAPC = false;

		// Constructor
		/**
		 * @param array $options
		 */
		public function __construct($options = [])
		{

			// Get the settings
			if ($options === []) {
				$options = $GLOBALS['HC_CORE']->getSite()->getSettings();
				if (isset($options['apc'])) {
					if (is_array($options['apc'])) {
						$this->options = $options['apc'];
						$this->options = $this->parseOptions($this->options, ['ttl' => 3600]);
					} else {
						$this->options = ['ttl' => 3600];
					}
				} else {
					$this->options = ['ttl' => 3600];
				}
			} else {
				$this->options = $this->parseOptions($options, ['ttl' => 3600]);
			}
			$this->isAPC = extension_loaded('apc');
			if ($this->isAPC !== true) {
				if (!isset($GLOBALS['HC_APC_BACKUP_VALUES'])) {
					$GLOBALS['HC_APC_BACKUP_VALUES'] = [];
				}
				$this->options['ttl'] = -1;
			}
		}

		/**
		 * @param $key
		 *
		 * @return mixed|null
		 */
		public function select($key)
		{

			return $this->selectKey($key);
		}

		/**
		 * @param $key
		 *
		 * @return bool|string[]
		 */
		public function exists($key)
		{

			return $this->keyExists($key);
		}

		/**
		 * @return bool
		 */
		public function deleteAll()
		{

			if ($this->isAPC) {
				return ((apc_clear_cache() === true) && (apc_clear_cache('user') === true)) ? true : false;
			} else {
				$GLOBALS['HC_APC_BACKUP_VALUES'] = [];
			}

			return true;
		}

		/**
		 * @return mixed
		 */
		public function getTTL()
		{

			return $this->options['ttl'];
		}

		/**
		 * @param $key
		 *
		 * @return bool|string[]
		 */
		public function delete($key)
		{

			return $this->deleteKey($key);
		}

		/**
		 * @param $key
		 *
		 * @return mixed|null
		 */
		private function selectKey($key)
		{

			// Check if we have apc
			if ($this->isAPC) {
				$result = false;
				$value  = apc_fetch($key, $result);

				return ($result) ? $value : null;
			} else {
				return (isset($GLOBALS['HC_APC_BACKUP_VALUES'][$key])) ? $GLOBALS['HC_APC_BACKUP_VALUES'][$key][0] : null;
			}
		}

		/**
		 * @param      $key
		 * @param      $value
		 * @param bool $overrideTTL
		 *
		 * @return bool|mixed|null
		 */
		public function selectInsert($key, $value, $overrideTTL = false)
		{

			// Check if the key exists
			if ($this->keyExists($key)) {
				// Key exists
				return $this->selectKey($key);
			} else {
				// Key does not exist, insert it
				if ($this->insert($key, $value, $overrideTTL)) {
					return $value;
				}
			}

			return false;
		}

		/**
		 * @param $key
		 *
		 * @return bool|string[]
		 */
		private function keyExists($key)
		{

			return ($this->isAPC) ? apc_exists($key) : isset($GLOBALS['HC_APC_BACKUP_VALUES'][$key]);
		}

		/**
		 * @param      $key
		 * @param      $value
		 * @param bool $overrideTTL
		 *
		 * @return array|bool
		 */
		public function insert($key, $value, $overrideTTL = false)
		{

			return ($overrideTTL !== false) ? $this->insertKey($key, $value, $overrideTTL) : $this->insertKey($key, $value, $this->options['ttl']);
		}

		/**
		 * @param $key
		 * @param $value
		 * @param $ttl
		 *
		 * @return array|bool
		 */
		private function insertKey($key, $value, $ttl)
		{

			// Check if we have apc
			if ($this->isAPC) {
				return apc_store($key, $value, $ttl);
			} else {
				$GLOBALS['HC_APC_BACKUP_VALUES'][$key] = [
					$value,
					$ttl
				];

				return true;
			}
		}

		/**
		 * @param $key
		 *
		 * @return bool|string[]
		 */
		private function deleteKey($key)
		{

			if ($this->keyExists($key)) {
				if ($this->isAPC) {
					return apc_delete($key);
				} else {
					unset($GLOBALS['HC_APC_BACKUP_VALUES'][$key]);

					return true;
				}
			}

			return false;
		}
	}