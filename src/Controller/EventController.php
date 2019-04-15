<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EventFormType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    /**
     * @Route("/event", name="event")
     */
    public function eventList()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    /**
     * @Route("/event/{id}", name="eventSingle", requirements={"id"= "\d+"})
     *
     * @return void
     */
    public function eventShow() {
        return $this->render('event/index.html.twig');
    }

    /**
     * @Route("/event/{id}/delete", name="eventDelete")
     *
     * @return void
     */
    public function eventDelete() {
        return $this->render('event/index.html.twig');
    }

    /**
     * @Route("/event/{id}/edit", name="eventEdit")
     *
     * @return Response
     */
    public function eventEdit() {
        return $this->render('event/index.html.twig');
    }

    /**
     * @Route("/event/create", name="eventCreate")
     *
     * @param Request $request
     * @param ObjectManager $em
     * @return Response
     */
    public function eventCreate(Request $request, ObjectManager $em) {
        $event = new Evenement();
        $form = $this->createForm(EventFormType::class, $event);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('event/index.html.twig', [
            'eventForm' => $form->createView()
        ]);
    }
}
