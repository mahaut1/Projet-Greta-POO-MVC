<?php
include_once "../view/header.php";
?>

<div class="main">  	
	<div class="signup">
		<form method="POST" action="" enctype="multipart/form-data">
			<label for="chk" aria-hidden="true">Enregistrement</label>
      <div class="mb-3">
			<input type="hidden" name="action" value="signup">
    </div>
    <div class="mb-3">
    <label for="nom" class="form-label">Votre nom</label>
			<input type="text" class="form-control" name="nom" placeholder="Nom" required="">
    </div>
    <div class="mb-3">
    <label for="email" class="form-label">Votre email</label>
      <input type="email" class="form-control" name="email" placeholder="Email" required="">
    </div>	
    <div class="mb-3">
    <label for="password" class="form-label">Votre mot de passe</label>
      <input type="password" class="form-control" name="pwd" placeholder="Mot de passe" required="" pattern="^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$" title="Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractères spécial">
    </div>
    <div class="mb-3">
    <label for="password2" class="form-label">Confirmez votre mot de passe</label>
      <input type="password" class="form-control" name="pwd2" placeholder="Confirmation du mot de passe" required="">
    </div>	
    <div class="mb-3">
    <label for="avatar" class="form-label">Votre avatar</label>
      <input type="file" class="form-control" name="avatar[]" accept="image/*" multiple>
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
		</form>
	</div>
  
			
