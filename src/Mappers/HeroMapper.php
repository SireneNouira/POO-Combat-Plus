
<?php

class HeroMapper implements MapperContract
{
    public static function mapToObject(array $datas): object
    {
        // Vérifie si les clés nécessaires existent dans les données
        if (!isset($datas['name'], $datas['health'], $datas['score'])) {
            throw new InvalidArgumentException("Les données du héros sont incomplètes.");
        }

        // Crée un objet Hero à partir des données
        $hero = new Hero(
            $datas['name'],
            $datas['health'],
            $datas['score'],
         $datas['id'],
        );
        

        // Retourne l'objet Hero
        return $hero;
    }
} 
