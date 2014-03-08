<?php
	if (!isset($skipCoreInclude)) {
		require_once('../.core/core.class.php');
	}

	// Make sure we have enough time to finish
	set_time_limit(0);
	ini_set('max_execution_time', 0);

	// Directory Iterator
	/**
	 * @param DirectoryIterator $dir
	 *
	 * @return array
	 */
	function fillArrayWithFileNodes(DirectoryIterator $dir)
	{

		// Directory array
		$data = [];
		// Loop through each directory as a node
		foreach ($dir as $node) {
			// If we are dealing with a directory and not a dot / dotdot
			if ($node->isDir() && !$node->isDot()) {
				// Recursively store each file
				$data[$node->getFilename()] = fillArrayWithFileNodes(new DirectoryIterator($node->getPathname()));
			} // If we are dealing with a file
			else if ($node->isFile()) {
				// Store the file in the array
				$data[] = $node->getFilename();
			}
		}

		return $data;
	}

	// Recursively move directory from one to another
	/**
	 * @param $src
	 * @param $dest
	 *
	 * @return bool
	 */
	function moveDirRecursively($src, $dest)
	{

		// If source is not a directory stop processing
		if (!is_dir($src))
			return false;

		// If the destination directory does not exist create it
		if (!is_dir($dest)) {
			if (!mkdir($dest)) {
				// If the destination directory could not be created stop processing
				return false;
			}
		}

		// Open the source directory to read in files
		$i = new DirectoryIterator($src);
		foreach ($i as $f) {
			// If this is a filke
			if ($f->isFile()) {
				// Just rename it
				rename($f->getRealPath(), "$dest/" . $f->getFilename());
			} else if (!$f->isDot() && $f->isDir()) {
				// This is a directory, move it recursively
				moveDirRecursively($f->getRealPath(), "$dest/$f");
				// Cleanup
				rmdir($f->getRealPath());
			}
		}
		// Cleanup
		unset($src);

		return true;
	}

	/**
	 * @param $src
	 * @param $dest
	 *
	 * @return bool
	 */
	function copyDirRecursively($src, $dest)
	{

		// If source is not a directory stop processing
		if (!is_dir($src))
			return false;

		// If the destination directory does not exist create it
		if (!is_dir($dest)) {
			if (!mkdir($dest)) {
				// If the destination directory could not be created stop processing
				return false;
			}
		}

		// Open the source directory to read in files
		$i = new DirectoryIterator($src);
		foreach ($i as $f) {
			// if this is a file
			if ($f->isFile()) {
				// Copy it
				copy($f->getRealPath(), "$dest/" . $f->getFilename());
			} else if (!$f->isDot() && $f->isDir()) {
				// Recursively copy it
				copyDirRecursively($f->getRealPath(), "$dest/$f");
			}
		}
	}

	/**
	 * @param $dir
	 *
	 * @return bool
	 */
	function removeDirRecursively($dir)
	{

		// Get just the files/folders we need to remove
		$files = array_diff(scandir($dir), [
			'.',
			'..'
		]);
		// Loop through them
		foreach ($files as $file) {
			// Delete them
			(is_dir("$dir/$file")) ? removeDirRecursively("$dir/$file") : unlink("$dir/$file");
		}

		// Remove the final directory
		return rmdir($dir);
	}

	// Function to help sort array by length
	/**
	 * @param $a
	 * @param $b
	 *
	 * @return int
	 */
	function sortByLength($a, $b)
	{

		return strlen($a) - strlen($b);
	}

	// This will process all files according to type
	/**
	 * @param $type
	 * @param $path
	 * @param $tmpPath
	 *
	 * @return bool
	 */
	function processTypes($type, $path, $tmpPath)
	{

		// Output what type is processing
		echo 'Processing ' . strtoupper($type) . PHP_EOL;
		// Process files according to type
		switch ($type) {
			case 'js';
				if (!is_dir($path . '/.js')) {
					// Create the directoy if it doesn't exist
					mkdir($path . '/.js/', 0777, true);
				}
				if (!is_dir($tmpPath . '/js')) {
					// Create the directoy if it doesn't exist
					mkdir($tmpPath . '/js/', 0777, true);
				}
				// Get all the files we need to process
				$result = processFiles(fillArrayWithFileNodes(new DirectoryIterator($path . '/.js/')));

				// Sort those files by length (!IMPORTANT if not sorted by length, you do not create directories before you process the file)
				usort($result, 'sortByLength');

				// Loop through each file
				foreach ($result as $row => $value) {

					// Define where the new compiled file is going
					$oldPath = '.js/' . $value;
					$newPath = 'js/' . str_replace('.js', '.closure.js', $value);
					$sourceMapName = str_replace($tmpPath, '.', $newPath) . '.map';

					// Check that the directoy exists
					$directoy = dirname($newPath) . '/';

					if (!is_dir($directoy)) {
						// Create the directoy if it doesn't exist
						mkdir($directoy, 0777, true);
					}

					// Output that we are processing that file
					echo '	Processing File (With SourceMap): ' . $value . PHP_EOL;

					// Process the file
					$output = processFile('java -jar /bin/closure-compiler.jar --compilation_level WHITESPACE_ONLY --js ' . $oldPath . ' --js_output_file ' . $newPath . ' --source_map_format=V3 --create_source_map "' . $sourceMapName . '"');

					// If the output has generated an error, stop
					if ($output === false) {
						return false;
					}
				}
				break;
			case 'sass':
				if (!is_dir($path . '/.scss')) {
					// Create the directoy if it doesn't exist
					mkdir($path . '/.scss/', 0777, true);
				}
				if (!is_dir($tmpPath . '/scss')) {
					// Create the directoy if it doesn't exist
					mkdir($tmpPath . '/scss/', 0777, true);
				}
				// Get all the files we need to process
				$result = processFiles(fillArrayWithFileNodes(new DirectoryIterator($path . '/.scss/')));

				// Sort those files by length (!IMPORTANT if not sorted by length, you do not create directories before you process the file)
				usort($result, 'sortByLength');

				// Loop through each file
				foreach ($result as $row => $value) {

					// Define where the new compiled file is going
					$oldPath = '.scss/' . $value;
					$newPath = 'scss/' . str_replace('.scss', '.scss.css', $value);

					// Check that the directoy exists
					$directoy = dirname($newPath) . '/';

					if (!is_dir($directoy)) {
						// Create the directoy if it doesn't exist
						mkdir($directoy, 0777, true);
					}

					// Output that we are processing that file
					echo '	Processing File: ' . $value . PHP_EOL;

					// Process the file
					$output = processFile('scss --sourcemap -f ' . $oldPath . ' ' . $newPath . '');

					// If the output has generated an error, stop
					if ($output === false) {
						return false;
					}
				}
				break;
			case 'less':
				if (!is_dir($path . '/.less')) {
					// Create the directoy if it doesn't exist
					mkdir($path . '/.less/', 0777, true);
				}
				if (!is_dir($tmpPath . '/less')) {
					// Create the directoy if it doesn't exist
					mkdir($tmpPath . '/less/', 0777, true);
				}
				// Get all the files we need to process
				$result = processFiles(fillArrayWithFileNodes(new DirectoryIterator($path . '/.less/')));

				// Sort those files by length (!IMPORTANT if not sorted by length, you do not create directories before you process the file)
				usort($result, 'sortByLength');

				// Loop through each file
				foreach ($result as $row => $value) {

					// Define where the new compiled file is going
					$oldPath = '.less/' . $value;
					$newPath = 'less/' . str_replace('.less', '.less.css', $value);

					// Check that the directoy exists
					$directoy = dirname($newPath) . '/';

					if (!is_dir($directoy)) {
						// Create the directoy if it doesn't exist
						mkdir($directoy, 0777, true);
					}

					// Output that we are processing that file
					echo '	Processing File: ' . $value . PHP_EOL;

					// Process the file
					$output = processFile('lessc ' . $oldPath . ' ' . $newPath . '');

					// If the output has generated an error, stop
					if ($output === false) {
						return false;
					}
				}
				break;
			case 'dart':
				if (!is_dir($path . '/.dart')) {
					// Create the directoy if it doesn't exist
					mkdir($path . '/.dart/', 0777, true);
				}
				if (!is_dir($tmpPath . '/dart')) {
					// Create the directoy if it doesn't exist
					mkdir($tmpPath . '/dart/', 0777, true);
				}
				// Get all the files we need to process
				$result = processFiles(fillArrayWithFileNodes(new DirectoryIterator($path . '/.dart/')));

				// Sort those files by length (!IMPORTANT if not sorted by length, you do not create directories before you process the file)
				usort($result, 'sortByLength');

				// Loop through each file
				foreach ($result as $row => $value) {

					// Define where the new compiled file is going
					$oldPath = '.dart/' . $value;
					$newPath = 'dart/' . str_replace('.dart', '.dart.js', $value);

					// Check that the directoy exists
					$directoy = dirname($newPath) . '/';

					if (!is_dir($directoy)) {
						// Create the directoy if it doesn't exist
						mkdir($directoy, 0777, true);
					}

					// Output that we are processing that file
					echo '	Processing File: ' . $value . PHP_EOL;

					// Process the file
					$output = processFile('dart2js ' . $oldPath . ' -o ' . $newPath . '');

					// If the output has generated an error, stop
					if ($output === false) {
						return false;
					}
				}
				break;
			default:
				// @todo: Error output
				break;
		}

	}

	/**
	 * @param $command
	 *
	 * @return bool
	 */
	function processFile($command)
	{

		// Set the default returnCode
		$returnCode = 0;
		// Set the output array
		$output = [];

		// Run the command
		$result = exec($command, $output, $returnCode);

		// Return if the command failed
		if ($returnCode !== 0) {
			return false;
		}

		// Everything ran fine
		return true;
	}

	/**
	 * @param $files
	 *
	 * @return array
	 */
	function processFiles($files)
	{

		// Setup the array where we will store the flat paths
		$flatPaths = [];

		// Loop through each file
		foreach ($files as $row => $value) {

			// If this is a directoy
			if (is_array($value)) {

				// Process each file in the array
				$tempArray = processFiles($value);

				// Add each file to our output
				foreach ($tempArray as $row2 => $value2) {
					$flatPaths[] = $row . '/' . $value2;
				}
			} else {
				// This is a file, we can just add it to the output
				$flatPaths[] = $value;
			}
		}

		// Return our flat paths
		return $flatPaths;
	}

	// Get Site Settings
	$siteSettings = $GLOBALS['HC_CORE']->getSite()->getSettings();

	// Get the resource path
	if (isset($siteSettings['compilation'])) {
		if (isset($siteSettings['compilation']['path'])) {
			$realDirectoyPath = realpath('../public' . $siteSettings['compilation']['path']);
		} else {
			$realDirectoyPath = realpath('../public/resources/');
		}

		// Create the temp working directoy
		mkdir('tmp', 0777, true);

		// Move into that directory
		chdir('tmp');

		// Get the tmp path
		$realTMPPath = dirname(__FILE__) . '/tmp';

		// Copy resources into tmp
		copyDirRecursively($realDirectoyPath, $realTMPPath);
		echo 'Copying resources into temporary working directory' . PHP_EOL;

		if (isset($siteSettings['compilation']['languages'])) {
			// Process according to settings
			foreach ($siteSettings['compilation']['languages'] as $row => $value) {
				// If this option is enabled
				if ($value === true) {
					// Process the type
					if (processTypes($row, $realDirectoyPath, $realTMPPath) === false) {
						// Tell us if it failed
						echo 'Failed' . PHP_EOL;
						exit(1);
						// Stop processing types
						break;
					}
				}
			}
			chdir('../');

			echo 'Updating public with new compiled resources' . PHP_EOL;

			// Replace live files with the new ones in tmp
			moveDirRecursively($realTMPPath, $realDirectoyPath);

			// Remove the temp directory
			removeDirRecursively('tmp');

			// Clear APC
			$apc = new HC_APC();
			$apc->deleteAll();
		} else {
			echo 'No languages defined.' . PHP_EOL;
			exit(0);
		}
	} else {
		echo 'Not enabled.' . PHP_EOL;
		exit(0);
	}
