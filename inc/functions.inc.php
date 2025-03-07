<?php
/* ------------ Constante pour défninir le chemin du site ------------ */
define("RACINE_SITE", "http://localhost/club_fourati/");

/* ------------ Fonction alert ------------ */
function alert(string $contenu, string $class="warning") : string// type prend une classe bootstrap
{
    return "<div class=\"alert alert-$class alert-dismissible fade show text-center w-50 m-auto mb-5\" role=\"alert\">
                $contenu
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
        </div>";
}


/* ------------- Création d'une fonction pour se connecter à la base de donnée -------------*/

//constante du server
define("DBHOST", "localhost");
define("DBUSER","root");
define("DBPASS",""); 
define("DBNAME", "club_fourati");

function debug ($var)
{
     echo '<pre class="border border-dark bg-light text-danger fw-bold w-50 p-5 mt-5">';
     var_dump($var);
     echo '</pre>';
}

/* 
Création d'une fonction pour se connecter à la base de donnée

*/

function connexionBdd() : object 
{
 $dsn = "mysql:host=".DBHOST.";dbname=".DBNAME.";charset=utf8";
     try{ 
           $pdo = new PDO($dsn, DBUSER, DBPASS); 
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        //  echo "Je suis connecté à la BDD";
     }
     catch(PDOException $e){  
          die("Erreur : " .$e->getMessage()); 
     }
     return $pdo ; 
    }


function createTableJoueurs():void 
{
$conx = connexionBdd();
//définition de la requête SQL
$sql = "CREATE TABLE IF NOT EXISTS joueurs(id_categorie INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                              nom VARCHAR(50) NOT NULL,
                                              prenom VARCHAR(50) NOT NULL,
                                              email VARCHAR(100) NOT NULL,
                                              mdp VARCHAR(255) NOT NULL
                                              )";

    $_REQUEST = $conx->exec($sql);
};





// fonction pour ajouter un joueur
function addPlayer(string $lastName, string $firstName, string $email, string $mdp):void
{
     $data = [
          'nom' => $lastName,
          'prenom' => $firstName,
          'email' => $email,
          'mdp' => $mdp,
     ];
     foreach ($data as $key => $value) {

        $data[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); 
    }
     //connextion à la base de données
     $pdo = connexionBdd();
     //définition de la requête SQL
     $sql ="INSERT INTO joueurs ( nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :mdp)";
    $request = $pdo->prepare($sql); 
    $request->execute(array(
     ':nom'=>$data['nom'],
     ':prenom' => $data['prenom'],
        ':email' => $data['email'],
        ':mdp' => $data['mdp'],
    ));

}



#### Afficher tous les joueurs dans le dashboard
function allPlayers(): mixed
{
    $pdo = connexionBDD();
    $sql = "SELECT * FROM joueurs";
    $request = $pdo->query($sql); 
    $result = $request->fetchAll(); 
    return $result;
}


function checkEmailUser(string $email): mixed
{
    $pdo = connexionBDD();
    $sql = "SELECT email FROM joueurs WHERE email = :email";
    $request = $pdo->prepare($sql); 
    $request->bindValue(':email', $email, PDO::PARAM_STR);
    $request->execute();
    $result = $request->fetch();
    return $result;
}


function showAllPlayers(): mixed
{
    $cnx = connexionBDD();
    $sql = "SELECT * FROM joueurs";
    $request = $cnx->query($sql);
   
    $result = $request->fetchAll();
    return $result;
}
