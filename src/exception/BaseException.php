<?php

namespace BCash\Exception;  

class BaseException extends \Exception {

	public function __construct($message, Exception $previous = null) {
		
		parent::__construct($message, 0, $previous);
	}
	
	public function __toString() {
		return __CLASS__ . ": {$this->message}\n";
	}
}
?>
