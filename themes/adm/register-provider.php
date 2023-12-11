<?php $this->layout("_theme"); ?>
<link rel="stylesheet" href="<?= url("assets/adm/"); ?>css/register-product.css">
<form action="<?= url("adm/cadastro-fornecedor"); ?>" method="post">
    <h1 class="h1"> Cadastro de Fornecedores</h1>
    <br>
    <input class="input-register" type="text" placeholder="                            nome" name="register-name">
    <input class="input-register" type="text" name="register-phoneNumber" oninput="phone(this)" value="<?php if (isset($_POST['register-phoneNumber'])) echo $_POST['register-phoneNumber'];
                                                                                                        else echo "+55 ()" ?>">
    <input class="input-register" type="text" placeholder="      link do Instagram" name="register-linkInstagram">
    <input class="input-register" type="text" placeholder=" tipo de produto vendido" name="register-typeProduct">
    <br>
    <input class="input-submit" type="submit" value="Cadastrar">
</form>
<script src="<?= url("assets/adm/"); ?>scripts/register-provider.js"></script>