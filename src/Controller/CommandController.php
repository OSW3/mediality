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

class CommandController extends AbstractController
{
    /**
     * @Route("/creer-commande", name="commandCreate")
     * @Route("/commande/modifier/{id}", name="orderEdit", requirements={"id"="\d+"})
     * @param Request $request
     * @param ObjectManager $manager
     * @param Commande|null $command
     * @return Response
     */
    public function commandCreate(Request $request, ObjectManager $manager, Commande $command = null)
    {
        if (!$command){
            $command = new Commande();
        }

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
            'editMode' => $command->getId() !== null
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

    /**
     * @Route("/order/delete/{id}", name="orderDelete")
     *
     * @param Commande $order
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function eventDelete(Commande $order, Request $request, ObjectManager $manager) {
        if($this->isCsrfTokenValid('delete'.$order->getId(), $request->get('_token'))){
            $manager->remove($order);
            $manager->flush();
        }

        return $this->redirectToRoute('commandView');
    }
}
