<?php
include_once "../view/header.php";
?>

<div class="Creation_Annonce" action="">
<form method="POST">
  
<label for="Creation_annonce" aria-hidden="true">Créer votre annonce</label>
 <div class="mb-3">
  <label for="Titre_Annonce" class="form-label">Titre de l'annonce</label>
  <input type="text" class="form-control" name ="Titre_annonce" id="Titre_annonce" placeholder="Votre titre">
</div>
<div class="mb-3">
  <label for="description_annonce" class="form-label">Description de l'annonce</label>
  <input type="textarea" class="form-control" name="Description_annonce" id="Description_annonce" placeholder="Votre titre">
</div>
<div class="mb-3">
  <input type="hidden" class="form-control" name="date_creation" id="date_creation">
</div>
<div class="mb-3">
  <label for="date_creation" class="form-label">Date de création</label>
  <input type="textarea" class="form-control" name="Date de création" id="Date de création">
</div>
<div class="mb-3">
  <label for="Prix_vente" class="form-label">Prix de vente</label>
  <input type="textarea" class="form-control" name="Date de création" id="Date de création">
</div>
<button type="submit" class="btn btn-primary">Valider</button>

</form>