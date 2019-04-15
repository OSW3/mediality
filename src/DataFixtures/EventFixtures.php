<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\entity\Evenement;
use Faker\Factory;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 100 ; $i++) { 
            $event = new Evenement();
            $event->setTitle("Titre de l'evenement $i")
                    ->setDescription("description de l'evenement n°$i")
                    ->setDateStart($faker->dateTimeBetween('-1 months'))
                    ->setDateEnd($faker->dateTimeBetween('-1 months'))
                    ->setCategory($faker->randomElement([
                        'Politique', 'Tech', 'Nanar', 'Divers', 'Sport'
                    ]))
                    ->setPlace($faker->randomElement([
                        'Paris', 'Lille', 'Lion', 'Riens', 'Avignon'
                    ]))
                    ->setAddress($faker->randomElement([
                        '10 rue de la gare', '2 place jean jaures', '15 place rihour', '20 rue de la republique', '43 faubourg de cassel'
                    ]))
                    ->setNameContact($faker->name)
                    ->setMailContact($faker->email)
                    ->setPhoneContact("06 12 13 14 15")
                    ->setComment("Instruction de l'evenement n°$i")
                    
                    ;

            $manager->persist($event);

        }


        $manager->flush();
    }
}
