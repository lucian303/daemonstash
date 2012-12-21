<?php

require_once 'DirectoryPrinter.php';

/**
 * Routes to the right action based on input parameters and dispatches it
 */
class RouterDispatcher
{

	public static function go($printer) {
		$allowedTypes = array('music', 'document', 'other', 'all');
		$type = (string)trim($_GET['type']);

		if (in_array($type, $allowedTypes)) {
			$printerControllerMethod = 'print' . ucfirst($type) . 'Directory';
			$printer->$printerControllerMethod();
		}
		else {
			$printer->printAllDirectory();
		}
	}

}

