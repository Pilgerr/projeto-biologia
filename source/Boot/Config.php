<?php
// Definição de todas as constantes do sistema
// Esse script consta no composer.json para ser incluido automaticamente

// DATABASE

define("CONF_DB_HOST", "localhost");
define("CONF_DB_USER", "root");
define("CONF_DB_PASS", "");
define("CONF_DB_NAME", "BIOLOGIA_IF_CHARQ"); 


// PROJECT URLs

define("CONF_URL_BASE", "http://www.localhost/projeto-biologia"); // depois da / deve vir o nome da pasta do trabalho

// VIEW

define("CONF_VIEW_WEB", __DIR__ . "/../../themes/web");
define("CONF_VIEW_APP", __DIR__ . "/../../themes/app");
define("CONF_VIEW_ADM", __DIR__ . "/../../themes/adm");


// SITE

define("CONF_SITE_NAME", "Projeto Biologia");
define("CONF_SITE_FAVICON", "https://i.im.ge/2023/12/13/EEEx59.fav-icon.png");
define("CONF_SITE_LOGO", "https://i.im.ge/2023/12/13/EEEx59.fav-icon.png");

// UPLOAD

define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
