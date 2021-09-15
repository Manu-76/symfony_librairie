<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    //  On déclare une propriété (privée parce qu'elle ne concerne que la fixture) qui va nous permettre d'accéder au UserPasswordHasherInterface partout dans les méthodes de la classe
    private $encoder;
    /**
     * On met en place un constructeur afin de pouvoir injecter le UserPasswordHasherInterface dans la classe et pouvoir l'utiliser notamment dans la méthode load (méthode native dans laquelle on ne peut pas faire l'injection)
     */

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        //  On "mémorise" le UserPasswordHasherInterface injecté dans la propriété de classe de sorte qu'on y aura accès depuis toutes les méthodes de classe
        $this->encoder = $userPasswordHasherInterface;
    }
    public function load(ObjectManager $manager)
    {
        // ADMIN
        //  On instancie un utilisateur
        $user = new User();
        //  On renseigne la propriété email à l'aide du setter
        $user->setEmail('admin@admin.com');
        //  Gestion du mdp
        $plainPassword = "pass";  // le mdp en clair que l'on veut encoder
        $encodedPassword = $this->encoder->hashPassword($user, $plainPassword);  // On encode le password avec l'encoder mémorisé lors de l'injection dans le constructeur
        $user->setPassword($encodedPassword);  // On renseigne la propriété password de l'utilisateur avec le setter
        $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]); // On affecte un role à l'utilisateur
        $user->setIsVerified(1); // On met la propriété isVerified à 1 pour les utilisateurs aient le droit de se connecter sans passer par le process du mail de confirmation
        //on mémorise l'instance d'utilisateur afin de l'ajouter ultérieurement dans la base de données
        $manager->persist($user);

        // SIMPLE USER
        $user = new User();
        $user->setEmail('user@user.com');
        $plainPassword = "pass"; 
        $encodedPassword = $this->encoder->hashPassword($user, $plainPassword);  
        $user->setPassword($encodedPassword);
        $user->setRoles(["ROLE_USER"]); // On affecte un role à l'utilisateur
        $user->setIsVerified(1);
        $manager->persist($user);
        // On met en BDD
        $manager->flush();
    }
}
