<?php

namespace BCash\Domain;

class PaymentMethod extends Model {

	protected $code;
	
	public static function createPaymentMethod($code) {
		
		$method = new PaymentMethod();
		$method->setCode($code);
		
		return $method;
	}

	/**
	 * Meio de Pagamento utilizado para processar a transação<br>
	 * *Vide enum: {@link PaymentMethodEnum}
	 *
	 * @return code
	 *            , ex.: PaymentMethodEnum::VISA
	 */
	public function getCode() {

		return $this->code;
	}


	/**
	 * Meio de Pagamento utilizado para processar a transação<br>
	 * <b>Campo obrigatório</b> <br>
	 * *Vide enum: {@link PaymentMethodEnum}
	 *
	 * @param code
	 *            , ex.: PaymentMethodEnum::VISA
	 */
	public function setCode($code) {

		$this->code = $code;
	}
}

?>
