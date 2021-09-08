<?php

namespace App\DataFixtures;

use App\Entity\Livre;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LivreFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $date = new DateTimeImmutable();
        
        $livre = new Livre();
        $livre->setImageName ('a-game-of-trhones-612cb1d17c108372965147.jpg');
        $livre->setTitre('A Game Of Thrones');
        $livre->setDescription('Jon Snow, le fils bâtard d\'Eddard s\'engage dans la Garde de Nuit, un ordre chargé de défendre le Mur, frontière nord du royaume, contre les invasions des peuples barbares vivant au-delà, surnommés les « Sauvageons ». Il rejoint Châteaunoir, un des nombreux châteaux du Mur, où il se lie d\'amitié avec Samwell Tarly.');
        $livre->setAuteur($this->getReference(AuteurFixtures::GEORGES_RRMARTIN));
        $livre->setUpdatedAt($date);
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setImageName ('alice-au-pays-des-merveilles-612f4fcf4bd2f902514987.jpg');
        $livre->setTitre('Alice au pays des merveilles');
        $livre->setDescription('Alice, désormais âgée de 19 ans, retourne dans le monde fantastique qu\'elle a découvert quand elle était enfant. Elle y retrouve ses amis le Lapin Blanc, Bonnet Blanc et Blanc Bonnet, le Loir, la Chenille, le Chat du Cheshire et, bien entendu, le Chapelier Fou. Alice s\'embarque alors dans une aventure extraordinaire où elle accomplira son destin: mettre fin au règne de terreur de la Reine Rouge.');
        $livre->setAuteur($this->getReference(AuteurFixtures::LEWIS_CARROLL));
        $livre->setUpdatedAt($date);
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setImageName ('boule et bill.jpg');
        $livre->setTitre('Strip cocker');
        $livre->setDescription('Boule, un petit garçon comme les autres, a comme meilleur copain Bill, son adorable et facétieux cocker. Outre Boule, Bill a une autre grande passion : Caroline, la mignonne tortue... Dans un univers familial plein de gentillesse et de joie de vivre, les bêtises et les espiègleries de Boule et Bill déchainent les éclats de rire des lecteurs de tout âge.');
        $livre->setAuteur($this->getReference(AuteurFixtures::JEAN_ROBA));
        $livre->setUpdatedAt($date);
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setImageName ('boule2-6131dde6b0f22219341686.jpg');
        $livre->setTitre('Graine de cocker');
        $livre->setDescription('La série a toujours reposé sur des valeurs positives, mettant en avant les petits bonheurs et les grandes joies de l\'enfance, l\'amitié tendre et sincère qui lie un petit garçon et son chien, les moments partagés avec ses parents, mais aussi l\'amour de la nature.');
        $livre->setAuteur($this->getReference(AuteurFixtures::JEAN_ROBA));
        $livre->setUpdatedAt($date);
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setImageName ('cabosse-612cb12a87a83865726198.jpg');
        $livre->setTitre('Cabossé');
        $livre->setDescription('Quand Roy est né, il s’appelait Raymond. C’était à Clermont. Il y a quarante-deux ans. Il avait une sale tronche. Bâti comme un Minotaure, il s’est taillé son chemin dans sa chienne de vie à coups de poing : une vie de boxeur ratée et d’homme de main à peine plus glorieuse. Jusqu’au jour où il rencontre Guillemette, une luciole fêlée qui succombe à son charme, malgré son visage de "tomate écrasée"…');
        $livre->setAuteur($this->getReference(AuteurFixtures::BENOIT_PHILIPPON));
        $livre->setUpdatedAt($date);
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setImageName ('deux-fois-612cb37e1e636646121902.jpg');
        $livre->setTitre('Il était deux fois');
        $livre->setDescription('En 2008, Julie, dix-sept ans, disparaît en ne laissant comme trace que son vélo posé contre un arbre. Le drame agite Sagas, petite ville au cœur des montagnes, et percute de plein fouet le père de la jeune fille, le lieutenant de gendarmerie Gabriel Moscato.');
        $livre->setAuteur($this->getReference(AuteurFixtures::FRANCK_THILLIEZ));
        $livre->setUpdatedAt($date);
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setImageName ('effet-papillon-612cb176a3fbc883744677.jpg');
        $livre->setTitre('L\'effet papillon');
        $livre->setDescription('Souffrant de troubles de la mémoire, Evan est incapable de se rappeler les moments cruciaux de son existence, en particulier les plus effrayants. C\'est pourquoi il écrit tout ce qui lui arrive. C\'est ainsi qu\'il apprend, en relisant ses notes, qu\'il a le pouvoir de se transporter dans le passé. Sans hésiter, il utilise ce don afin d\'effacer tout ce qui nuit à ceux qu\'il aime.');
        $livre->setAuteur($this->getReference(AuteurFixtures::ADLER_OLSEN));
        $livre->setUpdatedAt($date);
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setImageName ('regne-illuminati-612cb2577828c011312168.jpg');
        $livre->setTitre('Le règne des Illuminatis');
        $livre->setDescription('Après l\'assassinat de l\'abbé Emmanuel au siège de l\'Unesco à Paris, Antoine Marcas, le policier franc-maçon, mène l\'enquête sur une terrifiante organisation secrète censée avoir disparu depuis des siècles : les Illuminati.');
        $livre->setAuteur($this->getReference(AuteurFixtures::GIACOMETTI_RAVENNE));
        $livre->setUpdatedAt($date);
        $manager->persist($livre);


        $manager->flush();
    }
}
