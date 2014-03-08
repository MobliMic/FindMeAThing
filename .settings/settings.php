<?php

	/**
	 * Settings arrays
	 */

	// Define Configuration Options

	$settings = [];

	/**
	 *  Constants
	 */

	$settings['constants'] = [
		'SITE_DOMAIN' => 'local.hydracore.io',
		'SITE_NAME'   => 'HydraCore',
		'ENVIRONMENT' => 'DEV',
		'PROTOCOL'    => 'https',
		'AUTHOR'      => 'Ryan Howell'
	];

	/**
	 * Database
	 */

	$settings['database'] = [
		'engine'       => 'mysql',
		'host'         => 'local.hydracore.io',
		'username'     => 'root',
		'password'     => 'rnebcmzemvbn',
		'databasename' => 'HydraCore'
	];

	/**
	 * Users
	 */

	$settings['users'] = ['salt' => 'h65be9/}Cv~\'L#d`M*3_e.;P;V{X`,ZrMv2.p?7UfLqt,>Dg~?R`#sj=E*U72.ywap]/K?\']4"ssF*sFn*(JU~`GxenQMN!yG"_7@2)+Pj/r]_]7V>\'8u[\'3DynFL)xfF'];

	/**
	 * Compilation
	 */

	$settings['compilation'] = [
		'languages' => [
			'js'   => true,
			'sass' => true,
			'less' => true,
			'dart' => true
		],
		'path'      => '/resources/'
	];

	/**
	 * Email
	 */

	$settings['email'] = [
		'mailSystem'   => 'default',
		// MailGun - SendGrid - default
		'sendGridUser' => false,
		'sendGridPass' => false,
		'emailType'    => 'html',
		'defaults'     => [
			'sentFromAddress' => 'moblimic@example.com',
			'sentFromName'    => 'HydraCore'
		]
	];

	/**
	 * Pages
	 */

	$settings['pages'] = [
		'forms'      => true,
		'list'       => true,
		'table'      => true,
		'cacheViews' => true
	];

	/**
	 * Directory
	 */

	$settings['directory'] = [];

	/**
	 * Encryption
	 */

	$settings['encryption'] = [];

	/**
	 * Error
	 */

	$settings['error'] = [];

	/**
	 * File
	 */

	$settings['file'] = [];

	/**
	 * URL
	 */

	$settings['url'] = [];

	/**
	 * Zip
	 */

	$settings['zip'] = [];

	/**
	 * DateTime
	 */

	$settings['datetime'] = [];

	/**
	 * Calendar
	 */

	$settings['calendar'] = [];

	/**
	 * APC
	 */

	$settings['apc'] = [];
