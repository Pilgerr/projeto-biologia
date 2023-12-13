<?php

namespace Source\Models;

use Source\Core\Connect;

class SerVivo
{
    private $id;
	private $imagem;
	private $nomePopular;
	private $nomeCientifico;
	private $descricaoEspecie;
	private $reino;
    private $territorio;
    private $observacoes;
    private $registroLocalizacao;
    private $registroColecaoIfSul;

	function __construct(
		?string $imagem = NULL,
		?string $nomePopular = NULL,
		?string $nomeCientifico = NULL,
		?string $descricaoEspecie = NULL,
		?string $reino = NULL,
		?string $territorio = NULL,
		?string $observacoes = NULL,
		?string $registroLocalizacao = NULL,
		?string $registroColecaoIfSul = NULL
	) {
		$this->imagem = $imagem;
		$this->nomePopular = $nomePopular;
		$this->nomeCientifico = $nomeCientifico;
		$this->descricaoEspecie = $descricaoEspecie;
		$this->reino = $reino;
		$this->territorio = $territorio;
		$this->observacoes = $observacoes;
		$this->registroLocalizacao = $registroLocalizacao;
		$this->registroColecaoIfSul = $registroColecaoIfSul;
	}

	public function cadastrarSerVivo(): bool
	{
		$consulta = "INSERT INTO SERES_VIVOS 
					(`IMAGEM`,`NOME_POPULAR`,`NOME_CIENTIFICO`,`DESCRICAO_ESPECIE`,`REINO`,`TERRITORIO`,`OBSERVACOES`,`REGISTRO_LOCALIZACAO`,`REGISTRO_COLECAO_IF_SUL`) 
					VALUES 
					(:imagem, :nome_popular, :nome_cientifico, :descricao_especie, :reino, :territorio, :observacoes, :registro_localizacao, :registro_colecao_if_sul)";

		$declaracao = Connect::getInstance()->prepare($consulta);
		$declaracao->bindParam(":imagem", $this->imagem);
		$declaracao->bindParam(":nome_popular", $this->nomePopular);
		$declaracao->bindParam(":nome_cientifico", $this->nomeCientifico);
		$declaracao->bindParam(":reino", $this->reino);
		$declaracao->bindParam(":territorio", $this->territorio);
		$declaracao->bindParam(":observacoes", $this->observacoes);
		$declaracao->bindParam(":registro_localizacao", $this->registroLocalizacao);
		$declaracao->bindParam(":registro_colecao_if_sul", $this->registroColecaoIfSul);
		$declaracao->execute();

		if ($declaracao->rowCount() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function selecionarSerVivo(int $idSerVivo)
	{
		$consulta = "SELECT * FROM SERES_VIVOS WHERE ID = :idSerVivo";
		$declaracao = Connect::getInstance()->prepare($consulta);
		$declaracao->bindParam(":idSerVivo", $idSerVivo);
		$declaracao->execute();

		if ($declaracao->rowCount() == 1) {
			return $declaracao->fetch();
		} else {
			return false;
		}
	}

	public function selecionarTodosSeresVivos()
	{
		$consulta = "SELECT * FROM SERES_VIVOS";
		$declaracao = Connect::getInstance()->prepare($consulta);
		$declaracao->execute();

		if ($declaracao->rowCount() > 0) {
			return $declaracao->fetchAll();
		} else {
			return false;
		}
	}

	public function selecionarTodosFungis()
	{
		$consulta = "SELECT * FROM SERES_VIVOS WHERE REINO = 'fungi'";
		$declaracao = Connect::getInstance()->prepare($consulta);
		$declaracao->execute();

		if ($declaracao->rowCount() > 0) {
			return $declaracao->fetchAll();
		} else {
			return false;
		}
	}

	public function selecionarTodosAnimais()
	{
		$consulta = "SELECT * FROM SERES_VIVOS WHERE REINO = 'animal'";
		$declaracao = Connect::getInstance()->prepare($consulta);
		$declaracao->execute();

		if ($declaracao->rowCount() > 0) {
			return $declaracao->fetchAll();
		} else {
			return false;
		}
	}

	public function selecionarTodosVegetais()
	{
		$consulta = "SELECT * FROM SERES_VIVOS WHERE REINO = 'vegetal'";
		$declaracao = Connect::getInstance()->prepare($consulta);
		$declaracao->execute();

		if ($declaracao->rowCount() > 0) {
			return $declaracao->fetchAll();
		} else {
			return false;
		}
	}

	public function selecionarTodosProtistas()
	{
		$consulta = "SELECT * FROM SERES_VIVOS WHERE REINO = 'protista'";
		$declaracao = Connect::getInstance()->prepare($consulta);
		$declaracao->execute();

		if ($declaracao->rowCount() > 0) {
			return $declaracao->fetchAll();
		} else {
			return false;
		}
	}

	public function selecionarTodosMoneras()
	{
		$consulta = "SELECT * FROM SERES_VIVOS WHERE REINO = 'monera'";
		$declaracao = Connect::getInstance()->prepare($consulta);
		$declaracao->execute();

		if ($declaracao->rowCount() > 0) {
			return $declaracao->fetchAll();
		} else {
			return false;
		}
	}

}
