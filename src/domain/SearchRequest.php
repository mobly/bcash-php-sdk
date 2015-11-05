<?php

namespace BCash\Domain;

class SearchRequest extends Model {


	protected $cpf;


	/**
	 * CPF do comprador<br>
	 * <i>Tamanho máximo: 17 caracteres</i><br>
	 * <b>Campo obrigatório</b>
	 *
	 * @param cpf
	 *            , ex.: 99999999999
	 */
	public function setCpf($cpf) {

		$this->cpf = $cpf;
	}


	/**
	 * CPF do comprador<br>
	 * <i>Tamanho máximo: 17 caracteres</i><br>
	 *
	 * @return cpf
	 *            , ex.: 99999999999
	 */
    public function getCpf() {

        return $this->cpf;
    }
}
?>
