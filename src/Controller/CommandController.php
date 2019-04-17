<?php

namespace App\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commande;
use App\Form\CommandFormType;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UsersRepository;

class CommandController extends AbstractController
{
    /**
     * @Route("/creer-commande", name="commandCreate")
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function commandCreate(Request $request, ObjectManager $manager)
    {

        $command = new Commande();
        
        $form = $this->createForm(CommandFormType::class, $command);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isvalid()) {
            $manager->persist($command);
            $manager->flush();

            return $this->redirectToRoute('/');
        }


        return $this->render('command/commandCreate.html.twig', [
            'formCreateCommand' => $form->createView(),
        ]);
    }

    /**
     * @Route("/liste-commandes", name="commandView")
     */
    public function commandView()
    {
        return $this->render('command/index.html.twig', [
            'controller_name' => 'CommandController',
        ]);
    }
}
