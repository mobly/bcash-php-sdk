<?php

namespace BCash\ServiceImpl;

/**
 * Classe base para implementacoes de servicos.
 *
 */
abstract class BaseService {
	
	private $authHelper;
	private $httpHelper;

	public function __construct() {
		
		$this->authHelper = new AuthenticationHelper();
		$this->httpHelper = new HttpServiceImpl();
		
	}

	public function __destruct() {
		
		unset($this->httpHelper);
		unset($this->authHelper);
	}
	
	protected function getAuthenticationHelper() {
		
		return $this->authHelper;
	}
	
	protected function getHttpHelper() {
		
		return $this->httpHelper;
	}
	
	protected function parse($response) {
		
		return json_decode($response);
	}
}
?>
