<?php

namespace Image\src;

class ImageCopy {
	protected $_localDir = NULL;
	protected $_defaultDir = "uploads";
	protected $_newFileName;
	protected $_sourceImage = NULL;

	private function _setSourceFileExt() {
		if(is_null($this->_sourceImage)) {
			throw new \Exception("Mention source file before setting new filename");
			return false;
		}
		return strrchr($this->_sourceImage, ".");
	}

	private function _checkDir() {
		if(!is_dir($this->_localDir)) {
			mkdir($this->_localDir);
		}
	}

	private function _setDefaultDir() {
		if(is_null($this->_localDir)) {
			$this->_localDir = $this->_defaultDir;
		}
	}

	public function setLocalDir($localDir) {
		$this->_localDir = rtrim($localDir, "/");
	}

	public function setNewName($newName) {
		$this->_newFileName = $newName.$this->_setSourceFileExt();
	}

	public function setSourceImage($sourceImage) {
		$this->_sourceImage = $sourceImage;
	}
	
	private function _localImage() {
		return $this->_localDir . "/" . $this->_getNewFileName();
	}

	private function _getNewFileName() {
		return $this->_newFileName;
	}

	public function save() {
		$this->_setDefaultDir();
		$this->_checkDir();
		return copy($this->_sourceImage, $this->_localImage());
	}

}

