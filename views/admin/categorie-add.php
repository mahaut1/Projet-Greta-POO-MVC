<?php

include_once "views/admin/templates/header-admin.php";

 ?>

    <div class="row">
        <h1>Ajouter une categorie</h1>
        <div class="col-lg-12">
            <form method="POST" name="categorie" action="./categorie-add">
                <div class="form-group">
                    <label for="name">nom</label>
                    <input type="text" name="nom_categorie" class="form-control" id="nom_categorie">
                </div>
                <div class="form-group">
                    <label for="name">description</label>
                    <input type="text" name="description" class="form-control" id="description">
                </div>
                <div>
                <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>