<?php

namespace BCash\Domain;

class ServiceHttpResponse {

	private static $OK = 200;
	private static $BAD_REQUEST = 400;
	private $code;
	private $response;

	public function getCode(){
		return $this->code;
	}

	public function getResponse(){
		return $this->response;
	}

	public function setCode($code){
		$this->code = $code;
	}

	public function setResponse($response){
		$this->response = $response;

	}
	
	public function isResponseOK() {
		
		return isset($this->code) && ($this->code == self::$OK);
	}
	
	public function isBadRequest() {
		
		return isset($this->code) && ($this->code == self::$BAD_REQUEST);
	}

}


?>
