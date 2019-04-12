<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @return void
     */
    public function eventEdit() {
        return $this->render('event/index.html.twig');
    }

    /**
     * @Route("/event/create", name="eventCreate")
     *
     * @return void
     */
    public function eventCreate() {
        return $this->render('event/index.html.twig');
    }
}
