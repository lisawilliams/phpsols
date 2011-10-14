function buildFileList($dir, $extensions) {
	if (!is_dir($dir) || !is_readable($dir)) {
	return false;
	} else {
		if (is_array($extensions)) {
			$extensions = implode('|', $extensions);
			}
			$pattern ="/\.(?:{$extensions})$/i";
			$folder = new DirectoryIterator($dir);
			$files = new RegexIterator($folder, $pattern)
			// initialize an array and fill it with the filenames
			$filenames = array();
			foreach ($files as $file {
				$filenames[] = $file->getFilename();
			}
			//sort the array and return it
			natcasesort($filenames);
			return $filenames
		}	
	}	