<?php
	require_once(HC_CORE_LOCATION . '/modules/data/site.class.php');

	/**
	 * Class DB
	 */
	class HC_DB extends HC_Core {

		// Setup class public variables

		// Setup class private variables
		/**
		 * @var null
		 */
		private $connection = null;

		/**
		 * @var int
		 */
		private $defaultFetchType = PDO::FETCH_ASSOC;

		/**
		 * @var array
		 */
		private $settings = [];

		/**
		 * @var
		 */
		private $lastQuery;
		// Setup Public Functions

		/**
		 * Database Constructor
		 * This sets up the database connection, and selects the database
		 *
		 * @param options
		 */
		public function __construct($options = [])
		{

			// Get the settings
			if ($options === []) {
				$options = $GLOBALS['HC_CORE']->getSite()->getSettings();
				$options = $options['database'];
			}
			$this->settings = $options;
			if (!isset($this->settings['timeout'])) {
				$this->settings['timeout'] = 60;
			}
			$this->connect();

			return true;
		}

		/**
		 * @return bool
		 */
		public function connect()
		{

			if ($this->connection === null) {
				// If we have been told to use mysql
				if ($this->settings['engine'] == 'mysql') {
					// Check if we can use mysqli
					$drivers = PDO::getAvailableDrivers();
					if (in_array('mysqli', $drivers)) {
						$this->settings['engine'] = 'mysqli';
					}
				}
				// Create connection from settings defined
				$this->connection = new PDO($this->settings['engine'] . ':dbname=' . $this->settings['databasename'] . ';host=' . $this->settings['host'], $this->settings['username'], $this->settings['password']);
				$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->connection->setAttribute(PDO::ATTR_TIMEOUT, $this->settings['timeout']);
				$this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->defaultFetchType);

				return true;
			}

			return false;
		}

		/**
		 * @param      $sql
		 * @param null $values
		 * @param null $fetchType
		 *
		 * @return bool
		 * @throws Exception
		 */
		public function query($sql, $values = null, $fetchType = null)
		{

			// Get a connection if we don't have one
			if ($this->connection === null) {
				$this->connect();
			}

			// Check if we have values, or this is a direct query
			if ($values === null) {
				// Direct Query
				if (is_string($sql)) {
					$query = $this->connection->query($sql);
				} else {
					throw new Exception('SQL must be a string.');
				}
			} else {
				// Has values, prepare then execute
				$query   = $this->connection->prepare($sql);
				$success = $query->execute($values);
			}

			// If query returns a result then return data
			if ($query->columnCount() !== 0) {
				// Set the fetch type if defined
				if ($fetchType !== null) {
					$this->lastQuery = $query->fetchAll($fetchType);
				} else {
					$this->lastQuery = $query->fetchAll();
				}

				return $this->lastQuery;
			} else {
				if ($query) {
					$this->lastQuery = true;

					return true;
				} else {
					if (isset($success)) {
						$this->lastQuery = $success;

						return $success;
					} else {
						$this->lastQuery = false;

						return false;
					}
				}
			}

		}

		/**
		 * @param int $fetchType
		 *
		 * @return bool
		 */
		public function setDefaultFetchType($fetchType = PDO::FETCH_ASSOC)
		{

			$this->defaultFetchType = $fetchType;
			$this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->defaultFetchType);

			return true;
		}

		/**
		 * Database Destructor
		 * This closes the database connection, and unsets variables
		 */
		public function __destruct()
		{

			// Unset the connection
			$this->connection = null;
			unset($this->connection);
			// Unset the object
			unset($this);
		}

		/**
		 * @return array
		 */
		public function __sleep()
		{

			$keys = array_keys(get_object_vars($this));
			if (($key = array_search('connection', $keys)) !== false) {
				unset($keys[$key]);
			}

			return $keys;
		}

		/**
		 *
		 */
		public function __wakeup()
		{

			$this->connect();
		}
	}
