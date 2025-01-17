<?php

class Hero
{
    private int $id;
    private string $name;
    private int $health;
    private int $attackPower;
    private int $defense;
    private int $score;


    public function __construct(string $name, int $health = 100, int $score = 0, int $id = 0)
    {
        $this->id = $id;      // Assurez-vous que l'ID est correctement assigné
        $this->name = $name;
        $this->health = $health;
        $this->attackPower = 20;
        $this->defense = 5;
        $this->score = $score;
    }


    // Méthodes

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setHealth(int $health): void
    {
        $this->health = $health;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function getAttackPower(): int
    {
        return $this->attackPower;
    }


    public function attack(Monster $target): void
    {
        $damage = max(0, $this->attackPower - $target->getDefense());
        $target->takeDamage($damage);
        echo "{$this->name} attaque {$target->getName()} et inflige $damage dégâts.\n";

        if ($target->getHealth() === 0) {
            $this->incrementScore($target->getLevel());
            $this->powerUp(); // Améliore les stats après une victoire
            echo "{$this->name} a vaincu {$target->getName()} et gagne en puissance !\n";
        }

        // Mise à jour du héros dans la base de données après le combat
        $heroesRepository = new HeroesRepository();
        $heroesRepository->updateHero($this);
    }


    public function takeDamage(int $damage): void
    {
        $this->health = max(0, $this->health - $damage);
        if ($this->health === 0) {
            echo "{$this->name} est vaincu !\n";
        }
    }

    public function getDefense(): int
    {
        return $this->defense;
    }

    public function heal(int $amount): void
    {
        $this->health += $amount;
        echo "{$this->name} récupère $amount points de vie.\n";
    }

    public function getScore(): int
    {
        return $this->score;
    }

    private function incrementScore(int $monsterLevel): void
    {
        $this->score += $monsterLevel * 10; // Le score dépend du niveau du monstre
        echo "Score actuel de {$this->name} : {$this->score}\n";
    }

    private function powerUp(): void
    {
        $this->attackPower += 5; // Amélioration de la puissance d'attaque
        $this->defense += 2; // Amélioration de la défense
        $this->health += 10; // Augmentation de la santé maximale
        echo "{$this->name} gagne +5 en puissance d'attaque, +2 en défense et +10 points de vie !\n";
    }
}
