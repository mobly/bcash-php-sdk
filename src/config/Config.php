<?php

namespace BCash\Config;

/**
 * Classe de configuração responsável por armazenar as informações de conexão do cliente com a API </br>
 * Responsável também por armazenar as configurações de utilização da API desejadas, como por exemplo a versão. 
 *
 */
class Config{

    #Account config
    protected $credentialsEmail;
    protected $credentialsToken;


    #Api config
    protected $transactionHost;
    protected $transactionCharset;

     protected $transactionSearchHost;

    protected $accountHost;
    protected $accountCharset;

    protected $extendedWarrantyService;
    protected $extendedWarrantyCharset;

    protected $version;
    protected $timeout;

    #Oauth config
    protected $oAuthConsumerKey;
    protected $oAuthRealm;
    protected $oAuthSignatureMethod;
    protected $oAuthVersion;

    private static $instance;

    public static function getInstance($config = null)
    {
        if (null === static::$instance && !empty($config)) {
            static::$instance = new static($config);
        }

        return static::$instance;
    }

    protected function __construct($config)
    {
        $properties = get_object_vars($this);
        $configKeys = array_keys($config);
        foreach ($properties as $property => $value) {
            if (in_array($property, $configKeys)) {
                $this->$property =  $config[$property];
            }
        }
    }

    /**
     * undocumented function
     *
     * @return void
     * @author yourname
     **/
    public function __get($name)
    {
        return $this->$name;    
    }

    /**
     * undocumented function
     *
     * @return void
     * @author yourname
     **/
    public function getSellerMail()
    {
        return $this->credentialsEmail;    
    }


}
