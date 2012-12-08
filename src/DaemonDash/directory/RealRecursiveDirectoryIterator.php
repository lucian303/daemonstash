<?php
/**
 * Real Recursive Directory Iterator
 */
class RealRecursiveDirectoryIterator extends RecursiveIteratorIterator
{

	/**
	 * Creates Real Recursive Directory Iterator
	 * @param string $path
	 * @param int $flags
	 * @return \RealRecursiveDirectoryIterator
	 */
	public function __construct($path, $flags = 0)
	{
		parent::__construct(new RecursiveDirectoryIterator($path, $flags));
	}

}
