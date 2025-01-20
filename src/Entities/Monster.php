<?php

class Monster
{
    private string $name;
    private int $health;
    private int $defense;
    private int $attackPower;
    private int $level;

    public function __construct(int $heroScore)
    {
        $this->level = max(1, intdiv($heroScore, 100));
        $this->name = $this->generateName();
        $this->health = rand(50, 100) + $this->level * 10;
        $this->defense = rand(5, 15) + $this->level;
        $this->attackPower = rand(10, 20) + $this->level * 2;
    }

    private function generateName(): string
    {
        $names = ["Goblin", "Orc", "Troll", "Dragon", "Zombie"];
        return $names[array_rand($names)];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function attackHero(Hero $hero): void
    {
        $damage = max(0, $this->attackPower - $hero->getDefense());
        $hero->takeDamage($damage); 
        echo "{$this->name} attaque {$hero->getName()} et inflige $damage dégâts.\n";

        if ($hero->getHealth() === 0) {
           $heroRepo =  new HeroesRepository();
           $heroRepo->updateHero($hero);
            echo "{$this->name} a vaincu {$hero->getName()} !\n";
        }
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

    public function getAttackPower(): int
    {
        return $this->attackPower;
    }

    public function getLevel(): int
    {
        return $this->level;
    }
}
