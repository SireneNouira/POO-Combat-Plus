<?php

final class FightsManager
{



    private Monster  $monstre;


    public function __construct($heroScore)
    {
        $this->monstre = $this->createMonster($heroScore);
    }



 /**
     * Crée un monstre basé sur le score du héros.
     *
     * @param int $heroScore
     * @return Monster
     */
    public function createMonster(int $heroScore): Monster
    {
        return new Monster($heroScore);
    }

/**
     * Retourne le monstre actuel.
     *
     * @return Monster
     */
    public function getMonster(): Monster
    {
        return $this->monstre;
    }


}
