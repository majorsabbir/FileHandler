<?php

namespace FileHandler\src;

class FileCopy {
	protected $_localDir = NULL;
	protected $_defaultDir = "uploads";
	protected $_newFileName;
	protected $_sourceFile = NULL;



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

	public function setSourceFile($sourceFile) {
		$this->_sourceFile = $sourceFile;
	}
	
	private function _localFile($newFileName=NULL) {
		if($newFileName===NULL) return $this->_localDir . "/" . $this->_getNewFileName();

		if($newFileName!==NULL) return $this->_localDir . "/" . ltrim(strrchr($newFileName, "/"), "/");
	}

	private function _getNewFileName() {
		return $this->_newFileName;
	}

	public function save() {
		$this->_setDefaultDir();
		$this->_checkDir();
		if(is_string($this->_sourceFile)) {
			return copy($this->_sourceFile, $this->_localFile());
		}
		if(is_array($this->_sourceFile)) {
			foreach ($this->_sourceFile as $key => $value) {
				$this->_result[$key] = copy($value, $this->_localFile($value));
			}
		}
		
	}

	public function getResult() {
		return $this->_result;
	}

}

