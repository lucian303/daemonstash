<?php
require_once 'RealRecursiveDirectoryIterator.php';
require_once 'AdvancedDirectoryIterator.php';


class DirectoryPrinter
{
	protected $directoryPattern;

	public function __construct($directoryPattern = null)
	{
		$this->setDirectoryPattern($directoryPattern);
	}

	public function printDirectory()
	{
		$allFiles = $this->getFileArrays();

		/** @var $file DirectoryIterator */
		foreach ($allFiles['musicFiles'] as $file) {
			print '<a class="music" href="' . $file->getPathname() . '">' . $file->getPathname() . '</a><br />';
		}
	}

	protected function getFileArrays()
	{
		$allFiles = $musicFiles = $otherFiles = array();

		/** @var $file DirectoryIterator */
		foreach (new AdvancedDirectoryIterator($this->directoryPattern) as $file) {
			$extension = $file->getExtension();
			if (in_array($extension, array('mp3', 'ogg'))) { // need a more complete list of music formats
				$musicFiles[] = $file;
			}
			else {
				$otherFiles[] = $file;
			}

			$allFiles[] = $file;
		}

		$return = array(
			'allFiles' => $allFiles,
			'musicFiles' => $musicFiles,
			'otherFiles' => $otherFiles,
		);

		return $return;
	}

	public function getDirectoryPattern()
	{
		return $this->directoryPattern;
	}

	public function setDirectoryPattern($directoryPattern)
	{
		if ($directoryPattern) {
			$this->directoryPattern = $directoryPattern;
		}
	}

}
