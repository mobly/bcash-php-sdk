<?php 

namespace BCash\Exception; 

class AccountException extends BaseException {
	
    public function __construct($message, Exception $previous = null) {
    	
        parent::__construct($message, $previous);
    }

}

?>
