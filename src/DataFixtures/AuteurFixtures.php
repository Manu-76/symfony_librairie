<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AuteurFixtures extends Fixture
{
    // ====================================================== //
    // ===================== PROPRIETES ===================== //
    // ====================================================== //
    public const ADLER_OLSEN = 'adler-olsen';
    public const JEAN_ROBA = 'jean-roba';
    public const BENOIT_PHILIPPON = 'benoit-philippon';
    public const ENKI_BILAL = 'enki-bilal';
    public const FRANCK_THILLIEZ = 'franck-thilliez';
    public const GIACOMETTI_RAVENNE = 'giacommeti-ravenne';
    public const LEWIS_CARROLL = 'lewis-carroll';
    public const GEORGES_RRMARTIN = 'georges-rrmartin';


//  Mise en place d'une reference pour les auteurs afin de pouvoir les utiliser dans la fixture des livres. Pour cela on crée des constantes que l'on va associer aux instances d'auteur crées.

    public function load(ObjectManager $manager)
    {
        $date = new DateTimeImmutable();

        $auteur = new Auteur();
        $auteur->setImageName ('avt-jussi-adler-olsen-5820-612f4cb393b00266348011.jpeg');
        $auteur->setNom('Olsen');
        $auteur->setPrenom('Adler');
        $auteur->setBiographie('Jussi Adler-Olsen, de son vrai nom Carl Valdemar Jussi Adler-Olsen est un écrivain danois. Il est né le 2 août 1950 à Copenhague. Après avoir été le "bon" guitariste d\'un groupe de musique pop, il s\'essaie à la médecine puis aux sciences politiques, étudie le cinéma, mais aussi les mathématiques.');
        $auteur->setUpdatedAt( new DateTimeImmutable());
        $manager->persist($auteur);
        //  On garde une référence de l'auteur
        $this->addReference(self::ADLER_OLSEN, $auteur);

        $auteur = new Auteur();
        $auteur->setImageName ('avt2-roba-7790-612f4c1d74314661329090.jpeg');
        $auteur->setNom('Roba');
        $auteur->setPrenom('Jean');
        $auteur->setBiographie('Jean Roba, dit Roba, est un auteur de bande dessinée né le 28 juillet 1930 à Schaerbeek, dans la région de Bruxelles-Capitale, et mort dans la même ville le 14 juin 2006. Il est surtout connu comme l\'auteur de la série Boule et Bill, bien qu\'il ait réalisé beaucoup d\'autres travaux.');
        $auteur->setUpdatedAt( new DateTimeImmutable());
        $manager->persist($auteur);
        $this->addReference(self::JEAN_ROBA, $auteur);

        $auteur = new Auteur();
        $auteur->setImageName ('benoit-philippon-612f4c988b546448033512.jpg');
        $auteur->setNom('Philippon');
        $auteur->setPrenom('Benoit');
        $auteur->setBiographie('Benoît Philippon, né en 1976, est un écrivain, un réalisateur et un scénariste français, auteur de roman noir.');
        $auteur->setUpdatedAt( new DateTimeImmutable());
        $manager->persist($auteur);
        $this->addReference(self::BENOIT_PHILIPPON, $auteur);

        $auteur = new Auteur();
        $auteur->setImageName ('enki-bilal-612f4c8cad11e398385554.jpeg');
        $auteur->setNom('Bilal');
        $auteur->setPrenom('Enki');
        $auteur->setBiographie('Enki Bilal est né en République fédérale socialiste de Yougoslavie, d\'un père bosniaque et d\'une mère slovaque. Son patronyme, Bilal, est d\'origine ottomane[1]. Son père était maître-tailleur et s\'occupait personnellement de la garde-robe de Tito, qu\'il avait connu dans la résistance et avec lequel il avait sympathisé.');
        $auteur->setUpdatedAt( new DateTimeImmutable());
        $manager->persist($auteur);
        $this->addReference(self::ENKI_BILAL, $auteur);

        $auteur = new Auteur();
        $auteur->setImageName ('franck-thilliez3-612f4cc12b901295283493.jpg');
        $auteur->setNom('Thilliez');
        $auteur->setPrenom('Franck');
        $auteur->setBiographie('Auteur français.Franck THILLIEZ est né en 1973 à Annecy. Il était ingénieur en nouvelles technologies, il se consacre maintenant à l’écriture. Il vit actuellement dans le Pas-de-Calais. Il est membre de La Ligue de l’Imaginaire.');
        $auteur->setUpdatedAt( new DateTimeImmutable());
        $manager->persist($auteur);
        $this->addReference(self::FRANCK_THILLIEZ, $auteur);

        $auteur = new Auteur();
        $auteur->setImageName ('giacometti-612f4ca611399592186396.jpg');
        $auteur->setNom('Giacometti');
        $auteur->setPrenom('Ravenne');
        $auteur->setBiographie('Éric Giacometti a été journaliste au Parisien.  Il est aussi le scénariste de la bande dessinée Largo Winch.
        Jacques Ravenne est écrivain. Maître franc-maçon, il est spécialiste des manuscrits anciens.
        La série autour du Commissaire Marcas qu’ils ont créé ensemble s’est vendue à plus de deux millions d’exemplaires à travers le monde. ');
        $auteur->setUpdatedAt( new DateTimeImmutable());
        $manager->persist($auteur);
        $this->addReference(self::GIACOMETTI_RAVENNE, $auteur);

        $auteur = new Auteur();
        $auteur->setImageName ('lewis-carroll-victorian-612f4fa1b2725569859743.jpg');
        $auteur->setPseudo('Lewis Carroll');
        $auteur->setNom('Dodgson');
        $auteur->setPrenom('Charles Lutdwige');
        $auteur->setBiographie('Lewis Carroll, nom de plume de Charles Lutwidge Dodgson, est un romancier, essayiste, photographe amateur et professeur de mathématiques britannique, né le 27 janvier 1832 à Daresbury et mort le 14 janvier 1898 à Guildford.');
        $auteur->setUpdatedAt( new DateTimeImmutable());
        $manager->persist($auteur);
        $this->addReference(self::LEWIS_CARROLL, $auteur);

        $auteur = new Auteur();
        $auteur->setImageName ('rr-martin-612f4cd2a7246171992850.jpg');
        $auteur->setNom('R.R.Martin');
        $auteur->setPrenom('Georges');
        $auteur->setBiographie('George Raymond Richard Martin est un écrivain américain de science-fiction et de fantasy, ainsi qu\'un scénariste et un producteur.Dans les années 1980, il a travaillé pour la télévision comme scénariste pour plusieurs séries dont certaines de science-fiction. Une de ses nouvelles fut adaptée au cinéma pour le film Nightflyers. Il a également été journaliste ainsi que professeur de journalisme et superviseur de tournois d\'échecs.');
        $auteur->setUpdatedAt( new DateTimeImmutable());
        $manager->persist($auteur);
        $this->addReference(self::GEORGES_RRMARTIN, $auteur);
        
        // Mise en bdd des auteurs
        $manager->flush();
    }
}
