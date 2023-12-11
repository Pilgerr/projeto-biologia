<?php $this->layout("_theme"); ?>
<link rel="stylesheet" href="<?= url("assets/adm/"); ?>css/edit-product.css">
<main>
    <?php
    if (!empty($products)) {
        foreach ($products as $product) {
    ?>
            <div class="products">
                <ul class="list-products">
                    <div class="content">
                        <form action="<?= url("adm/edicao-produto"); ?>" method="post">

                            <input class="input-register" type="number" name="edit-id" value="<?= $product->id ?>" readonly>
                            <input class="input-register" type="text" name="edit-image" value="<?= $product->image ?>">
                            <input class="input-register" type="text" name="edit-name" value="<?= $product->name ?>">
                            <input class="input-register" type="text" name="edit-price" value="<?= $product->price ?>">
                            <input class="input-register" type="text" name="edit-description" value="<?= $product->description ?>">
                            <input class="input-register" type="text" name="edit-available" value="<?= $product->available ?>">
                            <input class="input-edit" type="submit" value="Salvar alteração">
                    </div>
                    </form>
                </ul>
            </div>
        <?php
        }
    } else {
        ?>
        <h1 class="h1-error">Nenhum produto encontrado, cadastre algum <a href="<?= url("adm/cadastro-produto"); ?>">aqui!</a></h1>
    <?php
    }
    ?>
</main>