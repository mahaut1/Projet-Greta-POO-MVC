

<div class="main">  	
	<div class="signup">
		<form method="POST" action="" enctype="multipart/form-data">
			<label for="chk" aria-hidden="true">Enregistrement</label>
      <div class="mb-3">
			<input type="hidden" name="action" value="signup">
    </div>
    <div class="mb-3">
    <label for="username" class="form-label">Votre username</label>
			<input type="text" class="form-control" name="username" placeholder="username"  required="">
    </div>
    <div class="mb-3">
    <label for="nom" class="form-label">Votre nom</label>
			<input type="text" class="form-control" name="nom" placeholder="Nom" value="<?php if(!empty($_POST["nom"])) echo htmlentities($_POST["nom"]) ?>" required="">
    </div>
    <div class="mb-3">
    <label for="prenom" class="form-label">Votre prenom</label>
      <input type="text" class="form-control" name="prénom" placeholder="prénom" value="<?php if(!empty($_POST["prenom"])) echo htmlentities($_POST["prenom"]) ?>" required="">
    </div>	
    <div class="mb-3">
    <label for="email" class="form-label">Votre email</label>
      <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(!empty($_POST["email"])) echo htmlentities($_POST["email"]) ?>" required="">
    </div>	
    <div class="mb-3">
    <label for="password" class="form-label">Votre mot de passe</label>
      <input type="password" class="form-control" name="password" placeholder="Mot de passe" value="<?php if(!empty($_POST["password"])) echo htmlentities($_POST["password"]) ?>" required="" pattern="^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$" title="Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractères spécial">
    </div>
    <div class="mb-3">
    <label for="password2" class="form-label">Confirmez votre mot de passe</label>
      <input type="password" class="form-control" name="password2" placeholder="Mot de passe" value="<?php if(!empty($_POST["password"])) echo htmlentities($_POST["password"]) ?>" required="" pattern="^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$" title="Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractères spécial">
    </div>
    <div class="mb-3">
    <label for="adressePostale" class="form-label">Votre adresse postale</label>
      <input type="text" class="form-control" name="adressePostale" placeholder="adresse postale" value="<?php if(!empty($_POST["adressePostale"])) echo htmlentities($_POST["adressePostale"]) ?>" required="">
    </div>
    <div class="mb-3">
    <label for="codePostal" class="form-label">Votre code postal</label>
      <input type="number" class="form-control" name="codePostal" placeholder="code postal" value="<?php if(!empty($_POST["codePostal"])) echo htmlentities($_POST["codePostal"]) ?>" required="">
    </div>
    <div class="mb-3">
    <label for="ville" class="form-label">Ville</label>
      <input type="text" class="form-control" name="ville" placeholder="ville" value="<?php if(!empty($_POST["ville"])) echo htmlentities($_POST["ville"]) ?>" required="">
    </div>
    <div class="mb-3">
    <label for="numTel" class="form-label">Votre numéro de téléphone</label>
      <input type="number" class="form-control" name="numTel" placeholder="Votre numéro de téléphone" value="<?php if(!empty($_POST["numTel"])) echo htmlentities($_POST["numTel"]) ?>" required=""> required="">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
		</form>
	</div>
  
			
