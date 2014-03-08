<?php

	class HC_Encryption_Test extends PHPUnit_Framework_TestCase {

		// @todo: Complete Encryption Class Test

		public function testEncryption()
		{

			$this->assertEquals(class_exists('HC_Encryption'), true);
		}

		/**
		 * @depends testEncryption
		 */
		public function testEncryptionCreation()
		{

			$this->assertNotEmpty(new HC_Encryption());
		}

		/**
		 * @depends testEncryptionCreation
		 */
		public function testEncryptionMatch()
		{

			$encryption = new HC_Encryption();
			$hash1      = $encryption->hash('VALUE', false, 'SALT');
			$hash2      = $encryption->hash('VALUE', false, 'SALT');
			$this->assertEquals($hash1, $hash2, 'Encryption hash did not match');

		}

		/**
		 * @depends testEncryptionMatch
		 */
		public function testEncryptionMethods()
		{

			$encryption = new HC_Encryption();
			foreach ($encryption->getAvailableMethods() as $algo) {
				$encryption = new HC_Encryption($algo);
				$value      = uniqid();
				$salt       = uniqid();
				$hash1      = $encryption->hash($value, false, $salt);
				$hash2      = $encryption->hash($value, false, $salt);
				$this->assertEquals($hash1, $hash2, 'Encryption hash did not match');
				$this->assertEquals($encryption->getMethod(), $algo);
			}

		}

		/**
		 * @depends testEncryptionMethods
		 */
		public function testEncryptionFile()
		{

			$encryption = new HC_Encryption();

			$file = file_put_contents('file.txt', uniqid());
			$this->assertTrue(($file !== false), 'Could not create test file');

			if ($file !== false) {
				$hash1 = $encryption->hashFile('file.txt');
				$hash2 = $encryption->hashFile('file.txt');
				$this->assertEquals($hash1, $hash2, 'Encryption hash (file) did not match');
			}
		}

		/**
		 * @depends testEncryptionFile
		 */
		public function testEncryptionIncremental()
		{

			$encryption = new HC_Encryption();
			$encryption->initIncrementalHash();

			$uniqueValues = [
				uniqid(),
				uniqid(),
				uniqid()
			];
			foreach ($uniqueValues as $uniqueValue) {
				$encryption->incrementHash($uniqueValue);
			}
			$hash1 = $encryption->getIncrementalHash();

			$encryption->initIncrementalHash();
			foreach ($uniqueValues as $uniqueValue) {
				$encryption->incrementHash($uniqueValue);
			}
			$hash2 = $encryption->getIncrementalHash();

			$this->assertEquals($hash1, $hash2, 'Encryption hash (incremental) did not match');
		}

		/**
		 * @depends testEncryptionIncremental
		 */
		public function testEncryptionIncrementalFile()
		{

			$encryption = new HC_Encryption();

			$file = file_put_contents('file1.txt', uniqid());
			$this->assertTrue(($file !== false), 'Could not create test file 1');

			$file2 = file_put_contents('file2.txt', uniqid());
			$this->assertTrue(($file2 !== false), 'Could not create test file 2');

			if (($file !== false) && ($file2 !== false)) {
				$encryption->initIncrementalHash();
				$encryption->incrementHashFile('file1.txt');
				$encryption->incrementHashFile('file2.txt');
				$hash1 = $encryption->getIncrementalHash();

				$encryption->initIncrementalHash();
				$encryption->incrementHashFile('file1.txt');
				$encryption->incrementHashFile('file2.txt');
				$hash2 = $encryption->getIncrementalHash();
				$this->assertEquals($hash1, $hash2, 'Encryption hash (incremental file) did not match');
			}
		}
	}