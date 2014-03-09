<?php

	/**
	 * Class DB Test
	 */
	class HC_DB_Test extends PHPUnit_Framework_TestCase {

		//@todo: Complete HC_DB_Test
		private $connection;

		public function testDB()
		{

			$this->assertEquals(class_exists('HC_DB'), true);
		}

		/**
		 * @depends testDB
		 */
		public function testDBCreation()
		{

			$this->connection = new HC_DB();
			$this->assertNotEmpty($this->connection);
		}

		/**
		 * @depends testDBCreation
		 */
		public function testDBCreateTable()
		{

			$this->connection  = new HC_DB();
			$createPermissions = 'CREATE TABLE IF NOT EXISTS `permissions` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(255) NOT NULL,
                        `userID` int(15) NOT NULL,
                        PRIMARY KEY (`id`)
                      ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';

			$createUsers = 'CREATE TABLE IF NOT EXISTS `users` (
                  `id` int(20) NOT NULL AUTO_INCREMENT,
                  `firstName` varchar(255) NOT NULL,
                  `lastName` varchar(255) NOT NULL,
                  `email` varchar(255) NOT NULL,
                  `password` varchar(255) DEFAULT NULL,
                  `level` varchar(255) DEFAULT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';

			$createTest = 'CREATE TABLE IF NOT EXISTS `test` (
                  `id` int(20) NOT NULL AUTO_INCREMENT,
                  `name` varchar(255) NOT NULL,
                  `value` varchar(255) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';

            $createFood = 'CREATE TABLE `food` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `FHRSID` int(11) DEFAULT NULL,
  `LocalAuthorityBusinessID` int(11) DEFAULT NULL,
  `BusinessName` varchar(150) DEFAULT NULL,
  `BusinessType` varchar(150) DEFAULT NULL,
  `BusinessTypeID` int(11) DEFAULT NULL,
  `AddressLine2` varchar(150) DEFAULT NULL,
  `AddressLine3` varchar(150) DEFAULT NULL,
  `PostCode` varchar(10) DEFAULT NULL,
  `RatingValue` int(11) DEFAULT NULL,
  `RatingKey` varchar(20) DEFAULT NULL,
  `RatingDate` date DEFAULT NULL,
  `LocalAuthorityCode` int(11) DEFAULT NULL,
  `LocalAuthorityName` varchar(50) DEFAULT NULL,
  `LocalAuthorityWebSite` varchar(255) DEFAULT NULL,
  `LocalAuthorityEmailAddress` varchar(255) DEFAULT NULL,
  `Hygiene` int(11) DEFAULT NULL,
  `Structural` int(11) DEFAULT NULL,
  `ConfidenceInManagement` int(11) DEFAULT NULL,
  `SchemeType` varchar(10) DEFAULT NULL,
  `Longitude` float DEFAULT NULL,
  `Latitude` float DEFAULT NULL,
  `AddressLine1` varchar(150) DEFAULT NULL,
  `AddressLine4` varchar(150) DEFAULT NULL,
  `available` int(11) DEFAULT NULL,
  `open` int(11) DEFAULT NULL,
  `close` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;';

			$this->assertTrue($this->connection->query($createPermissions), 'Could not create permissions table.');
			$this->assertTrue($this->connection->query($createUsers), 'Could not create users table.');
			$this->assertTrue($this->connection->query($createTest), 'Could not create test table.');
			$this->assertTrue($this->connection->query($createFood), 'Could not create food table.');
		}

		/**
		 * @depends testDBCreateTable
		 */
		public function testDBInsert()
		{

			$this->connection = new HC_DB();
			$test1            = 'INSERT INTO test
                              (
                                name,
                                value
                              )
                              VALUES
                              (
                                \'flatName\',
                                \'flatValue\'
                              );';

			$this->assertTrue($this->connection->query($test1), 'Could not insert flat values.');

			$test2 = 'INSERT INTO test
                              (
                                name,
                                value
                              )
                              VALUES
                              (
                                ?,
                                ?
                              );';

			$this->assertTrue($this->connection->query($test2, [
				'unNamedName',
				'unNamedValue'
			]), 'Could not insert unnamed values.');

			$test3 = 'INSERT INTO test
                              (
                                name,
                                value
                              )
                              VALUES
                              (
                                :namedName,
                                :namedValue
                              );';

			$this->assertTrue($this->connection->query($test3, [
				':namedName'  => 'namedName',
				':namedValue' => 'namedValue'
			]), 'Could not insert named values.');
		}

		/**
		 * @depends testDBInsert
		 */
		public function testDBSelect()
		{

			$this->connection = new HC_DB();
			$test1            = 'SELECT * FROM test;';

			$this->assertNotEmpty($this->connection->query($test1), 'Could not "SELECT * FROM test".');

			$test2 = 'SELECT * FROM test WHERE name = \'flatName\'';

			$this->assertNotEmpty($this->connection->query($test2), 'Could not select flat values.');

			$test3 = 'SELECT * FROM test WHERE name = ? AND value = ?';

			$this->assertNotEmpty($this->connection->query($test3, [
				'unNamedName',
				'unNamedValue'
			]), 'Could not select unnamed values.');

			$test3 = 'SELECT * FROM test WHERE name = :namedName AND value = :namedValue';

			$this->assertNotEmpty($this->connection->query($test3, [
				':namedName'  => 'namedName',
				':namedValue' => 'namedValue'
			]), 'Could not select named values.');
		}
	}