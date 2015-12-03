<?php

namespace BCash; 

use BCash\Config\Config;
use BCash\Domain\Address;
use BCash\Domain\CreditCard;
use BCash\Domain\Customer;
use BCash\Domain\PaymentMethod;
use BCash\Domain\PaymentMethodEnum;
use BCash\Domain\Product;
use BCash\Domain\TransactionRequest;
use BCash\ServiceImpl\Consultation;
use BCash\ServiceImpl\TransactionServiceImpl;

class BcashApi {

    /**
     * Class Constructor
     *
     * @param array $config
     * @return void
     * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
     **/
    public function __construct($config)
    {                                  
        $this->config = Config::getInstance($config);
    }

    /**
     * Return a TransactionRequest object 
     *
     * @return BCash\Domain\TransactionRequest
     * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
     **/
    public function getTransactionRequest()
    {
        $transactionRequest = new TransactionRequest();

        $transactionRequest->setSellerMail($this->config->getSellerMail());

        return $transactionRequest;
    }    

    /**
     * Return a Customer object
     *
     * @return BCash\Domain\Customer
     * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
     **/
    public function getCustomer()
    {
        return new Customer();    
    }


    /**
     * Return a Product object
     *
     * @return BCash\Domain\Product
     * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
     **/
    public function getProduct()
    {
        return new Product();    
    }


    /**
     * Return a Address object
     *
     * @return BCash\Domain\Address
     * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
     **/
    public function getAddress()
    {
        return new Address();    
    }

    /**
     * Return a PaymentMethod object
     *
     * @return BCash\Domain\PaymentMethod
     * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
     **/
    public function getPaymentMethod()
    {
        return new PaymentMethod();    
    }


    /**
     * Return a CreditCard object
     *
     * @return BCash\Domain\CreditCard
     * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
     **/
    public function getCreditCard()
    {
        return new CreditCard();    
    }


    /**
     * Return a TransactionServiceImpl object
     *
     * @return BCash\ServiceImpl\TransactionServiceImpl
     * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
     **/
    public function getTransactionService()
    {
        return new TransactionServiceImpl();    
    }

    /**
     * Search transaction by id
     *
     * @return stdClass
     * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
     **/
    public function searchTransaction($transactionId)
    {
        $consultation = new Consultation(); 
        
        $transaction = $consultation->searchByTransactionId($transactionId);

        return $transaction->transacao;

    }

    /**
     * Validate if is a CreditCard
     *
     * @return bool
     * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
     **/
    public function isCreditCardMethod($transactionRequest)
    {
        $creditCards = $this->getCreditCardMethods();
        $paymentMethod = $transactionRequest->getPaymentMethod();

        return in_array($paymentMethod->getCode(), $creditCards);         
    }

    /**
     * Return a list of the CreditCard methods
     *
     * @return array
     * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
     **/
    public function getCreditCardMethods()
    {
        return [
            PaymentMethodEnum::VISA,
            PaymentMethodEnum::MASTERCARD,
            PaymentMethodEnum::AMERICAN_EXPRESS,
            PaymentMethodEnum::AURA,
            PaymentMethodEnum::DINERS,
            PaymentMethodEnum::HIPERCARD,
            PaymentMethodEnum::ELO,
        ];
    }

    /**
     * Return a list of the TEF methods
     *
     * @return array
     * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
     **/
    public function getTransferMethods()
    {
        return [
            PaymentMethodEnum::BB_ONLINE_TRANSFER,
            PaymentMethodEnum::BRADESCO_ONLINE_TRANSFER,
            PaymentMethodEnum::ITAU_ONLINE_TRANSFER,
            PaymentMethodEnum::BANRISUL_ONLINE_TRANSFER,
            PaymentMethodEnum::HSBC_ONLINE_TRANSFER,
        ];
    }

}
