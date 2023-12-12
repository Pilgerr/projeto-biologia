<?php

namespace Source\Models;

use Source\Core\Connect;

class Usuario
{
    private $id;
    private $email;
    private $nome;
    private $telefone;
    private $senha;
    private $cpf;
    private $adm;

    function __construct(
        ?string $email = NULL,
        ?string $nome = NULL,
        ?string $telefone = NULL,
        ?string $senha = NULL,
        ?string $cpf = NULL,
        ?string $adm = NULL
    ) {

        $this->email = $email;
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->senha = $senha;
        $this->cpf = $cpf;
        $this->adm = $adm;
    }

    public function cadastrarUsuario(): bool
    {
        $consulta = "INSERT INTO users (`EMAIL`, `NOME`, `TELEFONE`, `SENHA`, `CPF`, `ADM`) VALUES (:email, :nome, :telefone, :senha, :cpf, 'false')";
        $declaracao = Connect::getInstance()->prepare($consulta);
        $declaracao->bindParam(":email", $this->email);
        $declaracao->bindParam(":nome", $this->nome);
        $declaracao->bindParam(":telefone", $this->telefone);
        $senhaHash = password_hash($this->senha, PASSWORD_DEFAULT);
        $declaracao->bindParam(":senha", $senhaHash);
        $declaracao->bindParam(":cpf", $this->cpf);
        $declaracao->execute();

        if ($declaracao->rowCount() == 1) {
            $conjuntoDadosUsuario = [
                "id" => Connect::getInstance()->lastInsertId(),
                "nome" => $this->nome,
                "email" => $this->email,
                "adm" => $this->adm
            ];
            $_SESSION["usuario"] = $conjuntoDadosUsuario;

            return true;
        } else {
            return false;
        }
    }

    public function validarUsuario(string $email, string $senha)
    {
        $consulta = "SELECT * FROM USUARIOS WHERE EMAIL LIKE :email";
        $declaracao = Connect::getInstance()->prepare($consulta);
        $declaracao->bindParam(":email", $email);
        $declaracao->execute();

        if ($declaracao->rowCount() == 1) {
            $usuarioRetornadoDaConsulta = $declaracao->fetch();
            if (password_verify($senha, $usuarioRetornadoDaConsulta->SENHA)) {
                $conjuntoDadosUsuario = [
                    "id" => $usuarioRetornadoDaConsulta->ID,
                    "nome" => $usuarioRetornadoDaConsulta->NOME,
                    "email" => $email,
                    "adm" => $usuarioRetornadoDaConsulta->ADM
                ];
                $_SESSION["user"] = $conjuntoDadosUsuario;

                $this->id = $usuarioRetornadoDaConsulta->ID;
                $this->email = $usuarioRetornadoDaConsulta->EMAIL;
                $this->nome = $usuarioRetornadoDaConsulta->NOME;
                $this->telefone = $usuarioRetornadoDaConsulta->TELEFONE;
                $this->senha = $usuarioRetornadoDaConsulta->SENHA;
                $this->cpf = $usuarioRetornadoDaConsulta->CPF;
                $this->adm = $usuarioRetornadoDaConsulta->ADM;

                return 'SUCESSO';
            }
            return 'ERRO_SENHA';
        } else {
            return 'ERRO_EMAIL';
        }
    }

    public function selecionarTodosUsuarios()
    {
        $consulta = "SELECT * FROM USUARIOS";
        $declaracao = Connect::getInstance()->prepare($consulta);
        $declaracao->execute();

        if ($declaracao->rowCount() > 0) {
            return $declaracao->fetchAll();
        } else {
            return false;
        }
    }

    public function validarUsuarioAdministrador(int $id)
    {
        $consulta = "SELECT ADM FROM USUARIOS WHERE ADM LIKE 'true' AND ID = :id";
        $declaracao = Connect::getInstance()->prepare($consulta);
        $declaracao->bindParam(":id", $id);
        $declaracao->execute();

        if ($declaracao->rowCount() == 1) {
            $_SESSION["usuario"]["adm"] = true;
            return true;
        } else {
            $_SESSION["usuario"]["adm"] = false;
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getCPF()
    {
        return $this->cpf;
    }

    public function getAdm()
    {
        return $this->adm;
    }

    public function getArray(): array
    {
        return [
            "usuario" => [
                "id" => $this->getId(),
                "nome" => $this->getNome(),
                "email" => $this->getEmail(),
                "cpf" => $this->getCPF(),
                "adm" => $this->getAdm()
            ]
        ];
    }
}