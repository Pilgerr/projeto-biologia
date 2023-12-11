<?php $this->layout("_theme", ["product" => $product]) ?>
<link rel="stylesheet" href="<?= url("assets/web/"); ?>css/view-product.css">

<body class="body-view">
    <a href="<?= url("produtos"); ?>" id="a-back" style="color: rgb(133, 196, 255); text-decoration: underline; margin-left: 20px;">Voltar</a>
    <main class="main-view">
        <div class="products">
            <img src="<?= $product->image ?>" alt="<?= $product->name ?>" width="200px" height="200px" class="img-product">
        </div>
        <div class="info-products">
            <h1 class="titles-product"><?= $product->name ?></h1>
            <h4 class="titles-product"><?= $product->description ?></h4>
            <h2 class="titles-product">R$ <?= $product->price ?></h2>
            <a href="<?= url("produtos/$product->id?adicionar=$product->id") ?>" class="a-buy">
                <svg viewBox="0 0 32 24" aria-labelledby="pdpBasketIcon pdpBasketDesc" width="25" height="15" fill="#fff" class="src__BasketUI-sc-1cpjf6b-0 hynVVk" class="svg-buy">
                    <path fill="inherit" d="M0 0l.5 2.2h4l4.3 15.6h18.8L32 2.2h-2.6l-3.8 13.1H10.7L6.3 0H0zm13.9 19.5c-1.2 0-2.2 1-2.2 2.2 0 1.2 1 2.2 2.2 2.2 1.2 0 2.2-1 2.2-2.2 0-1.2-1-2.2-2.2-2.2zm8.4 0c-1.2 0-2.2 1-2.2 2.2 0 1.2 1 2.2 2.2 2.2 1.2 0 2.2-1 2.2-2.2 0-1.2-1-2.2-2.2-2.2z">
                    </path>
                </svg>
                <span class="span-buy">Carrinho</span>
            </a>
        </div>
        <?php
        if (isset($_GET['adicionar'])) {
            $idGet = (int) $_GET['adicionar'];
            if ($product->id == $idGet) {
                if (isset($_SESSION['cartItem'][$idGet]) && isset($_SESSION['cart'])) {
                    $_SESSION['cart']['quantity']++;
                    $_SESSION['cart']['total'] += $product->price;
                    $_SESSION['cartItem'][$idGet]['quantity']++;
                } elseif (!isset($_SESSION['cartItem'][$idGet]) && !isset($_SESSION['cart'])) {
                    $_SESSION['cartItem'][$idGet] = array('quantity' => 1, 'name' => $product->name, 'description' => $product->description, 'price' => $product->price, 'id' => $product->id, 'image' => $product->image);
                    $_SESSION['cart'] = array('quantity' => 1, 'total' => $product->price);
                } elseif (!isset($_SESSION['cartItem'][$idGet])) {
                    $_SESSION['cartItem'][$idGet] = array('quantity' => 1, 'name' => $product->name, 'description' => $product->description, 'price' => $product->price, 'id' => $product->id, 'image' => $product->image);
                    $_SESSION['cart']['quantity']++;
                    $_SESSION['cart']['total'] += $product->price;
                }
                echo '<script>alert("O item foi adicionado ao carrinho!");</script>';
            } else {
                echo '<script>alert("Item não encontrado :(");</script>';
            }
        }
        ?>
    </main>
</body>