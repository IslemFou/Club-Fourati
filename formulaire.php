<?php
// $title = "Formulaire";
require_once("inc/functions.inc.php");

$info = "";

if (!empty($_POST)) {
    $verification = true;

    foreach ($_POST as $key => $value) {
        if (empty(trim($value))) {
            $verification = false;
        }
    }

    if ($verification === false) {
        $info .= alert("Veuillez renseigner tous les champs", "danger");
    } else {
        # vérification du nom 
        if (!isset($_POST['lastName']) || strlen(trim($_POST['lastName'])) > 50 || strlen(trim($_POST['lastName'])) < 2) {
            $info = alert("Le champs nom n'est pas valide", "danger");
        }

        # vérification du prenom 
        if (!isset($_POST['firstName']) || strlen(trim($_POST['firstName'])) > 50 || strlen(trim($_POST['firstName'])) < 2) {
            $info .= alert("Le champs prénom n'est pas valide", "danger");
        }


        # vérification du mail
        if (!isset($_POST['email']) || strlen(trim($_POST['email'])) > 100 || strlen(trim($_POST['email'])) < 6 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $info .= alert("Le champs mail n'est pas valide", "danger");
        }

        # vérification du mdp
        $regexMdp = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        
        if (!isset($_POST['mdp']) || !preg_match($regexMdp, $_POST['mdp'])) {
            $info .= alert("Le mot de passe n'est pas valide", "danger");
        }

        if (empty($info)) {
            $lastName = trim($_POST['lastName']);
            $firstName = trim($_POST['firstName']);
            $email = trim($_POST['email']);
            $mdp = trim($_POST['mdp']);


            $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

            $emailExist = checkEmailUser($email);
           
            #Vérification si l'email existe dans la BDD
             if ($emailExist) {
               $info = alert("L'email existe déjà", "warning");
             }
            // #vérification si l'email correspond au même utilisateur
             elseif (empty($info)) {
                 addPlayer($lastName,$firstName,$email,$mdpHash);
                $info = alert("Vous êtes bien inscrit", "success");
             }
        }
    }

    }

require_once("inc/header.inc.php");

?>


<h2 class="display-4 text-center">Formulaire d'inscription</h2>
<?php
        echo $info;
        ?>
<form action="#" method="post">
<div class="container">
<div class="row m-2">
  <div class="col">
  <label for="lastName" class="form-label mb-3">Nom</label>
    <input type="text" class="form-control" placeholder="nom" aria-label="nom" id="lastName" name="lastName">
  </div>
  <div class="col">
  <label for="firstName" class="form-label mb-3">Prenom</label>
    <input type="text" class="form-control" placeholder="prenom" aria-label="prenom" id="firstName" name="firstName">
  </div>
</div>
<div class="row mb-3">
    <div class="col-md-6">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="exemple.email@exemple.com">
    </div>
    <div class="col-md-6">
    <label for="mdp" class="form-label">Password</label>
    <input type="password" class="form-control"id="mdp" name="mdp" placeholder="Entrer votre mot de passe">
  </div>
  <div>
      <button type="submit" class="btn btn-primary btn-lg mt-2">Envoyer</button>
  </div>

</form>
</div>
<?php
require_once("inc/footer.inc.php");
?>