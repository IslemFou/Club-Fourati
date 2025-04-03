<?php
// $title = "Formulaire";

require_once("inc/functions.inc.php");
require_once "inc/header.inc.php";
?>

<div class="container my-5">
    <div class="p-5 text-center bg-body-tertiary rounded-3">
        <!-- <svg class="bi mt-4 mb-3" style="color: var(--bs-indigo);" width="100" height="100"><use xlink:href="#bootstrap"/></svg> -->
        <h1 class="text-body-emphasis">Bienvenue au Club Tennis Fourati</h1>
        <p class="col-lg-8 mx-auto fs-5 text-muted">
            Ce mini-projet en php a pour objectif est d'ajouter des joueurs au club de tennis Fourati
        </p>
        <div class="d-inline-flex gap-2 mb-5">
            <a class="d-inline-flex align-items-center btn btn-primary btn-lg px-4 rounded-pill" href="<?= RACINE_SITE ?>index.php">
                Nos joueurs
            </a>
            <a href="formulaire.php" class=" btn btn-outline-secondary btn-lg px-4 rounded-pill">
                s'inscrire
            </a>
        </div>
    </div>
</div>















<?php
require_once("inc/footer.inc.php");
?>