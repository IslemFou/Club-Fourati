<?php
require_once "inc/functions.inc.php";
require_once "inc/header.inc.php";
$players = showAllPlayers();
?>

<h2 class="display-4 text-center">Page index : Liste des joueurs</h2>

<table class="table table-dark table-bordered mt-5 " >
            <thead>
                    <tr>
            
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>E-mail</th>
                    </tr>
            </thead>
            <tbody> 
            <?php
       
        foreach ($players as $player): ?>
                        <tr>
                            <td><?= html_entity_decode($player['id']); ?></td>
                            <td><?= ucfirst(html_entity_decode($player['nom'])); ?></td> 
                            <td><?= ucfirst(html_entity_decode($player['prenom'])); ?></td> 
                            <td><?= ucfirst(html_entity_decode($player['email'])); ?></td> 
                        </tr>
               <?php endforeach; ?>
            </tbody>
        </table>

<?php
require_once "inc/footer.inc.php";
?>