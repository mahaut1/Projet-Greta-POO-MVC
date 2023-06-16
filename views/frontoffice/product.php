<?php
include_once "../view/header.php";
?>

<div class="album py-5 bg-light">
    <div class="container">

        <div class="row">

            <div class="col-lg-4">
                <img class="card-img-top" src="./uploads/<?= $annonce['filename']; ?>">
            </div>

            <div class="col-lg-8">
                <h1><?= $annonce['name']; ?> <a href="/index.php/panier/add?id=<?= $annonce['id']; ?>" class="btn btn-primary m-3 text-white">Ajouter au panier</a></h1>

                <p>
                    Prix : <?= $annonce['price']; ?>€
                </p>
                <p>
                    <?= $annonce['description']; ?>
                </p>
            </div>
        </div>
    </div>
</div>

