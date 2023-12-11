<?php

ob_start();
session_start();

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$route = new Router(CONF_URL_BASE, ":");
//$route = new Router('localhost/acme-tarde', ":"); // Route para localhost

/**
 * Web Routes
 */

$route->namespace("Source\App");
$route->get("/", "Web:home");
$route->get("/sobre", "Web:about");
$route->get("/contato", "Web:contact");
$route->get("/produtos", "Web:products");
$route->get("/entrar", "Web:loginAndRegister");
$route->get("/cadastro-usuario", "Web:registerUser");
$route->post("/cadastro-usuario", "Web:registerUserPost");
$route->get("/cadastro-endereco", "Web:registerAddress");
$route->post("/cadastro-endereco", "Web:registerAddressPost");
$route->get("/login", "Web:login");
$route->post("/login", "Web:loginPost");
$route->get("/produtos/{idProduct}", "Web:viewProduct");
$route->get("/carrinho", "Web:cart");
$route->get("/finalizar-venda", "Web:checkout");
$route->get("/logout", "Web:logout");
$route->get("/recuperar-senha", "Web:forgotPassword");
$route->post("/recuperar-senha", "Web:forgotPasswordPost");
$route->post("/verificar-codigo", "Web:verifyOtp");
$route->get("/atualizar-senha", "Web:updatePassword");
$route->post("/atualizar-senha", "Web:updatePasswordPost");

//$route->post("/produtos/{idProduct}","Web:viewProductAdd");

/*
 * App Routs
 */

$route->group("/app"); // agrupa em /app
$route->get("/", "App:home");
$route->get("/perfil", "App:profile");
$route->post("/perfil", "App:profile");
$route->get("/logout", "App:logout");

/*
 * Adm Routs
 */

$route->group("/adm");
$route->get("/", "Adm:home");
$route->get("/gerar-pdf", "Adm:homePdf");
$route->get("/cadastro-produto", "Adm:registerProduct");
$route->post("/cadastro-produto", "Adm:registerProduct");
$route->get("/edicao-produto", "Adm:editProduct");
$route->post("/edicao-produto", "Adm:editProduct");
$route->get("/cadastro-fornecedor", "Adm:registerProvider");
$route->post("/cadastro-fornecedor", "Adm:registerProvider");
$route->get("/edicao-fornecedor", "Adm:editProvider");
$route->post("/edicao-fornecedor", "Adm:editProvider");
$route->post("/cadastro-venda", "Adm:registerSale");

/*
 * Erros Routes
 */

$route->group("error")->namespace("Source\App");
$route->get("/{errcode}", "Web:error");

$route->dispatch();

/*
 * Error Redirect
 */

if ($route->error()) {
    $route->redirect("/error/{$route->error()}");
}

ob_end_flush();
