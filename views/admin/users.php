<?php

include_once "views/admin/templates/header-admin.php";

 ?>

<div class="row">
            <div class="col-lg-12">
                <h1>Utilisateurs</h1>
                <a href="http://localhost/ProjetGreta/admin/user-add.php" class="btn btn-primary text-white">Ajouter</a>
                <a href="http://localhost/ProjetGreta/admin/import.php" class="btn btn-primary text-white">Import</a>
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
                            <th scope="row"><?= $user['id'] ?></th>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <a class="btn btn-danger text-white" href="/index.php/admin/user/del?id=<?= $user['id'] ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
