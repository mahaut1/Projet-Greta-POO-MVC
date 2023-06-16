<?php
include_once "../view/header.php";
?>

<div class="Contact" action="">
<form method="POST">
  
<label for="Contact" aria-hidden="true">Contactez-nous </label>

<div class="mb-3">
  <label for="nom" class="form-label">Votre nom</label>
  <input type="text" class="form-control" name="nom" id="nom">
</div>
<div class="mb-3">
  <label for="nom" class="form-label">Votre prénom</label>
  <input type="text" class="form-control" name="prénom" id="prénom">
</div>
<div class="mb-3">
  <label for="nom" class="form-label">Votre message</label>
  <input type="textarea" class="form-control" name="message" id="message">
</div>
<button type="submit" class="btn btn-primary">Valider</button>
</form>