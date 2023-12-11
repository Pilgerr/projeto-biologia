<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <title><?= CONF_SITE_NAME ?></title>
  <link rel="icon" href="<?= CONF_SITE_FAVICON ?>">
  <link rel="stylesheet" href="<?= url("assets/adm/"); ?>css/_theme.css">
</head>

<body>
  <div class="container">
    <aside class="aside">
      <img src="<?= CONF_SITE_LOGO ?>" alt="Logo Play Ground" class="logo-image">
      <div class="div-aside"><a href="<?= url("app") ?>" class="link-aside">Home inicial</a></div>
      <div class="div-aside"><a href="<?= url("adm/") ?>" class="link-aside">Home adm</a></div>
      <div class="div-aside"><a href="<?= url("adm/cadastro-produto") ?>" class="link-aside">Cadastro de Produtos</a></div>
      <div class="div-aside"><a href="<?= url("adm/cadastro-fornecedor") ?>" class="link-aside">Cadastro de Fornecedores</a></div>
      <div class="div-aside"><a href="<?= url("adm/edicao-produto") ?>" class="link-aside">Edição de Produtos</a></div>
      <div class="div-aside"><a href="<?= url("adm/edicao-fornecedor") ?>" class="link-aside">Edição de Fornecedores</a></div>
    </aside>
    <?= $this->section("content"); ?>
  </div>
</body>

</html>