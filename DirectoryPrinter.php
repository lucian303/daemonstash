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
		$this->printDirectory('musicFiles');
	}

	public function printOtherDirectory()
	{
		$this->printDirectory('otherFiles');
	}

	public function printAllDirectory()
	{
		// Get files and combine them, then set a different css class depending on type
		$files = $this->getFileArrays();
		$musicFiles = $files['musicFiles'];
		$otherFiles = $files['otherFiles'];
		$combinedFiles = array_merge($musicFiles, $otherFiles);
		sort($combinedFiles, SORT_LOCALE_STRING);

		$directoryPattern = trim(str_replace('-R', '', $this->directoryPattern));

		/** @var $file DirectoryIterator */
		foreach ($combinedFiles as $file) {
			$prettyName = str_replace($directoryPattern, '', $file->getPathname());
			print '<a class="' . $file->category . '" href="' . $file->getPathname() . '">' . $prettyName . '</a><br />';
		}
	}

	protected function printDirectory($type)
	{
		$files = $this->getFileArrays();
		sort($files[$type], SORT_LOCALE_STRING);

		$directoryPattern = trim(str_replace('-R', '', $this->directoryPattern));

		/** @var $file DirectoryIterator */
		foreach ($files[$type] as $file) {
			$prettyName = str_replace($directoryPattern, '', $file->getPathname());
			print '<a class="' . $type . '" href="' . $file->getPathname() . '">' . $prettyName . '</a><br />';
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
				$file->category = 'musicFiles';
				$musicFiles[] = $file;
			}
			else {
				$file->category = 'otherFiles';
				$otherFiles[] = $file;
			}

			$allFiles[] = $file;
		}

		$return = array('allFiles' => $allFiles, 'musicFiles' => $musicFiles, 'otherFiles' => $otherFiles);

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
