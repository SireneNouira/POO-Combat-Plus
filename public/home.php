<?php
require_once '../utils/autoload.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cree']) && !empty($_POST['name']) ) {
   
    $name = $_POST['name'];

   
    $hero = new Hero($name);

    $heroRepository = new HeroesRepository();

 
    if ($heroRepository->createHero($hero)) {
        header("Location: home.php");
    } else {
        echo "<p>Erreur lors de la création du héros.</p>";
    }
}

$heroRepository = new HeroesRepository();
$heroes = $heroRepository->getAllHeroesWithPositiveHealth();

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
    <h1>Créer un Héros</h1>
    <form method="POST" action="">
        <label for="name">Nom du Héros :</label>
        <input type="text" id="name" name="name" required>
        <button name="cree" type="submit">Créer le Héros</button>
    </form>

    <h1>Liste des Héros</h1>

<?php if (!empty($heroes)): ?>
    <?php foreach ($heroes as $hero): ?>
        <div class="hero-card">
           
        <img src="" alt="Hero Image" class="hero-image" style="width: 100px;" data-hero-id="<?= $hero->getId() ?>">

            <div class="hero-info">
                <h2><?= htmlspecialchars($hero->getName()) ?></h2>
                <p>Vie: <?= $hero->getHealth() ?></p>
                <p>Score: <?= $hero->getScore() ?></p>
            </div>
            <!-- Formulaire pour choisir ce héros pour le combat -->
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



</body>
</html>
