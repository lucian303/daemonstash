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

	public function printMusicDirectory()
	{
		$allFiles = $this->getFileArrays();
		sort($allFiles['musicFiles'], SORT_LOCALE_STRING);

		/** @var $file DirectoryIterator */
		foreach ($allFiles['musicFiles'] as $file) {
			$directoryPattern = trim(str_replace('-R', '', $this->directoryPattern));
			$prettyName = str_replace($directoryPattern, '', $file->getPathname());
			print '<a class="music" href="' . $file->getPathname() . '">' . $prettyName . '</a><br />';
		}
	}

	protected function getFileArrays()
	{
		$allFiles = $musicFiles = $otherFiles = array();

		/** @var $file DirectoryIterator */
		foreach (new AdvancedDirectoryIterator($this->directoryPattern) as $file) {
			$fileInfo = $file->getFileInfo(); // have to do it this way to be php 5.2 compatible
			$extension = pathinfo($fileInfo->getFilename(), PATHINFO_EXTENSION);

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
