<?php
include_once "./views/admin/templates/header-admin.php";
?>

<div class="album py-5 bg-light">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h1>Membres</h1>
                <a href="./admin/user-add" class="btn btn-primary text-white">Ajouter</a>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <th scope="row"><?= $user['id_membre'] ?></th>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <a class="btn btn-danger text-white" href="./admin/del/<?= $u['id'] ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>