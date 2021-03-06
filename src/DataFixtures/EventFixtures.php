<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Evenement;
use App\Entity\Commande;
use App\Entity\Team;
use App\Entity\Users;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EventFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }



    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');
        $teams = ['Internet', 'Télévision', 'Radio', 'Journal'];
        $commandes = [];

        for ($i=1; $i <= 6 ; $i++) {
            $event = new Evenement();
            $event->setTitle($faker->catchPhrase)
                    ->setDescription($faker->sentence(16))
                    ->setDateStart($faker->dateTimeBetween('-10 days'))
                    ->setDateEnd($faker->dateTimeBetween('-2 days'))
                    ->setCategory($faker->randomElement([
                        'Politique', 'Technologie', 'Science', 'Divers', 'Sport'
                    ]))
                    ->setPlace($faker->randomElement([
                        'Paris', 'Lille', 'Lyon', 'Nantes', 'Avignon'
                    ]))
                    ->setAddress($faker->randomElement([
                        '10 rue de la gare', '2 place jean jaures', '15 place rihour', '20 rue de la republique', '43 faubourg de cassel'
                    ]))
                    ->setNameContact($faker->name)
                    ->setMailContact($faker->freeEmail)
                    ->setPhoneContact($faker->phoneNumber)
                    ->setComment($faker->sentence(46))
                    ->setUpload($faker->imageUrl(350, 200));

            $manager->persist($event);

            for ($j=0; $j < 3; $j++) {

                $now = new \DateTime();
                $interval = $now->diff($event->getDateEnd());
                $days = $interval->days;
                $minimum = '-'.$days.' days';

                $commande = new Commande();
                $commande->setEvent($event)
                         ->setTitle($faker->catchPhrase)
                         ->setDescription($faker->sentence(16))
                         ->setNameApplicant($faker->userName)
                         ->setObservation($faker->sentence(46))
                         ->setDateDiffusion($faker->dateTimeBetween($minimum))
                         ->setDateRequest($faker->dateTimeBetween($minimum))
                         ->setDateDelivery($faker->dateTimeBetween($minimum));

                        array_push($commandes, $commande);

                    $manager->persist($commande);
            }

        }

        for ($k=0; $k <= 3 ; $k++) { 
                    $team = new Team();
                    $team->setName($teams[$k])
                    ->setDescription($faker->sentence(46));

                    $manager->persist($team);

                    for ($l=0; $l < 6; $l++) { 
                        $user = new Users();
                        $password = $this->encoder->encodePassword($user, 'testtest');
                        $user->setFirstName($faker->firstName)
                             ->setLastName($faker->lastName)
                             ->setEmail($faker->freeEmail)
                             ->setPhone($faker->phoneNumber)
                             ->setStatus('ROLE_USER')
                             ->setPassword($password)
                             ->addTeam($team);
                             foreach ($commandes as $commande) {
                                 $user->addOrder($commande);
                             }

                        $manager->persist($user);
                    }
                }


        $manager->flush();
    }
}
