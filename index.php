<?php

ob_start();
session_start();

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$route = new Router(CONF_URL_BASE, ":");

/* Web Routes */

$route->namespace("Source\App");
$route->get("/", "Web:home");
$route->get("/fungi", "Web:fungi");
$route->get("/animal", "Web:animal");
$route->get("/vegetal", "Web:vegetal");
$route->get("/protista", "Web:protista");
$route->get("/monera", "Web:monera");
$route->get("/fungi/{idSerVivo}", "Web:visualizarSerVivo");
$route->get("/animal/{idSerVivo}", "Web:visualizarSerVivo");
$route->get("/vegetal/{idSerVivo}", "Web:visualizarSerVivo");
$route->get("/protista/{idSerVivo}", "Web:visualizarSerVivo");
$route->get("/monera/{idSerVivo}", "Web:visualizarSerVivo");
$route->get("/cadastro-usuario", "Web:registerUser");
$route->post("/cadastro-usuario", "Web:registerUserPost");
$route->get("/login", "Web:login");
$route->post("/login", "Web:loginPost");


/* App Routs */

$route->group("/app"); 
$route->get("/", "App:home");
$route->get("/perfil", "App:profile");
$route->post("/perfil", "App:profile");
$route->get("/logout", "App:logout");

/* Adm Routs */

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

/* Erros Routes */

$route->group("error")->namespace("Source\App");
$route->get("/{errcode}", "Web:error");

$route->dispatch();

/* Error Redirect */

if ($route->error()) {
    $route->redirect("/error/{$route->error()}");
}

ob_end_flush();
