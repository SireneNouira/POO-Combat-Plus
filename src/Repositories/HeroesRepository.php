<?php

final class HeroesRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createHero(Hero $hero): bool
    {
        $sql = "INSERT INTO hero (name, health, score, defense, attackPower) VALUES (:name, :health, :score, :defense, :attackPower )";
        $stmt = $this->pdo->prepare($sql);

        // Exécuter la requête avec les valeurs du héros
        return $stmt->execute([
            ':name' => $hero->getName(),
            ':health' => $hero->getHealth(),
            ':score' => $hero->getScore(),
            ':defense' => $hero->getDefense(),
            ':attackPower' => $hero->getAttackPower(),
            
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
            $heroes[] = new Hero($data['name'], $data['health'], $data['score'], $data['id']);
        }

        return $heroes;
    }



    public function getHeroById(int $heroId): ?Hero
{
    $sql = "SELECT * FROM hero WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['id' => $heroId]);
    $heroData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($heroData === false) {
        return null;
    }

    return HeroMapper::mapToObject($heroData);
}

// public function getHeroById(int $heroId): Hero
// {
//     $sql = "SELECT * FROM hero WHERE id = :id";
//     $stmt = $this->pdo->prepare($sql);
//     $stmt->execute(['id' => $heroId]);
//     $heroData = $stmt->fetch(PDO::FETCH_ASSOC);

//     if ($heroData === false) {
//         throw new Exception("Aucun héros trouvé avec l'ID $heroId");
//     }

//     // Crée et retourne un objet Hero à partir des données de la base de données
//     return new Hero(
//         $heroData['name'],
//         $heroData['health'],
//         $heroData['score'],
//         $heroData['id']
//     );
// }

public function updateHero(Hero $hero): bool
{
    $sql = "UPDATE hero SET 
                name = :name, 
                health = :health, 
                score = :score, 
                defense = :defense, 
                attackPower = :attackPower 
            WHERE id = :id";

    $stmt = $this->pdo->prepare($sql);

   
    return $stmt->execute([
        ':id' => $hero->getId(),
        ':name' => $hero->getName(),
        ':health' => $hero->getHealth(),
        ':score' => $hero->getScore(),
        ':defense' => $hero->getDefense(),
        ':attackPower' => $hero->getAttackPower(),
    ]);
}

}
