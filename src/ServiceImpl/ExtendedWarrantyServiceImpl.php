<?php

namespace BCash\ServiceImpl;

use BCash\Service\ExtendedWarrantyService;
use BCash\Exception\ExtendedWarrantyException;
use BCash\Exception\ServiceHttpException;

/**
 * Implementacao de @{ExtendedWarrantyService}.
 *
 */
final class ExtendedWarrantyServiceImpl extends BaseService implements ExtendedWarrantyService {
	
	public function __construct() {
	
		parent::__construct();
	}
	
	public function __destruct() {
	
		parent::__destruct();
	}
	
	/*
	 * (non-PHPdoc) @see ExtendedWarrantyService::findExtendedWarrantyByProducts()
	 */
	public function findExtendedWarrantyByProducts(ExtendedWarrantySearchRequest $request) {
		
		try{
		
			$httpResponse = $this->getHttpHelper()->post(Config::extendedWarrantyService, $request, $this->getAuthenticationHelper()->generateAuthenticationBasic());
		
			if(!$httpResponse->isResponseOK()){
					
				if($httpResponse->isBadRequest()) {
		
					throw new ExtendedWarrantyException("Parametros fornecidos sao invalidos: " . $httpResponse->getResponse());
				}
					
				throw new ExtendedWarrantyException("Falha ao pesquisar produtos: " . $httpResponse->getResponse());
			}
		
			return $this->parse($httpResponse->getResponse());
				
		} catch(ServiceHttpException $e) {
				
			throw new ExtendedWarrantyException("Falha HTTP ao pesquisar produtos", 0, $e);
		}
		
	}
}
?>
