<?php $this->layout("_theme"); ?>
<link rel="stylesheet" href="<?= url("assets/adm/"); ?>css/register-product.css">
<form action="<?= url("adm/cadastro-produto"); ?>" method="post">
    <h1 class="h1"> Cadastro de Produtos</h1>
    <br>
    <input class="input-register" type="text" placeholder="                         imagem" name="register-image">
    <input class="input-register" type="text" placeholder="                            nome" name="register-name">
    <input class="input-register" type="text" placeholder="                            preço" name="register-price">
    <input class="input-register" type="text" placeholder="                       descrição" name="register-description">
    <br>
    <input class="input-submit" type="submit" value="Cadastrar">
</form>