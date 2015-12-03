<?php

namespace BCash\ServiceImpl;

use BCash\Config\Config;
use BCash\Domain\TransactionRequest;
use BCash\Exception\TransactionException;
use BCash\Exception\ServiceHttpException;
use BCash\Service\TransactionService;

/**
 * Implementacao de @{TransactionService}.
 *
 */
class TransactionServiceImpl extends BaseService{

	public function __construct() {
		
		parent::__construct();
	}
	
	public function __destruct() {
		
		parent::__destruct();
	}

	public function createTransaction(TransactionRequest $transactionRequest) {
		
        try{

            $config = Config::getInstance();

            $httpResponse = $this->getHttpHelper()->post(
                $config->transactionHost, 
                $transactionRequest, 
                $this->getAuthenticationHelper()->generateAuthenticationOAuth()
            );

			if(!$httpResponse->isResponseOK()){
			
				if($httpResponse->isBadRequest()) {
				
					throw new TransactionException("Parametros fornecidos sao invalidos: " . $httpResponse->getResponse());
				}
			
				throw new TransactionException("Falha ao criar transacao: " . $httpResponse->getResponse());
			}

			return $this->parse($httpResponse->getResponse());
			
		} catch(ServiceHttpException $e) {
			
			throw new TransactionException("Falha HTTP ao criar transacao", $e);
		}
	}
}
?>
