<?php

namespace Source\App;

// use FFI\Exception;
use League\Plates\Engine;
use PHPMailer\PHPMailer\SMTP;
use Source\Models\Product;
use Source\Models\Sale;
use Source\Models\SaleProduct;
use Source\Models\Usuario;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Source\Models\SerVivo;
use stdClass;


class Web
{
    private $view;

    public function __construct()
    {
        $this->view = new Engine(CONF_VIEW_WEB, 'php');
    }

    public function home(): void
    {
        echo $this->view->render("home");
    }

    public function fungi()
    {
        $fungi = new SerVivo();
        $fungis = $fungi->selecionarTodosFungis();

        echo $this->view->render("seres-vivos", ["seresVivos" => $fungis]);
    }

    public function animal()
    {
        $animal = new SerVivo();
        $animais = $animal->selecionarTodosAnimais();

        echo $this->view->render("seres-vivos", ["seresVivos" => $animais]);
    }

    public function vegetal()
    {
        $vegetal = new SerVivo();
        $vegetais = $vegetal->selecionarTodosVegetais();

        echo $this->view->render("seres-vivos", ["seresVivos" => $vegetais]);
    }

    public function protista()
    {
        $protista = new SerVivo();
        $protistas = $protista->selecionarTodosProtistas();

        echo $this->view->render("seres-vivos", ["seresVivos" => $protistas]);
    }

    public function monera()
    {
        $monera = new SerVivo();
        $moneras = $monera->selecionarTodosMoneras();

        echo $this->view->render("seres-vivos", ["seresVivos" => $moneras]);
    }

    public function visualizarSerVivo(array $data)
    {
        if (!empty($data)) {
            $serVivo = new SerVivo();
            $serVivoSelecionado = $serVivo->selecionarSerVivo($data["idSerVivo"]);
        }

        echo $this->view->render("visualizar-ser-vivo", ["serVivo" => $serVivoSelecionado]);
    }

    public function registerUser()
    {
        echo $this->view->render("register-user");
    }

    public function registerUserPost(array $data)
    {
        if (!empty($data)) {
            $user = new Usuario(
                $data['register-email'],
                $data['register-name'],
                $data['register-phoneNumber'],
                $data['register-password'],
                $data['register-dtBorn'],
                $data['register-document']
            );

            $returnInsert = $user->cadastrarUsuario();

            if ($returnInsert == true) {
                $userJson = [
                    "code" => 200,
                    "type" => "success",
                    "message" => "Usuário cadastrado com sucesso!"
                ];
                echo json_encode($userJson);
            } else {
                $userJson = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Não foi possível realizar esta ação :("
                ];
                echo json_encode($userJson);
            }
        }
    }

    public function login()
    {
        echo $this->view->render("login");
    }

    public function loginPost(array $data)
    {

        $email = $data["login-email"];
        $password = $data["login-password"];

        if (empty($email) && empty($password)) {
                $userJson = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Não foi possível realizar esta ação",
                    "subMessage" => "Informe o e-mail e senha",
                    "typeOfError" => "e-mail and password"
                ];
                echo json_encode($userJson);
                exit();
        } else {
            if (empty($email)) {
                $userJson = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Não foi possível realizar esta ação",
                    "subMessage" => "Informe o e-mail",
                    "typeOfError" => "e-mail"
                ];
                echo json_encode($userJson);
                exit();
            }

            if (empty($password)) {
                $userJson = [
                    "code" => 400,
                    "type" => "bad_request",
                    "message" => "Não foi possível realizar esta ação",
                    "subMessage" => "Informe a senha",
                    "typeOfError" => "password"
                ];
                echo json_encode($userJson);
                exit();
            }
        }

        if (!empty($data["login-remember"])) {
            $remember = true;
        } else {
            $remember = false;
        }

        $user = new Usuario();

        $returnValidate = $user->validarUsuario($email, $password, $remember);

        if ($returnValidate === 'SUCCESS') {

            $id = $_SESSION["user"]["id"];
            $user = new Usuario();
            $validate = $user->validarUsuarioAdministrador($id);

            if ($validate == false) {
                $userJson = [
                    "code" => 200,
                    "type" => "success",
                    "message" => "Login efetuado com sucesso",
                    "subMessage" => "Redirecionando para a área logada",
                    "adm" => "false"
                ];
                echo json_encode($userJson);
                exit();
            } elseif ($validate == true) {
                $userJson = [
                    "code" => 200,
                    "type" => "success",
                    "message" => "Login efetuado com sucesso",
                    "subMessage" => "Redirecionando para a área logada",
                    "adm" => "true"
                ];
                echo json_encode($userJson);
                exit();
            }
        } else {
                 if ($returnValidate === 'ERROR_PASSWORD') {
                    $userJson = [
                        "code" => 400,
                        "type" => "bad_request",
                        "message" => "Erro",
                        "subMessage" => "Senha incorreta"
                    ];
                    echo json_encode($userJson);
                 } else {
                    $userJson = [
                        "code" => 400,
                        "type" => "bad_request",
                        "message" => "Erro",
                        "subMessage" => "E-mail não cadastrado"
                    ];
                    echo json_encode($userJson);
                 }
        }
    }

    public function error(array $data): void
    {
        echo $this->view->render("404", [
            "title" => "Erro {$data["errcode"]} | " . CONF_SITE_NAME,
            "error" => $data["errcode"]
        ]);
    }
}