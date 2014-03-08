<?php

	/**
	 * Class HC_Encryption
	 */
	class HC_Encryption extends HC_Core {

		/**
		 * @var null
		 */
		private $method = null;

		/**
		 * @var null
		 */
		private $incrementalHash = null;

		// @todo: Complete Encryption Class
		/**
		 * @param null $method
		 */
		public function __construct($method = null)
		{

			if ($method !== null) {
				$this->method = & $method;

				return true;
			}

			// We need to figure out the best method
			$algos = hash_algos();

			// Desired algorithms in order of strength
			$desiredAlgos = [
				'sha512',
				'whirlpool',
				'sha384',
				'ripemd320',
				'sha256',
				'sha224',
				'sha1'
			];

			// Use the best one we can find, at least one should be
			foreach ($desiredAlgos as $algo) {
				if (in_array($algo, $algos)) {
					$this->method = & $algo;

					return true;
				}
			}

			return false;
		}

		/**
		 * @param null $value
		 * @param bool $advanced
		 * @param null $salt
		 *
		 * @return array|bool|string
		 */
		public function hash($value = null, $advanced = false, $salt = null)
		{

			// Make sure we have a method
			if ($this->method === null) {
				return false;
			}

			// Make sure we have a value
			if (!is_string($value)) {
				return false;
			}

			// If no salt is set, generate one
			if ($salt === null) {
				// Create salt
				$salt = uniqid('', $advanced);

				// Return hash and salt
				return [
					hash($this->method, $salt . $value . $salt),
					$salt
				];
			}

			// Return hash
			return hash($this->method, $salt . $value . $salt);
		}

		/**
		 * @param null $file
		 * @param bool $raw
		 *
		 * @return bool|string
		 */
		public function hashFile($file = null, $raw = false)
		{

			// Make sure we have a method
			if ($this->method === null) {
				return false;
			}

			if (is_file($file)) {
				return hash_file($this->method, $file, $raw);
			}

			return false;
		}

		/**
		 * @return bool
		 */
		public function initIncrementalHash()
		{

			// Make sure we have a method
			if ($this->method === null) {
				return false;
			}

			// Start the incremental hash
			$this->incrementalHash = hash_init($this->method);

			// If success, return true
			if ($this->incrementalHash) {
				return true;
			}

			return false;
		}

		/**
		 * @param null $value
		 *
		 * @return bool
		 */
		public function incrementHash($value = null)
		{

			// Make sure we have a method
			if ($this->method === null) {
				return false;
			}

			// Make sure we have a value
			if (!is_string($value)) {
				return false;
			}

			// If success
			if ($this->incrementalHash) {
				hash_update($this->incrementalHash, $value);

				return true;
			}

			return false;
		}

		/**
		 * @param null $file
		 *
		 * @return bool
		 */
		public function incrementHashFile($file = null)
		{

			// Make sure we have a method
			if ($this->method === null) {
				return false;
			}

			// Make sure we have a value
			if (!is_file($file)) {
				return false;
			}

			// If success
			if ($this->incrementalHash) {
				hash_update_file($this->incrementalHash, $file);

				return true;
			}

			return false;
		}

		/**
		 * @return bool|string
		 */
		public function getIncrementalHash()
		{

			// If we have a incremental hash
			if ($this->incrementalHash !== null) {
				return hash_final($this->incrementalHash);
			}

			return false;
		}

		/**
		 * @return bool|null
		 */
		public function getMethod()
		{

			if ($this->method !== null) {
				return $this->method;
			}

			return false;
		}

		/**
		 * @return array
		 */
		public function getAvailableMethods()
		{

			return hash_algos();
		}
	}