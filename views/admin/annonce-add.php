<?php

include_once "views/admin/templates/header-admin.php";

 ?>


<div class="album py-5 bg-light">
    <div class="container">

        <div class="row">
            <h1>Ajouter une annonce</h1>
            <div class="col-lg-12">
                <form method="POST" name="annonce" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Titre</label>
                        <input type="text" class="form-control" name="titre">
                    </div>
                    <div class="form-group">
                        <label for="description">description</label>
                        <input type="textarea" class="form-control" name="description">
                    </div>
                    <div class="form-group">
                        <label for="price">prix</label>
                        <input type="number" class="form-control" name="prix_vente">
                    </div>
                    <div class="form-group">
                        <label for="file">Fichier</label>
                        <input type="file" class="form-control" name="is_main_photo">
                    </div>
                    <div class="form-group">
                        <label for="categories">categories</label>
                        <select class="form-control" name="categories">
                            <?php foreach ($categories as $c) { 
                                    echo "<option value=" .  $c['id_categorie'] . ">". $c['nom_categorie'] . "</option>";
                                } 
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            </div>
        </div>
    </div>
</div>
