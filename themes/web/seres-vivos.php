<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= CONF_SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?= url("assets/web/"); ?>css/seres-vivos.css">
    <link rel="icon" href="<?= CONF_SITE_FAVICON ?>">
</head>
<body>
    <main>
        <a href="<?= url("app/cadastro-especie"); ?>" id="link-titulo">Cadastrar nova espécie</a>
        <a href="<?= url("app"); ?>" id="a-back">Voltar</a>
        <section class="seres-vivos">
            <?php
            if (!empty($seresVivos)) {
                foreach ($seresVivos as $serVivo) {?>
                    <div class="ser-vivo">
                        <a href="<?= url("$serVivo->REINO/{$serVivo->ID}"); ?>">
                            <img src="<?= $serVivo->IMAGEM?>" alt="<?= $serVivo->IMAGEM ?>" class="img-ser-vivo">
                            <span class="nome-popular-ser-vivo">Nome popular: <strong><?= $serVivo->NOME_POPULAR?></strong></span>
                            <span class="nome-cientifico-ser-vivo">Nome científico: <strong><?= $serVivo->NOME_CIENTIFICO?></strong></span>
                        </a>
                    </div>
                <?php
                }
            } elseif (empty($seresVivos)) {?>
                <h1>Nenhuma espécie cadastrada!</h1>
            <?php } ?>
        </section>
    </main>
</body>

</html>