<?php

namespace BCash\ServiceImpl;;

use BCash\Config\Config;
use BCash\Domain\TransactionRequest;
use BCash\Exception\TransactionException;
use BCash\Exception\ServiceHttpException;
use BCash\Service\TransactionService;

/**
 * Cliente para consulta de transações.
 *
 */
class Consultation extends BaseService
{

	/**
	 * Busca os dados da transação pelo id da transação no Bcash.
	 *
	 * @param id_transacao
	 *           Id da transação no Bcash a ser consultada.
	 * @return Objeto que contém informações da busca
	 */
	public function searchByTransactionId($id_transacao)
	{
        try{

            $config = Config::getInstance();

            $httpResponse = $this->getHttpHelper()->post(
                $config->transactionSearchHost, 
                array('id_transacao' =>  $id_transacao, "tipo_retorno" => 2), 
                $this->getAuthenticationHelper()->generateAuthenticationBasic(),
                false
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


		//$request = $this->generateRequest("id_transacao", $id_transacao);
		//$response = $this->send($request);

		//return HttpHelper::fromJson($response->getContent());
	}
}
