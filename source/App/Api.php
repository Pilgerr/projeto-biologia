<?php

namespace Source\App;

use Source\Models\Product;
use Source\Models\Provider;
use Source\Models\Sale;
use Source\Models\Usuario;

class Api
{
    public function __construct()
    {
        header('Content-Type: application/json; charset=UTF-8');
    }

    public function validateUser()
    {
        $headers = getallheaders();

        if (empty($headers["Email"]) || empty($headers["Password"])) {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe Email e Senha!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $user = new Usuario();

        if (!$user->validarUsuario($headers["Email"], $headers["Password"], true)) {
            $response = [
                "code" => 401,
                "type" => "unauthorized",
                "message" => "E-mail ou Senha não cadastrados!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        echo json_encode($user->getArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function getUser()
    {
        $headers = getallheaders();

        if (empty($headers["Id"])) {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe o ID!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $user = new Usuario();

        if (!$user->selectUser($headers["Id"])) {
            $response = [
                "code" => 401,
                "type" => "unauthorized",
                "message" => "Id não encontrado!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        echo json_encode($user->getArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function getUsers()
    {
        $key = "kIJslosm@782";
        $headers = getallheaders();

        if ($headers["Key"] == $key) {
            $users = new Usuario();
            echo json_encode($users->selecionarTodosUsuarios(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe a chave de acesso!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function insertUser()
    {
        $headers = getallheaders();

        if (!empty($headers)) {
            $user = new Usuario(
                $headers["Email"],
                $headers["Name"],
                $headers["PhoneNumber"],
                $headers["Password"],
                $headers["DtBorn"],
                $headers["Document"],
                NUll
            );
            $user->cadastrarUsuario();
            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Usuário cadastrado com sucesso!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe todos os dados do usuário!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function updateUser(array $data)
    {
        if (!empty($data)) {
            $user = new Usuario();
            $user->updatePhotoUser($data["photo"], $data["id"]);
            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Usuário alterado com sucesso!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe todos os dados do usuário!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function getProduct()
    {
        $headers = getallheaders();

        if (empty($headers["Id"])) {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe o ID!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $product = new Product();

        if (!$product->selectProduct($headers["Id"])) {
            $response = [
                "code" => 401,
                "type" => "unauthorized",
                "message" => "Id não encontrado!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        echo json_encode($product->getArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function getProducts()
    {
        $products = new Product();
        echo json_encode($products->selectAllProducts(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function insertProduct(array $data)
    {
        if (!empty($data)) {
            $product = new Product(
                $data["image"], // ACERTAR ENVIO DA URL
                $data["name"],
                $data["price"],
                $data["description"],
                "on"
            );
            $product->insertProduct();
            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Usuário alterado com sucesso!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe todos os dados do produto!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function updateProduct(array $data)
    {
        if (!empty($data)) {
            $product = new Product(
                $data["image"],
                $data["name"],
                $data["price"],
                $data["description"],
                $data["available"]
            );
            $product->updateProduct($data["id"]);
            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Usuário alterado com sucesso!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe todos os dados do usuário!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function getProvider()
    {
        $headers = getallheaders();

        if (empty($headers["Id"])) {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe o ID!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $provider = new Provider();

        if (!$provider->selectProvider($headers["Id"])) {
            $response = [
                "code" => 401,
                "type" => "unauthorized",
                "message" => "Id não encontrado!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        echo json_encode($provider->getArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function getProviders()
    {
        $providers = new Provider();
        echo json_encode($providers->selectAllProviders(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function getSale(array $data)
    {

        if (empty($data["id"])) {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe o ID!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $sale = new Sale();

        if (!$sale->selectSale($data["id"])) {
            $response = [
                "code" => 401,
                "type" => "unauthorized",
                "message" => "Id não encontrado!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        echo json_encode($sale->getArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function getSales()
    {
        $sales = new Sale();
        echo json_encode($sales->selectAllSales(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function insertSale(array $data)
    {
        if (!empty($data)) {
            $sale = new Sale(
                NULL,
                $data["total"],
                $data["idUser"]
            );
            $sale->insertSale();
            $response = [
                "code" => 200,
                "type" => "success",
                "message" => "Usuário alterado com sucesso!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe todos os dados da venda!"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }
}
