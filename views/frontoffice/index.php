<?php
include_once "view/header.php";
?>

        <div class="row">

            <?php foreach ($annonces as $a) { ?>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="./uploads/<?= $p['filename']; ?>">
                        <div class="card-body">
                            <p class="card-text"><?= $p['name']; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/index.php/product?id=<?= $p['id']; ?>" class="btn btn-sm btn-outline-secondary">Voir</a>
                                </div>
                                <small class="text-muted"><?= $p['price']; ?>€</small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</div>