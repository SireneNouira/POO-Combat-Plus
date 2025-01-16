<?php
var_dump($_POST);
if (isset($_POST['select_hero']) && isset($_POST['hero_id'])) {
   
    $heroId = $_POST['hero_id'];

  
    echo "ID du héros sélectionné : " . htmlspecialchars($heroId) . "<br>";
}