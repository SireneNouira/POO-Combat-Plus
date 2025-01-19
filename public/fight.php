<?php
require_once '../utils/autoload.php';
session_start();
// if ($_SESSION['monstre']->getHealth() <= 10 && $_SESSION['mort']) {
//     unset($_SESSION['monstre']);
// }

// $_SESSION['mort'] = false; // quand le monstre sera vaicncu update par true

if (!isset($_SESSION['monstre'])) {
    if(isset($_POST['hero_id'])){
        $creeMonstre = new FightsManager($_POST['hero_id']);
        $monstre = $creeMonstre->getMonster();
        echo $monstre->getName();
        $_SESSION['monstre'] = $monstre;
    }
}


if (!isset($_SESSION['hero'])) {
    $_SESSION['hero'] = [];
}
if (!isset($_SESSION['heroImage'])) {
    $_SESSION['heroImage'] = '';
}
if (isset($_POST['select_hero']) && isset($_POST['hero_id']) && isset($_POST['hero_image'])) {

    $heroId = $_POST['hero_id'];
    $heroImage = $_POST['hero_image'];
    $_SESSION['heroImage'] = $heroImage;
    $heroRepository = new HeroesRepository();
    $hero = $heroRepository->getHeroById($heroId);


    echo "Héros sélectionné : $heroId avec l'image : $heroImage <br>";
    $_SESSION['hero'] = $hero;
   
    
    if ($heroId) {
       
        
        // $_SESSION['monstre'] = [
        //     'name' => $monstre->getName(),
        //     'health' => $monstre->getHealth(),
        //     'defense' => $monstre->getDefense(),
        //     'attackPower' => $monstre->getAttackPower(),
        //     'level' => $monstre->getLevel(),
        // ];
        // echo " Monstre crée !";
    }
    // header('Location: fight.php');
}

/**
 *  @var Hero $heros
 */
$heros = $_SESSION['hero'];
/**
 *  @var Monster $monstre
 */
$heros = $_SESSION['hero'];
$monstre =$_SESSION['monstre'];
/**
 *
 * @var Monster $_SESSION['monstre']
 */
var_dump($_SESSION['monstre']);
var_dump($_SESSION['hero']);
var_dump($_SESSION['heroImage']);



  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['attack'] )) {
        // Action à exécuter lorsque le bouton "attack" est cliqué
        echo "Action 'attack' reçue et traitée !";
       $_SESSION['hero']->attack($monstre);
    } else {
        echo "Action invalide ou non reçue.";
    }
} else {
    echo "Méthode non autorisée. Utilisez POST.";
}

?>

 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <script defer src="./script_fight.js"></script>
    <title>Fight</title>
</head>

<body>

    <section style="display: flex; justify-content:center; gap: 20px;">
        <img src="<?= $_SESSION['heroImage'] ?>" alt="Hero Image" id="heroImage" class="hero-image" style="width: 200px; position: absolute; left:       400px;">
        <img src="" alt="Monstre Image" id="monsterImage" class="monstre-image" style="width: 200px; position: absolute; right: 400px;">
    </section>


    <form id="hiddenForm" method="POST" action="fight.php">
        <!-- Bouton caché -->
        <button id="hiddenButton" type="submit" name="attack"  style="display: none;">Attack</button>
    </form>
</body>

</html>