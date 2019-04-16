<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commande;
use App\Form\CommandFormType;
use Symfony\Component\HttpFoundation\Request;

class CommandController extends AbstractController
{
    /**
     * @Route("/creer-commande", name="commandCreate")
     */
    public function commandCreate(Request $request)
    {

        $command = new Commande();
        
        $form = $this->createForm(CommandFormType::class, $command);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isvalid()) {
            dump($request);
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
