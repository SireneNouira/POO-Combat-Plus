<?php
require_once '../utils/autoload.php';



// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cree']) && !empty($_POST['name'])) {

//     $name = $_POST['name'];


//     $hero = new Hero($name);

//     $heroRepository = new HeroesRepository();


//     if ($heroRepository->createHero($hero)) {
//         header("Location: home.php");
//     } else {
//         echo "<p>Erreur lors de la création du héros.</p>";
//     }
// }

$heroRepository = new HeroesRepository();
$heroes = $heroRepository->getAllHeroesWithPositiveHealth();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cree']) && !empty($_POST['name'])) {
    $name = $_POST['name'];

    $hero = new Hero($name); // Créez le héros avec uniquement le nom
    $heroRepository = new HeroesRepository();

    if ($heroRepository->createHero($hero)) {
        header("Location: home.php");
    } else {
        echo "<p>Erreur lors de la création du héros.</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <script defer src="assets/script.js"></script>
    <title>Créer un Héros</title>
</head>

<body>
    <header>
        <h1>Créer un Héros</h1>
        <form method="POST" action="">
    <label for="name">Nom du Héros :</label>
    <input type="text" id="name" name="name" required>
    <input type="hidden" id="selected-image" name="selected_image">
    <button type="button" id="choose-avatar">Choisir un avatar</button>
    <button name="cree" type="submit">Créer le Héros</button>
</form>

<div id="avatar-modal" style="display:none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Choisissez un avatar</h2>
        <div class="avatar-list">
            <?php
            $images = [
                "assets/imgs/heroes/hero1.png",
                "assets/imgs/heroes/hero2.png",
                "assets/imgs/heroes/hero3.png",
                "assets/imgs/heroes/hero4.png",
                "assets/imgs/heroes/hero5.png",
                "assets/imgs/heroes/hero6.png",
            ];
            foreach ($images as $image) {
                echo '<div class="avatar-item">';
                echo '<img src="' . $image . '" alt="Hero Image" class="avatar-option" data-src="' . $image . '">';
                echo '</div>';
            }
            ?>
        </div>
        
    </div>
</div>
    </header>
    <h1>Liste des Héros</h1>
<section id="list-card">
    <?php if (!empty($heroes)): ?>
        <?php foreach ($heroes as $hero): ?>
            <div class="hero-card">
                <img src="" alt="Hero Image" class="hero-image" style="width: 100px;" data-hero-name="<?= htmlspecialchars($hero->getName()) ?>">
                <div class="hero-info">
                    <h2><?= htmlspecialchars($hero->getName()) ?></h2>
                    <p>Vie: <?= $hero->getHealth() ?></p>
                    <p>Score: <?= $hero->getScore() ?></p>
                </div>
                <form method="POST" action="fight.php">
                    <input type="hidden" name="hero_id" value="<?= $hero->getId() ?>">
                    <input type="hidden" name="hero_image" class="hero-image-src" value="">
                    <button type="submit" name="select_hero" value="1">Choisir ce Héros</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun héros à afficher.</p>
    <?php endif; ?>
</section>

</body>

</html>