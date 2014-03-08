<?php
	require_once(HC_CORE_LOCATION . '/modules/data/db.class.php');
	// Start sessions
	if (session_status() != PHP_SESSION_ACTIVE) {
		if (!headers_sent()) {
			@session_start();
			// Set where we are saving sessions based on core location
			@session_save_path(str_replace('.core', '.sessions/', HC_CORE_LOCATION));
			// Forcing garbage collection
			@ini_set('session.gc_probability', 1);
		}
	}

	/**
	 * Class HC_User
	 */
	class HC_User extends HC_Core {

		// Setup class public variables

		// Setup class private variables
		/**
		 * @var null
		 */
		private $userID = null; // Don't change this, ever
		/**
		 * @var
		 */
		private $firstName;

		/**
		 * @var
		 */
		private $lastName;

		/**
		 * @var
		 */
		private $permissions;

		/**
		 * Constructor
		 *
		 * @param string $email
		 * @param string $password
		 */
		public function __construct($email = 'test@hydracore.io', $password = 'testPassword')
		{

			// Get user details
			$db    = new HC_DB();
			$query = $db->query('SELECT id, firstName, lastName, email, password FROM users WHERE email = \'' . $email . '\' AND password = \'' . $this->encryptPassword($password) . '\'');
			if ($query) {
				$result = $db->getAssociativeResult();
				if ($result) {
					if (isset($result[0])) {
						// Check that email matches
						if ($email == $result[0]['email']) {
							// Check if password matches
							if ($this->verifyPassword($password, $result[0]['password'])) {
								// Login the user setup sessions
								$this->startSession();
								$this->userID    = $result[0]['id'];
								$this->firstName = $result[0]['firstName'];
								$this->lastName  = $result[0]['lastName'];
								// Get permissions
								$query = $db->query('SELECT title FROM permissions WHERE itemID = "' . $this->userID . '"');
								if ($query) {
									$result2 = $db->getAssociativeResult();
									foreach ($result2 as $row => $value) {
										$this->permissions[] = $value['name'];
									}
								}
							} else {
								// Passwords did not match
								return false;
							}
						} else {
							// Email did not match
							return false;
						}
					} else {
						// No row
						return false;
					}
				} else {
					// No result
					return false;
				}
			} else {
				// No User Existed
				return false;
			}

			return true;
		}

		// Setup Public Functions
		/**
		 * @return mixed
		 */
		public function getPermissions()
		{

			return $this->permissions;
		}

		/**
		 * @param $permission
		 *
		 * @return bool
		 */
		public function hasPermission($permission)
		{

			return isset($this->permissions[$permission]);
		}

		/**
		 * @return null
		 */
		public function getUserID()
		{

			return $this->userID;
		}

		/**
		 * @return mixed
		 */
		public function getFirstName()
		{

			return $this->firstName;
		}

		/**
		 * @return mixed
		 */
		public function getLastName()
		{

			return $this->lastName;
		}

		// Setup Private Functions
		/**
		 *
		 */
		public static function endSession()
		{

			if (session_status() == PHP_SESSION_ACTIVE) {
				unset($_SESSION);
				session_destroy();
			}
		}

		/**
		 *
		 */
		public static function startSession()
		{

			if (session_status() != PHP_SESSION_ACTIVE) {
				session_start();
			}
		}

		/**
		 * @param $password
		 * @param $hash
		 *
		 * @return bool
		 */
		private function verifyPassword($password, $hash)
		{

			return ($this->encryptPassword($password) == $hash);
		}

		/**
		 * @param $password
		 *
		 * @return string
		 */
		private function encryptPassword($password)
		{

			$userSettings = $GLOBALS['HC_CORE']->getSite()->getSettings();
			$userSettings = $userSettings['users'];

			return hash('sha512', $password . $userSettings['salt']);
		}
	}
