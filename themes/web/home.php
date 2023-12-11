<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= CONF_SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?= url("assets/web/"); ?>css/home.css">
    <link rel="icon" href="<?= CONF_SITE_FAVICON ?>">
</head>
<body>
    <main>
        <section class="reinos" id="section-tres-reinos">
            <div class="sub-reinos" id="container-dois-reinos">
                <div class="reino" id="fungi">
                    <a href="<?= url("produtos")?>" class="link-reino">
                        <p class="nome-reino">Fungi</p>
                        <div class="imgs">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (24).png" alt="Ícone Reino" class="img-fungi">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (25).png" alt="Ícone Reino" class="img-fungi">
                        </div>
                    </a>
                </div>
                <div class="reino" id="vegetal">
                    <a href="#" class="link-reino">
                        <p class="nome-reino">Vegetal</p>
                        <div class="imgs">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (9).png" alt="Ícone Reino" class="img-vegetal">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (8).png" alt="Ícone Reino" class="img-vegetal">
                        </div>
                        <div class="imgs">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (7).png" alt="Ícone Reino" class="img-vegetal">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (6).png" alt="Ícone Reino" class="img-vegetal">
                        </div>
                        <div class="imgs">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (5).png" alt="Ícone Reino" class="img-vegetal">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (4).png" alt="Ícone Reino" class="img-vegetal">
                        </div>
                    </a>
                </div>
            </div>
            <div class="sub-reinos">
                <div class="reino">
                    <a href="#" class="link-reino">
                        <p class="nome-reino">Animal</p>
                        <div class="imgs">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (23).png" alt="Ícone Reino" class="img-animal">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (22).png" alt="Ícone Reino" class="img-animal">
                        </div>
                        <div class="imgs">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (21).png" alt="Ícone Reino" class="img-animal">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (20).png" alt="Ícone Reino" class="img-animal">
                        </div>
                        <div class="imgs">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (19).png" alt="Ícone Reino" class="img-animal">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (18).png" alt="Ícone Reino" class="img-animal">
                        </div>
                        <div class="imgs">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (17).png" alt="Ícone Reino" class="img-animal">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (16).png" alt="Ícone Reino" class="img-animal">
                        </div>
                        <div class="imgs">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (15).png" alt="Ícone Reino" class="img-animal">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (14).png" alt="Ícone Reino" class="img-animal">
                        </div>
                        <div class="imgs">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (13).png" alt="Ícone Reino" class="img-animal">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (12).png" alt="Ícone Reino" class="img-animal">
                        </div>
                        <div class="imgs">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (11).png" alt="Ícone Reino" class="img-animal">
                            <img src="<?= url("assets/imgs/"); ?>icones_reinos (10).png" alt="Ícone Reino" class="img-animal">
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <section class="reinos">
            <div class="reino">
                <a href="#" class="link-reino">
                    <p class="nome-reino">Protista</p>
                    <div class="imgs">
                        <img src="<?= url("assets/imgs/"); ?>icones_reinos (3).png" alt="Ícone Reino" id="img-protista">
                    </div>
                </a>
            </div>
        </section>
        <section class="reinos">
            <div class="reino">
                <a href="#" class="link-reino">
                    <p class="nome-reino">Monera</p>
                    <div class="imgs">
                        <img src="<?= url("assets/imgs/"); ?>icones_reinos (1).png" alt="Ícone Reino" class="img-monera">
                        <img src="<?= url("assets/imgs/"); ?>icones_reinos (2).png" alt="Ícone Reino" class="img-monera">
                    </div>
                </a>
            </div>
        </section>
    </main>
</body>
</html>