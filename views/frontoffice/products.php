
<div class="album py-5 bg-light">
    <div class="container">

        <div class="row">
            <?php foreach ($annonces as $a) { ?>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="./uploads/<?= $p['filename']; ?>">
                        <div class="card-body">
                            <p class="card-text"><?= $a['titre']; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/index.php/product?id=<?= $a['id_annonce']; ?>" class="btn btn-sm btn-outline-secondary">Voir</a>
                                </div>
                                <small class="text-muted"><?= $a['price']; ?>€</small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</div>
