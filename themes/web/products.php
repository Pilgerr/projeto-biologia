<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= CONF_SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?= url("assets/web/"); ?>css/products.css">
    <link rel="icon" href="<?= CONF_SITE_FAVICON ?>">
</head>
<body>
    <main>
        <a href="<?= url("app/cadastro-especie"); ?>" id="link-titulo">Cadastrar nova espécie</a>
        <a href="<?= url("app"); ?>" id="a-back">Voltar</a>
        <section class="seres-vivos">
            <?php
            if (!empty($seresVivos)) {
                foreach ($seresVivos as $serVivo) {
                    if ($serVivo->available == "on") { ?>
                        <div class="ser-vivo">
                            <img src="<?= $serVivo->image ?>" alt="<?= $serVivo->name ?>" width="100px" height="100px" class="img-product">
                            <h6 class="price-product">R$ <?= $serVivo->price ?></h6>
                            <div class="div-red-product">
                                <h6><a href="<?= url("produtos/{$serVivo->id}"); ?>"><?= $serVivo->name ?></a></h6>
                            </div>
                        </div>
                    <?php
                    }
                }
            } elseif (empty($seresVivos)) {?>
                <h1 class="h1-error">Nenhum produto disponível!</h1>
            <?php } ?>
        </section>
    </main>
</body>

</html>