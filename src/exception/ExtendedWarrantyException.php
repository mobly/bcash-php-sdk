<?php

namespace BCash\Exception;  

class ExtendedWarrantyException extends BaseException {
	
	public function __construct($message, Exception $previous = null) {
		 
		parent::__construct($message, $previous);
	}
}
?>
