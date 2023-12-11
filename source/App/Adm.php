<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\Product;
use Source\Models\Provider;
use Source\Models\Sale;
use Source\Models\User;

class Adm
{
    private $view;

    public function __construct()
    {
        $user = new User();

        if (!isset($_SESSION["user"])) {
            header("location:" . url("app"));
        }

        if (!$user->validateAdmUser($_SESSION["user"]["id"])) {
            header("location:" . url("app"));
        }

        $this->view = new Engine(CONF_VIEW_ADM, 'php');
    }

    public function home(): void
    {
        $sale = new Sale();
        $sales = $sale->selectAllSales();
        echo $this->view->render("home", ["sales" => $sales]);
    }

    public function registerProduct(array $data)
    {
        if ($data) {
            $product = new Product(
                $data['register-image'],
                $data['register-name'],
                $data['register-price'],
                $data['register-description'],
                "on"
            );
            $returnInsert = $product->insertProduct();
            if ($returnInsert == true) {
                header("location:" . url("adm/cadastro-produto"));
            } else {
                header("location:" . url("error"));
            }
        }
        echo $this->view->render("register-product");
    }

    public function editProduct(array $data)
    {
        if ($data) {
            $product = new Product(
                $data['edit-image'],
                $data['edit-name'],
                $data['edit-price'],
                $data['edit-description'],
                $data['edit-available']
            );
            $returnInsert = $product->updateProduct($data['edit-id']);
            if ($returnInsert == false) {
                header("location:" . url("adm/edicao-produto"));
            } else {
                header("location:" . url("error"));
            }
        } else {
            $product = new Product();
            $products = $product->selectAllProducts();
            echo $this->view->render("edit-product", ["products" => $products]);
        }
    }

    public function registerProvider(array $data)
    {
        if ($data) {
            $provider = new Provider(
                $data['register-name'],
                $data['register-phoneNumber'],
                $data['register-linkInstagram'],
                $data['register-typeProduct']
            );
            $returnInsert = $provider->insertProvider();
            if ($returnInsert == true) {
                header("location:" . url("adm"));
            } else {
                header("location:" . url("error"));
            }
        }
        echo $this->view->render("register-provider");
    }

    public function editProvider(array $data)
    {
        if ($data) {
            $provider = new Provider();
            $returnInsert = $provider->updateProvider($data['edit-id'], $data['edit-name'], $data['edit-phoneNumber'], $data['edit-linkInstagram'], $data['edit-typeProduct']);
            if ($returnInsert == false) {
                header("location:" . url("adm/edicao-fornecedor"));
            } else {
                header("location:" . url("error"));
            }
        } else {
            $provider = new Provider();
            $providers = $provider->selectAllProviders();

            echo $this->view->render("edit-provider", ["providers" => $providers]);
        }
    }

    public function homePdf(): void
    {
        require __DIR__ . "/../../themes/adm/home-pdf.php";
    }

    public function registerSale(array $data)
    {
        $sale = new Sale(
            NULL,
            $data['register-total'],
            $data['register-idUser']
        );
        $returnInsert = $sale->insertSale();
        if ($returnInsert == true) {
            header("location:" . url("adm"));
        } else {
            header("location:" . url("error"));
        }
    }
}
