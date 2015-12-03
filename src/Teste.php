<?php
require_once 'BcashApi.php';

//Create Address
function createAddress(){
	$address = new Address();
	$address->setAddress("Av. Tiradentes");
	$address->setNumber("123");
	$address->setComplement("Ap. 203");
	$address->setNeighborhood("Centro");
	$address->setCity("São Paulo");
	$address->setState(StateEnum::SAO_PAULO);
	$address->setZipCode("17500000");
	return $address;
}

//Create buyer
function createBuyer(){
	$buyer = new Customer();
	$buyer->setMail("comprador@comprador.com");
	$buyer->setName("Comprador Teste");
	$buyer->setCpf("850-822-365-04");
	$buyer->setPhone("34-3311-9999");
	$buyer->setCellPhone("34-9999-1111");
	$buyer->setAddress(createAddress());
	$buyer->setGender(GenderEnum::MALE);
	$buyer->setBirthDate("01/01/1970");
	$buyer->setRg("11337733");
	$buyer->setIssueRgDate("01/01/1990");
	$buyer->setOrganConsignorRg("SSP");
	$buyer->setStateConsignorRg("MG");
	$buyer->setCompanyName("Empresa de teste");
	$buyer->setCnpj("72-139-715/0001-30");
	$buyer->setSearchToken("");
	return $buyer;
}

//Create payment method
function createPaymentMethod($type){
	$paymentMethod = new PaymentMethod();
	switch ($type){
		case "cartao":
		    $paymentMethod->setCode(PaymentMethodEnum::VISA);
		    break;
		case "boleto":
		    $paymentMethod->setCode(PaymentMethodEnum::BANK_SLIP);
		    break;
		case "transferencia":
		    $paymentMethod->setCode(PaymentMethodEnum::BB_ONLINE_TRANSFER);
		    break;
	}
    return $paymentMethod;
}

//Credit Card
function createCreditCard(){
	$creditCard = new CreditCard();
	$creditCard->setHolder("João D. F. Silva");
	$creditCard->setNumber("4111111111111111");
	$creditCard->setSecurityCode("123");
	$creditCard->setMaturityMonth("01");
	$creditCard->setMaturityYear("2016");
	return $creditCard;
}

//Create products
function createProduct(){
	//Product 1
	$product1 = new Product();
	$product1->setCode(1);
	$product1->setDescription("Produto de teste 1");
	$product1->setAmount(2);
	$product1->setValue(5.5);
	$product1->setExtraDescription("Este produto é um exemplo");
	//Product 2
	$product2 = new Product();
	$product2->setCode(2);
	$product2->setDescription("Produto de teste 2");
	$product2->setAmount(1);
	$product2->setValue(9);
	$product2->setExtraDescription("");
	//Product Array
	$products = array($product1,$product2);
	return $products;
}


//Create transaction request
function createTransactionRequest(){
	$transactionRequest = new TransactionRequest();
	$transactionRequest->setSellerMail("lojamodelo@pagamentodigital.com.br");
	$transactionRequest->setIpSeller("127.0.0.1");
	$transactionRequest->setOrderId("123456");
	$transactionRequest->setBuyer(createBuyer());
	$transactionRequest->setFree("Campo livre");
	$transactionRequest->setFreight(10.95);
	$transactionRequest->setFreightType(FreightTypeEnum::E_SEDEX);
	$transactionRequest->setDiscount(1.20);
	$transactionRequest->setAddition(3);
	$transactionRequest->setUrlReturn("https://www.bcash.com.br/loja/retorno.php");
	$transactionRequest->setUrlNotification("https://www.bcash.com.br/loja/aviso.php");
	$transactionRequest->setProducts(createProduct());
	$transactionRequest->setInstallments(5);
	$transactionRequest->setCurrency(CurrencyEnum::REAL);
	$transactionRequest->setAcceptedContract("S");
	$transactionRequest->setViewedContract("S");
	$transactionRequest->setCampaignId("123");
	return $transactionRequest;
}

$transactionServiceImpl = new TransactionServiceImpl();
$transactionRequest = createTransactionRequest();

//Credicard with Visa
$transactionRequest->setPaymentMethod(createPaymentMethod("cartao"));
$transactionRequest->setCreditCard(createCreditCard());

print "Transação com cartão de crédito. \n";
try {

	$response = $transactionServiceImpl->createTransaction($transactionRequest);
	print_r($response);
}
catch(TransactionException $e) {
	
	echo "Falha ao criar transacao com cartao: " . $e->getMessage() . "\n";
}


//BankSlip
print "Transação com boleto. \n";
$transactionRequest->setPaymentMethod(createPaymentMethod("boleto"));
try {
	
	$response = $transactionServiceImpl->createTransaction($transactionRequest);
	print_r($response);
}
catch(TransactionException $e) {

	echo "Falha ao criar transacao com boleto: " . $e->getMessage() . "\n";
}


//Online Transfer
print "Transação com transferência Eletrônica. \n";
$transactionRequest->setPaymentMethod(createPaymentMethod("transferencia"));
try {

	$response = $transactionServiceImpl->createTransaction($transactionRequest);
	print_r($response);
}
catch(TransactionException $e) {

	echo "Falha ao criar transacao com TEF: " . $e->getMessage() . "\n";
}


print "Buscar conta. \n";
$accountServiceImpl = new AccountServiceImpl();
try {
	
	$response = $accountServiceImpl->searchAccounts('66725023274');
	print_r($response);
}	
catch(AccountException $e) {

	echo "Falha ao buscar conta: " . $e->getMessage() . "\n";
}
