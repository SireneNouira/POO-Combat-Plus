<?php
require_once '../utils/autoload.php';
session_start();

if (!isset($_SESSION['monstre'])) {
    if (isset($_POST['hero_id'])) {
        $creeMonstre = new FightsManager($_POST['hero_id']);
        $monstre = $creeMonstre->getMonster();
        // echo $monstre->getName();
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


    // echo "Héros sélectionné : $heroId avec l'image : $heroImage <br>";
    $_SESSION['hero'] = $hero;
}

/**
 *  @var Hero $heros
 */
$heros = $_SESSION['hero'];
/**
 *  @var Monster $monstre
 */
$heros = $_SESSION['hero'];
$monstre = $_SESSION['monstre'];
/**
 *
 * @var Monster $_SESSION['monstre']
 */
// var_dump($_SESSION['monstre']);
// var_dump($_SESSION['hero']);
// var_dump($_SESSION['heroImage']);




// var_dump($_POST);

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST['action']) && $_POST['action'] === 'attack') {
//         echo "Action 'attack' reçue !";
//         $_SESSION['hero']->attack($_SESSION['monstre']);
//     } else {
//         echo "Aucune action reçue.";
//     }
// } else { 
//     echo "Requête non POST.";
// }


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $action = $_POST['action'] ?? '';

//     switch ($action) {
//         case 'attack':
//             $_SESSION['hero']->attack($_SESSION['monstre']);
//             echo "Attack réalisée avec succès.";
//             break;
//         default:
//             echo "Action non reconnue.";
//             break;
//     }
// } else {
//     echo "Méthode non supportée.";
// }


// //attack du hero
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST['attack']) && $_SESSION['monstre']->getHealth() >= 0 && $_SESSION['hero']->getHealth() >= 0) {

//        $_SESSION['hero']->attack($_SESSION['monstre']);

//     } if ($_SESSION['monstre']->getHealth() <= 0) {
//         echo "Le héros a vaincu le monstre !";
//         session_destroy();
//         unset($_SESSION['monstre']);
//         //  header('Location: victory.php');
//         exit();
//     }
// } else {
//     echo "Méthode non autorisée. Utilisez POST.";
// }


//attack du monstre
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['monstreattack']) && $_SESSION['monstre']->getHealth() >= 0 && $_SESSION['hero']->getHealth() >= 0) {
        $_SESSION['monstre']->attackHero($_SESSION['hero']);
    }
    if ($_SESSION['hero']->getHealth() <= 0) {
        echo "Le monstre a vaincu le hero !";
        session_destroy();
        unset($_SESSION['monstre']);

        exit();
    }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">

    <script defer src="./assets/script_fight.js"></script>

    <title>Fight</title>


</head>

<body>


    <?php
    //attack du hero
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['attack']) && $_SESSION['monstre']->getHealth() >= 0 && $_SESSION['hero']->getHealth() >= 0) {

    ?>
            <h1 class="comments"><?= $_SESSION['hero']->attack($_SESSION['monstre']); ?></h1>
        <?php
        }
        if ($_SESSION['monstre']->getHealth() <= 0) {
        ?>

            <?php
            session_destroy();
            unset($_SESSION['monstre']);
            ?>
            <a href="home.php"><button class="replay">Re-jouer</button></a>
        <?php
            exit();
        }
    } else {
        echo "Méthode non autorisée. Utilisez POST.";
    }


    //attack du monstre
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['monstreattack']) && $_SESSION['monstre']->getHealth() >= 0 && $_SESSION['hero']->getHealth() >= 0) {
        ?>
            <h1 class="comments"><?= $_SESSION['monstre']->attackHero($_SESSION['hero']); ?></h1>
        <?php
        }
        if ($_SESSION['hero']->getHealth() <= 0) {
        ?>

            <?php
            session_destroy();
            unset($_SESSION['monstre']);
            ?>
            <a href="home.php"><button class="replay">Re-jouer</button></a>
    <?php
            exit();
        }
    }

    ?>
    <section style="display: flex; justify-content:center; gap: 20px;">
        <img src="<?= $_SESSION['heroImage'] ?>" alt="Hero Image" id="heroImage" class="hero-image" style="width: 200px; position: absolute; left:700px;">
        <img src="" alt="Monstre Image" id="monsterImage" class="monstre-image" style="width: 200px; position: absolute; right: 700px;">
        <h3 class="consigne">Appuyez sur espace pour combattre !</h3>
    </section>

    <!-- button d'attack du hero -->
    <form id="hiddenForm" method="POST" action="fight.php">
        <!-- Bouton caché -->
        <button id="hiddenButton" type="submit" name="attack" style="display: none;">Attack</button>
    </form>

    <!-- button d'attack du monstre -->
    <form id="monsterAttackForm" method="POST" action="fight.php">
        <button id="monsterAttackButton" type="submit" name="monstreattack" style="display: none;">Monster Attack</button>
    </form>
 
</body>

</html>