<?php

require_once "views/admin/templates/header-admin.php";

 ?>
<div class="album py-5 bg-light">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h1>Annonces</h1>
                <a class="btn btn-primary text-white" href="http://localhost/ProjetGreta/admin/product-add.php">Ajouter</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Désignation</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($annonces as $a) { ?>
                        <tr>
                            <th scope="row"><?= $a['id_annonce'] ?></th>
                            <td><?= $a['date_creation'] ?></td>
                            <td><?= $a['titre'] ?></td>
                            <td><?= $a['description'] ?></td>
                            <td><?= $a['duree_de_publication'] ?></td>
                            <td><?= $a['prix_vente'] ?></td>
                            <td><?= $a['cout_annonce'] ?></td>
                            <td><?= $a['date_validation'] ?></td>
                            <td><?= $a['id_etat'] ?></td>
                            <td><?= $a['id_utilisateur'] ?></td>
                            <td><?= $a['date_vente'] ?></td>
                            <td><?= $a['id_acheteur'] ?></td>
                            <td>
                                <a href="/index.php/admin/product/del?id=<?= $p['id'] ?>" class="btn btn-danger text-white">Supprimer</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>