<?php
require_once '../utils/autoload.php';


var_dump($_POST);
if (isset($_POST['select_hero']) && isset($_POST['hero_id'])) {

    $heroId = $_POST['hero_id'];


    echo "ID du héros sélectionné : " . htmlspecialchars($heroId) . "<br>";
}

$heroId = $_POST['hero_id'] ?? null;
$heroImage = $_POST['hero_image'] ?? null;

if ($heroId && $heroImage) {
    echo "Héros sélectionné : $heroId avec l'image : $heroImage";
}
$hero = new HeroesRepository();
$hero->getAllHeroeById($heroId);

$creeMonstre = new FightsManager($heroId);
var_dump($creeMonstre);
