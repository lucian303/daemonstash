<?php

require_once 'DirectoryPrinter.php';

/**
 * Sets up a printer to be used to render directory contents
 */
class PrinterSetup
{

	public static function getPrinter() {
		// look for uploads directory out of the web root by default
		$searchPath = '-R ../uploads/';

		// read any subdir and process it based on rewritten URI path
		// TODO: change from hardcoded to /get/ as the base insall
		$pathRequested = parse_url($_SERVER['REQUEST_URI']);
		if ($pathRequested) {
			$subDirPath = preg_replace('#\/get/#', '', $pathRequested['path']);
			$searchPath = '-R ../uploads/' . $subDirPath;
		}

		return new DirectoryPrinter($searchPath);
	}

}
