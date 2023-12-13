<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= CONF_SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?= url("assets/web/"); ?>css/visualizar-ser-vivo.css">
    <link rel="icon" href="<?= CONF_SITE_FAVICON ?>">
</head>
<body>
    <main>
        <a href="<?= url("app"); ?>" id="a-back">Voltar</a>
            <div class="ser-vivo">
                <a href="<?= url("$serVivo->REINO/{$serVivo->ID}"); ?>">
                    <img src="<?= $serVivo->IMAGEM?>" alt="<?= $serVivo->IMAGEM ?>" class="img-ser-vivo">
                    <span class="nome-popular-ser-vivo">Nome popular: <strong><?= $serVivo->NOME_POPULAR?></strong></span>
                    <span class="nome-cientifico-ser-vivo">Nome científico: <strong><?= $serVivo->NOME_CIENTIFICO?></strong></span>
                    <span class="descricao-especie">Descrição da Espécie: <strong><?= $serVivo->DESCRICAO_ESPECIE?></strong></span>
                    <span class="reino">Reino: <strong><?= $serVivo->REINO?></strong></span>
                    <span class="territorio">Território: <strong><?= $serVivo->TERRITORIO?></strong></span>
                    <span class="observacoes">Observações: <strong><?= $serVivo->OBSERVACOES?></strong></span>
                    <span class="registro-localizacao">Registro Localização: <strong><?= $serVivo->REGISTRO_LOCALIZACAO?></strong></span>
                    <span class="registro-colecao">Registro Coleção IF Sul: <strong><?= $serVivo->REGISTRO_COLECAO_IF_SUL?></strong></span>
                </a>
            </div>
    </main>
</body>

</html>