<?php

	/**
	 * Class HC_Email
	 *
	 * @MobliMic: This is way from being finished yet
	 *
	 * @todo    : Complete Email Class
	 * @todo    : Add mail gun support
	 * @todo    : Make all one function and define send type by setting (maybe have a single function and separate functions if wanting to use multiple methods of email?)
	 */
	class HC_Email extends HC_Core {

		/**
		 * @var
		 */
		private $settings;

		/**
		 *
		 */
		public function __construct()
		{

			$this->settings = $GLOBALS['HC_CORE']->getSite()->getSettings();

			return true;
		}

		/**
		 * phpMail
		 *
		 * Uses PHP mail() function to send mail
		 *
		 * @description:
		 *             Sending mass mail? I would suggest using a service like SendGrid or MailGun
		 *
		 * @param $to
		 * @param $subject
		 * @param $message
		 * @param $headers
		 */

		public function phpMail($to, $subject, $message, $additional)
		{

			// @todo: finish this off properly

			$emailType = $this->settings['email']['emailType'];

			if ($emailType == 'html') {
				// Set proper headers
			}

			// @todo: Make this work
			$headers    = $additional['headers'];
			$parameters = $additional['parameters'];

			if (filter_var($to, FILTER_VALIDATE_EMAIL) == false) {

				// @todo: Return a custom error if fails with error.class.php
				return false; // Fail email send because not a vail email

			} else {

				$mail = mail($to, $subject, $message, $headers, $parameters);

				if ($mail == true) {
					return true;
				} else {
					// @todo: Return a custom error if fails with error.class.php
					return false;
				}

			}

		}

		/**
		 * SendGrid Mail Function
		 *
		 * @description:
		 *             Uses SendGrid to send emails
		 *
		 * @param $to
		 * @param $subject
		 * @param $message
		 * @param $additional // Include things like files etc
		 *
		 * @return bool
		 */

		public function sendGridMail($to, $subject, $message, $additional)
		{

			if (isset($this->settings)) {

				$mailReq = curl_init();

				curl_setopt_array($mailReq, [
					CURLOPT_RETURNTRANSFER => 1,
					CURLOPT_URL            => 'https://api.sendgrid.com/api/mail.send.json',
					CURLOPT_USERAGENT      => 'HydraCore',
					CURLOPT_POST           => 1,
					CURLOPT_POSTFIELDS     => [
						'api_user' => $this->settings['email']['sendGridUser'],
						'api_key'  => $this->settings['email']['sendGridPass'],
						'subject'  => $subject,
						'html'     => $message,
						'to'       => $to,
						'toname'   => $additional['toName'],
						'from'     => $this->settings['email']['defaults']['sentFromAddress'],
						'fromname' => $this->settings['email']['defaults']['sentFromName']
						// 'files'    => $additional['files'] // This isn't right atm
					]
				]);

				$mailResp = curl_exec($mailReq);

				curl_close($mailReq);

				return $mailResp;
			} else {
				// Throw Custom error
				return 0;
			}

		}

		/**
		 * @return bool
		 */
		public function mailGunMail()
		{

			// @todo: learn MailGuns API!

			return true;
		}

	}
