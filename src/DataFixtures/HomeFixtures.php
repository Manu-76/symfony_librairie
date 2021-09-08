<?php

namespace App\DataFixtures;

use App\Entity\Home;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class HomeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $home = new Home();
        $home->setTitre("Bienvenue sur la librairie");
        $home->setTexte("Des nouveautés sont disponibles pour cette rentrée 2021");
        $home->setActive(true);
        $manager->persist($home);


        $home = new Home();
        $home->setTitre("Bienvenue sur la librairie");
        $home->setTexte("Après les remises de prix, découvrez les livres de l'automne");
        $home->setActive(false);
        $manager->persist($home);

        $manager->flush();
    }
}
