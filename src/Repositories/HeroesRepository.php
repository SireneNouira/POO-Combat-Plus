<?php

final class HeroesRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createHero(Hero $hero): bool
    {
        $sql = "INSERT INTO hero (name, health, score) VALUES (:name, :health, :score)";
        $stmt = $this->pdo->prepare($sql);

        // Exécuter la requête avec les valeurs du héros
        return $stmt->execute([
            ':name' => $hero->getName(),
            ':health' => $hero->getHealth(),
            ':score' => $hero->getScore()
        ]);
    }
    

    public function getAllHeroesWithPositiveHealth(): array
{
   
    $sql = "SELECT * FROM hero WHERE health > 0";
    
   
    $stmt = $this->pdo->prepare($sql);
    
 
    $stmt->execute();
    

    $heroesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Créer un tableau d'objets Hero
    $heroes = [];
    foreach ($heroesData as $data) {
        $heroes[] = new Hero( $data['name'], $data['health'], $data['score'],$data['id']);
    }

    return $heroes;
}



public function getAllHeroeById(int $heroId): array
{
   
    $sql = "SELECT * FROM hero WHERE id = :id";
    
   
    $stmt = $this->pdo->prepare($sql);
    
 
    $stmt->execute(['id' => $heroId]);
    

    $hero = $stmt->fetchAll(PDO::FETCH_ASSOC);
   

    return $hero;
}


}