<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
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
        dump($command);
        
        $form = $this->createForm(CommandFormType::class, $command);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isvalid()) {
            $manager->persist($command);
            $manager->flush();

            $this->addFlash('success', 'La commande a bien été crée');

            return $this->redirectToRoute('home');
        }


        return $this->render('command/commandCreate.html.twig', [
            'formCreateCommand' => $form->createView(),
        ]);
    }

    /**
     * @Route("/liste-commandes", name="commandView")
     * @param CommandeRepository $ordersRepository
     * @return Response
     */
    public function commandView(CommandeRepository $ordersRepository)
    {
        $orders = $ordersRepository->findAll();

        return $this->render('command/index.html.twig', [
            'orders' => $orders,
        ]);
    }

    /**
     * @Route("/order/{id}", name="orderSingle", requirements={"id"= "\d+"})
     *
     * @param Commande $order
     * @return Response
     */
    public function orderShow(Commande $order)
    {
        return $this->render('command/show.html.twig', [
            'order' => $order
        ]);
    }
}
