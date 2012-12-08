<?php
require_once 'RealRecursiveDirectoryIterator.php';
require_once 'AdvancedDirectoryIterator.php';


class DirectoryPrinter
{
	public function printDirectory($directoryPattern)
	{
		$files = array();

		/** @var $file DirectoryIterator */
		foreach (new AdvancedDirectoryIterator($directoryPattern) as $file) {
			$files[] = $file;
		}

		foreach ($files as $file) {
			$mp3CssTag = '';
			$name = $file->getFilename();

			if (strpos($name, '.mp3', strlen($name - 4) !== false)) {
				$mp3CssTag = ' class="mp3" ';
			}

			print '<a href="' . $file->getPathname() . '"' . $mp3CssTag . '>' . $file->getPathname() . '</a><br />';

		}
	}
}
