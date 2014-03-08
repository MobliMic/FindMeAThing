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
		'SITE_DOMAIN' => 'prototype.theryanhowell.co.uk',
		'SITE_NAME'   => 'Find Me A Thing',
		'ENVIRONMENT' => 'DEV',
		'PROTOCOL'    => 'https',
		'AUTHOR'      => 'WeHasCode'
	];

	/**
	 * Database
	 */

	$settings['database'] = [
		'engine'       => 'mysql',
		'host'         => '',
		'username'     => '',
		'password'     => '',
		'databasename' => ''
	];

	/**
	 * Users
	 */

	$settings['users'] = ['salt' => 'h65be9/}asd~\'L#d`M*3_e.;P;V{X`,ZrMv2.p?7UfLqt,>Dg~?R`#sj=E*U7wap]/K?\']4"ssF6drhFn*(JU~`GxenQMN!yG"_7@2)+Pj/r]_]7V>\'8u[\'3DynFL)xfF'];

	/**
	 * Compilation
	 */

	$settings['compilation'] = [
		'languages' => [
			'js'   => true,
			'sass' => true,
			'less' => false,
			'dart' => false
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
